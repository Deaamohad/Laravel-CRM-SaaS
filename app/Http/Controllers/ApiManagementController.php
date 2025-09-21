<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Deal;
use App\Models\Interaction;
use Illuminate\Http\Request;

class ApiManagementController extends Controller
{
    public function index()
    {
        $apiEndpoints = [
            'GET /api/companies' => 'List all companies',
            'POST /api/companies' => 'Create new company',
            'GET /api/companies/{id}' => 'Get company details',
            'PUT /api/companies/{id}' => 'Update company',
            'DELETE /api/companies/{id}' => 'Delete company',
            'GET /api/deals' => 'List all deals',
            'POST /api/deals' => 'Create new deal',
            'GET /api/deals/{id}' => 'Get deal details',
            'GET /api/interactions' => 'List all interactions',
            'POST /api/interactions' => 'Create new interaction',
            'GET /api/stats' => 'Get dashboard statistics',
        ];

        $stats = [
            'total_companies' => Company::count(),
            'total_deals' => Deal::count(),
            'total_interactions' => Interaction::count(),
            'total_deal_value' => Deal::sum('value'),
        ];

        return view('api.management', compact('apiEndpoints', 'stats'));
    }
}
