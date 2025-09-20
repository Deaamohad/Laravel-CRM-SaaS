<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Deal;
use App\Models\Interaction;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Development: Get user if authenticated, otherwise use dummy data
        $user = Auth::user();
        
        // Get dashboard statistics
        $stats = [
            'total_companies' => Company::count(),
            'total_deals' => Deal::count(),
            'deals_closed_this_month' => Deal::where('stage', 'closed')
                ->whereMonth('created_at', Carbon::now()->month)
                ->count(),
            'total_revenue' => Deal::where('stage', 'closed')->sum('value'),
            'pending_deals' => Deal::where('stage', 'new')->count(),
            'recent_interactions' => Interaction::latest()->take(5)->get(),
        ];
        
        // Get recent companies
        $recent_companies = Company::latest()->take(5)->get();
        
        // Get recent deals
        $recent_deals = Deal::with('company')->latest()->take(5)->get();
        
        // Calculate conversion rate
        $total_deals = Deal::count();
        $closed_deals = Deal::where('stage', 'closed')->count();
        $stats['conversion_rate'] = $total_deals > 0 ? round(($closed_deals / $total_deals) * 100, 1) : 0;
        
        // Get monthly deal data for chart
        $monthly_deals = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthly_deals[] = [
                'month' => $month->format('M'),
                'deals' => Deal::whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->count()
            ];
        }
        
        return view('dashboard.index', compact('stats', 'recent_companies', 'recent_deals', 'monthly_deals'));
    }

    public function quickAddCompany(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'industry' => 'nullable|string|max:255',
                'email' => 'nullable|email|max:255',
                'phone' => 'nullable|string|max:255',
            ]);

            $company = Company::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Company added successfully',
                'company' => $company
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding company: ' . $e->getMessage()
            ], 500);
        }
    }

    public function quickCreateDeal(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'value' => 'required|numeric|min:0',
                'company_id' => 'required|exists:companies,id',
                'stage' => 'nullable|string|in:new,qualified,proposal,negotiation,closed',
            ]);

            // Set default stage if not provided
            $validated['stage'] = $validated['stage'] ?? 'new';

            $deal = Deal::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Deal created successfully',
                'deal' => $deal
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating deal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function quickLogInteraction(Request $request)
    {
        try {
            $validated = $request->validate([
                'type' => 'required|string|in:call,email,meeting,demo,follow-up,other',
                'company_id' => 'required|exists:companies,id',
                'notes' => 'nullable|string',
                'interaction_date' => 'nullable|date',
            ]);

            // Set default interaction date if not provided
            $validated['interaction_date'] = $validated['interaction_date'] ?? now();

            $interaction = Interaction::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Interaction logged successfully',
                'interaction' => $interaction
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error logging interaction: ' . $e->getMessage()
            ], 500);
        }
    }
}