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
        // Get dashboard statistics with optimized queries
        $stats = [
            'total_companies' => Company::count(),
            'total_deals' => Deal::count(),
            'deals_closed_this_month' => Deal::where('stage', 'closed-won')
                ->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count(),
            'total_revenue' => Deal::where('stage', 'closed-won')->sum('value'),
            'pending_deals' => Deal::where('stage', 'new')->count(),
            'recent_interactions' => Interaction::with(['company:id,name', 'user:id,name'])
                ->latest()
                ->take(5)
                ->get(),
        ];
        
        // Get recent companies (optimized)
        $recent_companies = Company::latest()->take(5)->get();
        
        // Get recent deals with company relationship (optimized)
        $recent_deals = Deal::with('company:id,name')->latest()->take(5)->get();
        
        // Calculate conversion rate with safety check
        $total_deals = $stats['total_deals'];
        $closed_deals = Deal::where('stage', 'closed-won')->count();
        $stats['conversion_rate'] = $total_deals > 0 ? round(($closed_deals / $total_deals) * 100, 1) : 0;
        
        // Get monthly deal data for chart (optimized with single query)
        $monthly_deals = [];
        $start_date = Carbon::now()->subMonths(5)->startOfMonth();
        $end_date = Carbon::now()->endOfMonth();
        
        $monthly_data = Deal::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as deals')
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
        $companies = Company::latest()->paginate(15);
        return view('companies.index', compact('companies'));
    }

    public function deals()
    {
        $deals = Deal::with('company')->latest()->paginate(15);
        return view('deals.index', compact('deals'));
    }

    public function interactions()
    {
        $interactions = Interaction::with('company')->latest()->paginate(15);
        return view('interactions.index', compact('interactions'));
    }

    public function reports()
    {
        $stats = [
            'total_companies' => Company::count(),
            'total_deals' => Deal::count(),
            'total_revenue' => Deal::where('stage', 'closed-won')->sum('value'),
            'conversion_rate' => Deal::count() > 0 ? round((Deal::where('stage', 'closed-won')->count() / Deal::count()) * 100, 1) : 0,
        ];
        
        // Monthly data for charts
        $monthly_data = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthly_data[] = [
                'month' => $month->format('M Y'),
                'companies' => Company::whereYear('created_at', $month->year)->whereMonth('created_at', $month->month)->count(),
                'deals' => Deal::whereYear('created_at', $month->year)->whereMonth('created_at', $month->month)->count(),
                'revenue' => Deal::where('stage', 'closed-won')->whereYear('created_at', $month->year)->whereMonth('created_at', $month->month)->sum('value'),
            ];
        }
        
        return view('reports.index', compact('stats', 'monthly_data'));
    }

    public function settings()
    {
        return view('settings.index');
    }

    public function quickAddCompany(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:companies,name',
            'industry' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255|unique:companies,email',
            'phone' => 'nullable|string|max:20',
        ], [
            'name.unique' => 'A company with this name already exists.',
            'email.unique' => 'A company with this email already exists.',
            'email.email' => 'Please enter a valid email address.',
        ]);

        try {
            $company = Company::create($validated);
            
            return redirect()->route('dashboard')
                ->with('success', "Company '{$company->name}' has been added successfully!");
                
        } catch (\Exception $e) {
            Log::error('Error adding company: ' . $e->getMessage());
            
            return redirect()->route('dashboard')
                ->with('error', 'An unexpected error occurred. Please try again.')
                ->withInput();
        }
    }

    public function quickCreateDeal(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'value' => 'required|numeric|min:0|max:999999999.99',
            'company_id' => 'required|exists:companies,id',
            'stage' => 'nullable|string|in:new,qualified,proposal,negotiation,closed-won,closed-lost',
        ], [
            'value.min' => 'Deal value must be a positive number.',
            'value.max' => 'Deal value is too large.',
            'company_id.exists' => 'Selected company does not exist.',
        ]);

        try {
            // Set default stage and user
            $validated['stage'] = $validated['stage'] ?? 'new';
            $validated['user_id'] = Auth::check() ? Auth::id() : 1;

            $deal = Deal::create($validated);
            
            return redirect()->route('dashboard')
                ->with('success', "Deal '{$deal->title}' has been created successfully!");
                
        } catch (\Exception $e) {
            Log::error('Error creating deal: ' . $e->getMessage());
            
            return redirect()->route('dashboard')
                ->with('error', 'An unexpected error occurred. Please try again.')
                ->withInput();
        }
    }

    public function quickLogInteraction(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|in:call,email,meeting,demo,follow-up,other',
            'company_id' => 'required|exists:companies,id',
            'notes' => 'nullable|string|max:2000',
            'interaction_date' => 'nullable|date|before_or_equal:now',
        ], [
            'company_id.exists' => 'Selected company does not exist.',
            'interaction_date.before_or_equal' => 'Interaction date cannot be in the future.',
            'notes.max' => 'Notes cannot exceed 2000 characters.',
        ]);

        try {
            // Set defaults
            $validated['interaction_date'] = $validated['interaction_date'] ?? now();
            $validated['user_id'] = Auth::check() ? Auth::id() : 1;

            $interaction = Interaction::create($validated);
            
            return redirect()->route('dashboard')
                ->with('success', "Interaction has been logged successfully!");
                
        } catch (\Exception $e) {
            Log::error('Error logging interaction: ' . $e->getMessage());
            
            return redirect()->route('dashboard')
                ->with('error', 'An unexpected error occurred. Please try again.')
                ->withInput();
        }
    }
}