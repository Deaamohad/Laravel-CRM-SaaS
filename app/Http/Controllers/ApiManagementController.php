<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Deal;
use App\Models\Interaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiManagementController extends Controller
{
    public function index()
    {
        $apiEndpoints = [
            // Authentication endpoints
            'POST /api/login' => 'Login and get API token',
            'GET /api/user' => 'Get current user info',
            'POST /api/logout' => 'Logout and revoke token',
            
            // Token management
            'POST /api/tokens' => 'Create new API token',
            'GET /api/tokens' => 'List all user tokens',
            'DELETE /api/tokens/{id}' => 'Revoke specific token',
            
            // Companies API
            'GET /api/companies' => 'List all companies',
            'POST /api/companies' => 'Create new company',
            'GET /api/companies/{id}' => 'Get company details',
            'PUT /api/companies/{id}' => 'Update company',
            'DELETE /api/companies/{id}' => 'Delete company',
            
            // Deals API
            'GET /api/deals' => 'List all deals',
            'POST /api/deals' => 'Create new deal',
            'GET /api/deals/{id}' => 'Get deal details',
            
            // Interactions API
            'GET /api/interactions' => 'List all interactions',
            'POST /api/interactions' => 'Create new interaction',
            
            // Dashboard API
            'GET /api/stats' => 'Get dashboard statistics',
            'GET /api/recent-activities' => 'Get recent activities',
            'GET /api/dashboard-stats' => 'Get detailed dashboard stats',
        ];

        // Get the current user
        $user = \Illuminate\Support\Facades\Auth::user();
        
        $stats = [
            'total_companies' => Company::where('user_id', $user->id)->count(),
            'total_deals' => Deal::where('user_id', $user->id)->count(),
            'total_interactions' => Interaction::where('user_id', $user->id)->count(),
            'total_deal_value' => Deal::where('user_id', $user->id)->sum('value'),
        ];

        return view('api.management', compact('apiEndpoints', 'stats'));
    }
}
