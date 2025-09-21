<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Deal;
use App\Models\Interaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function global(Request $request)
    {
        $query = $request->get('q', '');
        $user = Auth::user();
        
        if (empty($query) || !$user || !$user->company_id) {
            $results = [
                'companies' => collect(),
                'deals' => collect(),
                'interactions' => collect(),
                'total' => 0
            ];
            
            if ($request->wantsJson()) {
                return response()->json($results);
            }
            
            return view('search.results', compact('results'));
        }

        // Search companies - show all companies that match the query
        $companies = Company::where(function($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%")
              ->orWhere('email', 'LIKE', "%{$query}%");
        })->limit(5)->get(['id', 'name', 'email', 'phone', 'created_at']);

        // Search contacts - find contacts created by this user OR in their company
        $contacts = Contact::where(function($q) use ($user) {
                $q->where('user_id', $user->id) // Contacts created by this user
                  ->orWhere('company_id', $user->company_id); // OR contacts in their company
            })
            ->where(function($q) use ($query) {
                $q->where('first_name', 'LIKE', "%{$query}%")
                  ->orWhere('last_name', 'LIKE', "%{$query}%")
                  ->orWhere('email', 'LIKE', "%{$query}%")
                  ->orWhere('position', 'LIKE', "%{$query}%");
            })
            ->with('company:id,name')
            ->limit(5)
            ->get(['id', 'first_name', 'last_name', 'email', 'position', 'company_id', 'created_at']);                // Search deals - find deals created by this user OR in their company
        $deals = Deal::where(function($q) use ($user) {
                $q->where('user_id', $user->id) // Deals created by this user
                  ->orWhere('company_id', $user->company_id); // OR deals in their company
            })
            ->where(function($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%");
            })
            ->get(['id', 'title', 'value', 'stage', 'company_id', 'created_at']);

        // Search interactions - find interactions created by this user OR in their company
        $interactions = Interaction::where(function($q) use ($user) {
                $q->where('user_id', $user->id) // Interactions created by this user
                  ->orWhere('company_id', $user->company_id); // OR interactions in their company
            })
            ->where(function($q) use ($query) {
                $q->where('type', 'LIKE', "%{$query}%")
                  ->orWhere('notes', 'LIKE', "%{$query}%");
            })
            ->when($request->filled('date_from'), function ($q) use ($request) {
                $q->where('created_at', '>=', $request->date_from);
            })
            ->when($request->filled('date_to'), function ($q) use ($request) {
                $q->where('created_at', '<=', $request->date_to . ' 23:59:59');
            })
            ->with('company:id,name')
            ->limit($request->wantsJson() ? 5 : 20)
            ->get(['id', 'type', 'notes', 'interaction_date', 'company_id', 'created_at']);

        $total = $companies->count() + $contacts->count() + $deals->count() + $interactions->count();

        $results = [
            'companies' => $companies,
            'contacts' => $contacts,
            'deals' => $deals,
            'interactions' => $interactions,
            'total' => $total,
            'query' => $query
        ];

        if ($request->wantsJson()) {
            return response()->json($results);
        }

        return view('search.results', compact('results'));
    }

    public function companies(Request $request)
    {
        $user = Auth::user();
        if (!$user || !$user->company_id) {
            return redirect()->route('login');
        }

        // In a multi-tenant system, users should typically see all companies
        // or just their own company - depending on business requirements
        $query = Company::query();

        // Search by name, email
        if ($search = $request->get('search')) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        // Filter by industry
        if ($industry = $request->get('industry')) {
            // Industry field doesn't exist in companies table - remove this filter
        }

        // Filter by date range
        if ($from = $request->get('from_date')) {
            $query->whereDate('created_at', '>=', $from);
        }
        if ($to = $request->get('to_date')) {
            $query->whereDate('created_at', '<=', $to);
        }

        // Sort options
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        $query->orderBy($sort, $direction);

        $companies = $query->paginate(10);

        // Get unique industries for filter dropdown - industry field doesn't exist
        $industries = collect(); // Empty collection since no industry field

        return view('companies.index', compact('companies', 'industries'));
    }

    public function deals(Request $request)
    {
        $user = Auth::user();
        if (!$user || !$user->company_id) {
            return redirect()->route('login');
        }

        $query = Deal::where(function($q) use ($user) {
            $q->where('user_id', $user->id) // Deals created by this user
              ->orWhere('company_id', $user->company_id); // OR deals in their company
        })->with('company');

        // Search by title
        if ($search = $request->get('search')) {
            $query->where('title', 'LIKE', "%{$search}%");
        }

        // Filter by stage
        if ($stage = $request->get('stage')) {
            $query->where('stage', $stage);
        }

        // Filter by value range
        if ($minValue = $request->get('min_value')) {
            $query->where('value', '>=', $minValue);
        }
        if ($maxValue = $request->get('max_value')) {
            $query->where('value', '<=', $maxValue);
        }

        // Filter by company
        if ($companyId = $request->get('company_id')) {
            $query->where('company_id', $companyId);
        }

        // Filter by date range
        if ($from = $request->get('from_date')) {
            $query->whereDate('created_at', '>=', $from);
        }
        if ($to = $request->get('to_date')) {
            $query->whereDate('created_at', '<=', $to);
        }

        // Sort options
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        $query->orderBy($sort, $direction);

        $deals = $query->paginate(10);

        // Get data for filter dropdowns
        $stages = ['new', 'qualified', 'proposal', 'negotiation', 'closed', 'lost'];
        $companies = Company::orderBy('name')
            ->get(['id', 'name']);

        return view('deals.index', compact('deals', 'stages', 'companies'));
    }

    public function interactions(Request $request)
    {
        $user = Auth::user();
        if (!$user || !$user->company_id) {
            return redirect()->route('login');
        }

        $query = Interaction::where(function($q) use ($user) {
            $q->where('user_id', $user->id) // Interactions created by this user
              ->orWhere('company_id', $user->company_id); // OR interactions in their company
        })->with('company');

        // Search by type, notes
        if ($search = $request->get('search')) {
            $query->where(function($q) use ($search) {
                $q->where('type', 'LIKE', "%{$search}%")
                  ->orWhere('notes', 'LIKE', "%{$search}%");
            });
        }

        // Filter by type
        if ($type = $request->get('type')) {
            $query->where('type', $type);
        }

        // Filter by company
        if ($companyId = $request->get('company_id')) {
            $query->where('company_id', $companyId);
        }

        // Filter by date range
        if ($from = $request->get('from_date')) {
            $query->whereDate('interaction_date', '>=', $from);
        }
        if ($to = $request->get('to_date')) {
            $query->whereDate('interaction_date', '<=', $to);
        }

        // Sort options
        $sort = $request->get('sort', 'interaction_date');
        $direction = $request->get('direction', 'desc');
        $query->orderBy($sort, $direction);

        $interactions = $query->paginate(10);

        // Get data for filter dropdowns
        $types = ['call', 'email', 'meeting', 'demo', 'follow-up', 'other'];
        $companies = Company::orderBy('name')
            ->get(['id', 'name']);

        return view('interactions.index', compact('interactions', 'types', 'companies'));
    }

    public function contacts(Request $request)
    {
        $user = Auth::user();
        if (!$user || !$user->company_id) {
            return redirect()->route('login');
        }

        $query = Contact::where(function($q) use ($user) {
            $q->where('user_id', $user->id) // Contacts created by this user
              ->orWhere('company_id', $user->company_id); // OR contacts in their company
        })->with(['company', 'user']);

        // Search by name, email, position
        if ($search = $request->get('search')) {
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'LIKE', "%{$search}%")
                  ->orWhere('last_name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('position', 'LIKE', "%{$search}%");
            });
        }

        // Filter by company
        if ($companyId = $request->get('company_id')) {
            $query->where('company_id', $companyId);
        }

        // Filter by position
        if ($position = $request->get('position')) {
            $query->where('position', 'LIKE', "%{$position}%");
        }

        // Filter by date range
        if ($from = $request->get('from_date')) {
            $query->whereDate('created_at', '>=', $from);
        }
        if ($to = $request->get('to_date')) {
            $query->whereDate('created_at', '<=', $to);
        }

        // Sort options
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');
        $query->orderBy($sort, $direction);

        $contacts = $query->paginate(10);

        // Get data for filter dropdowns
        $companies = Company::orderBy('name')
            ->get(['id', 'name']);

        return view('contacts.index', compact('contacts', 'companies'));
    }
}
