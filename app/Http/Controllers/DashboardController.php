<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Deal;
use App\Models\Interaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the current user
        $user = Auth::user();
        $companyId = $user->company_id;
        
        // Get dashboard statistics - simplified and accurate
        $stats = [
            // Total companies: companies created by the user
            'total_companies' => Company::where('user_id', $user->id)->count(),
            
            // Total deals: deals created by the user
            'total_deals' => Deal::where('user_id', $user->id)->count(),
            
            // Deals closed this month
            'deals_closed_this_month' => Deal::where('user_id', $user->id)
                ->where('stage', 'closed-won')
                ->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count(),
            
            // Total revenue from all deals (not just closed ones)
            'total_revenue' => Deal::where('user_id', $user->id)
                ->sum('value'),
            
            // Pending deals
            'pending_deals' => Deal::where('user_id', $user->id)
                ->where('stage', 'new')
                ->count(),
            
            // Recent interactions
            'recent_interactions' => Interaction::with(['company:id,name', 'user:id,name'])
                ->where('user_id', $user->id)
                ->latest()
                ->take(5)
                ->get(),
        ];
        
        // Get companies created by the user
        $recent_companies = Company::where('user_id', $user->id)
            ->orderBy('name')
            ->get();
        
        // Debug logging
        \Illuminate\Support\Facades\Log::info('Dashboard loaded companies', [
            'user_id' => $user->id,
            'company_id' => $user->company_id,
            'companies_count' => $recent_companies->count(),
            'companies' => $recent_companies->pluck('name', 'id')
        ]);
        
        // Get recent deals created by the user
        $recent_deals = Deal::with('company:id,name')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();
        
        // Calculate active deals (deals that are not closed-won or closed-lost)
        $stats['active_deals'] = Deal::where('user_id', $user->id)
            ->whereNotIn('stage', ['closed-won', 'closed-lost'])
            ->count();
        
        // Get monthly deal data for chart (optimized with single query) - filtering by user or their company
        $monthly_deals = [];
        $start_date = Carbon::now()->subMonths(5)->startOfMonth();
        $end_date = Carbon::now()->endOfMonth();
        
        $monthly_data = Deal::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as deals')
            ->where('user_id', $user->id)
            ->whereBetween('created_at', [$start_date, $end_date])
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->keyBy(function ($item) {
                return $item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT);
            });
        
        // Fill in missing months with zero deals
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $key = $month->format('Y-m');
            $monthly_deals[] = [
                'month' => $month->format('M'),
                'deals' => $monthly_data->get($key)->deals ?? 0
            ];
        }
        
        return view('dashboard.index', compact('stats', 'recent_companies', 'recent_deals', 'monthly_deals'));
    }

    public function companies()
    {
        // Get the current user
        $user = Auth::user();
        
        // Filter companies by the logged-in user's user_id
        $companies = Company::where('user_id', $user->id)->latest()->paginate(15);
        return view('companies.index', compact('companies'));
    }

    public function deals()
    {
        // Get the current user
        $user = Auth::user();
        $deals = Deal::with('company')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(15);
        return view('deals.index', compact('deals'));
    }

    public function interactions()
    {
        // Get the current user
        $user = Auth::user();
        $interactions = Interaction::with('company')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(15);
        return view('interactions.index', compact('interactions'));
    }
    
    public function allCompanies()
    {
        // Get the current user
        $user = Auth::user();
        
        // Get companies created by the user
        $companies = Company::where('user_id', $user->id)
            ->latest()
            ->paginate(15);
        
        return view('companies.index', compact('companies'));
    }

    public function settings()
    {
        return view('settings.index');
    }

    public function quickAddCompany(Request $request)
    {
        // Get current user
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'industry' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ], [
            'email.email' => 'Please enter a valid email address.',
            'email.required' => 'The email field is required.',
            'phone.required' => 'The phone field is required.',
        ]);
        
        // Add the user_id to the validated data
        $validated['user_id'] = $user->id;
        
        try {
            // Create a new company owned by the current user
            $company = Company::create($validated);
            
            // Update user with new company_id if needed
            if (!$user->company_id) {
                \Illuminate\Support\Facades\DB::table('users')
                    ->where('id', $user->id)
                    ->update(['company_id' => $company->id]);
            }
            $message = 'Company created successfully.';
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true, 
                    'message' => $message,
                    'company' => $company
                ]);
            }
            
            return redirect()->route('dashboard')
                ->with('success', $message);
                
        } catch (\Exception $e) {
            Log::error('Error adding company: ' . $e->getMessage());
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false, 
                    'message' => 'An unexpected error occurred. Please try again.'
                ], 500);
            }
            
            return redirect()->route('dashboard')
                ->with('error', 'An unexpected error occurred. Please try again.')
                ->withInput();
        }
    }

    public function quickCreateDeal(Request $request)
    {
        // Get the current user's company ID
        $user = Auth::user();
        $companyId = $user->company_id;
        
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'value' => 'required|numeric|min:0|max:999999999.99',
                'stage' => 'nullable|string|in:lead,qualified,proposal,negotiation,closed-won,closed-lost',
                'company_id' => 'required|exists:companies,id',
            ], [
                'value.min' => 'Deal value must be a positive number.',
                'value.max' => 'Deal value is too large.',
                'value.required' => 'The deal value is required.',
                'value.numeric' => 'The deal value must be a number.',
                'company_id.required' => 'A company must be selected.',
                'company_id.exists' => 'The selected company does not exist.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed: ' . implode(' ', $e->validator->errors()->all()),
                    'errors' => $e->validator->errors()
                ], 422);
            }
            throw $e; // Re-throw for normal form submissions to use Laravel's default handling
        }

        // No longer need this check since users can have their own companies
        // We ensure the company belongs to the user in the controller now

        try {
            // Set default stage and user
            $validated['stage'] = $validated['stage'] ?? 'new';
            $validated['user_id'] = $user->id;
            
            // Make sure the company belongs to the user
            $company = Company::where('id', $validated['company_id'])
                ->where('user_id', $user->id)
                ->first();
                
            if (!$company) {
                throw new \Exception('You do not have permission to create deals for this company.');
            }

            $deal = Deal::create($validated);
            
            // Check if request is AJAX
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => "Deal '{$deal->title}' has been created successfully!",
                    'deal' => $deal
                ]);
            }
            
            return redirect()->route('dashboard')
                ->with('success', "Deal '{$deal->title}' has been created successfully!");
                
        } catch (\Exception $e) {
            Log::error('Error creating deal: ' . $e->getMessage());
            
            // Check if request is AJAX
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An unexpected error occurred. Please try again.'
                ], 500);
            }
            
            return redirect()->route('dashboard')
                ->with('error', 'An unexpected error occurred. Please try again.')
                ->withInput();
        }
    }

    public function quickLogInteraction(Request $request)
    {
        // Get the current user's company ID
        $user = Auth::user();
        $companyId = $user->company_id;
        
        try {
            $validated = $request->validate([
                'type' => 'required|string|in:call,email,meeting,demo,follow-up,other',
                'company_id' => 'required|exists:companies,id',
                'notes' => 'nullable|string|max:2000',
                'interaction_date' => 'nullable|date|before_or_equal:now',
            ], [
                'type.required' => 'Please select an interaction type.',
                'type.in' => 'Please select a valid interaction type.',
                'company_id.required' => 'Please select a company.',
                'company_id.exists' => 'Selected company does not exist.',
                'contact_id.exists' => 'Selected contact does not exist.',
                'interaction_date.before_or_equal' => 'Interaction date cannot be in the future.',
                'notes.max' => 'Notes cannot exceed 2000 characters.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Interaction validation failed', [
                'errors' => $e->errors(),
                'user_id' => $user->id
            ]);
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed: ' . implode(' ', $e->validator->errors()->all()),
                    'errors' => $e->validator->errors()
                ], 422);
            }
            throw $e; // Re-throw for normal form submissions to use Laravel's default handling
        }

        // Make sure the company belongs to the user
        $company = Company::where('id', $validated['company_id'])
            ->where('user_id', $user->id)
            ->first();
            
        if (!$company) {
            Log::warning('Unauthorized company access attempt', [
                'user_id' => $user->id,
                'attempted_company_id' => $validated['company_id']
            ]);
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You can only log interactions for your own company.'
                ], 403);
            }
            
            return redirect()->route('dashboard')
                ->with('error', 'You can only log interactions for your own company.')
                ->withInput();
        }

        try {
            // Set defaults and add user_id
            $validated['interaction_date'] = $validated['interaction_date'] ?? now();
            $validated['user_id'] = $user->id;
            
            // Make sure the necessary fields exist
            if (empty($validated['type'])) {
                throw new \Exception('Interaction type is required.');
            }
            
            if (empty($validated['company_id'])) {
                throw new \Exception('Company is required.');
            }
            
            // Create the interaction
            $interaction = Interaction::create($validated);
            
            Log::info('Interaction created successfully', [
                'id' => $interaction->id,
                'user_id' => $user->id,
                'type' => $validated['type']
            ]);
            
            // Check if request is AJAX
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => "Interaction has been logged successfully!",
                    'interaction' => $interaction
                ]);
            }
            
            return redirect()->route('dashboard')
                ->with('success', "Interaction has been logged successfully!");
                
        } catch (\Exception $e) {
            Log::error('Error logging interaction: ' . $e->getMessage(), [
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Check if request is AJAX
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error logging interaction: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->route('dashboard')
                ->with('error', 'Error logging interaction: ' . $e->getMessage())
                ->withInput();
        }
    }
}