<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    public function index()
    {
        // Get the current user
        $user = \Illuminate\Support\Facades\Auth::user();
        
        // Get companies associated with the user:
        // 1. Companies created by the user
        // 2. The company the user belongs to
        // 3. Companies that have deals created by the user
        // 4. Companies that have interactions created by the user
        $query = Company::where(function($q) use ($user) {
            // Companies user created or belongs to
            if ($user->company_id) {
                $q->where('id', $user->company_id)
                  ->orWhere('user_id', $user->id);
            } else {
                $q->where('user_id', $user->id);
            }
        })
        ->orWhereHas('deals', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })
        ->orWhereHas('interactions', function($q) use ($user) {
            $q->where('user_id', $user->id);
        });
        
        // Get distinct companies and paginate
        $companies = $query->distinct()->paginate(10);
        
        return view('companies.index', compact('companies'));
    }

    public function store(Request $request)
    {
        $validationRules = [
            'name' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ];
        
        // Contact validation removed
        
        $request->validate($validationRules);

        // Get the current user
        $user = \Illuminate\Support\Facades\Auth::user();
        
        // Create the company with all the valid fields
        $companyData = $request->only(['name', 'email', 'phone', 'address', 'industry', 'notes']);
        
        // Add the current user as the creator of the company
        $companyData['user_id'] = $user->id;
        
        // Create a new company record
        $company = Company::create($companyData);

        // Contact creation code removed

        return redirect()->route('companies.index')
            ->with('success', 'Company created successfully');
    }

    public function show(Company $company)
    {
        // Return JSON if it's an AJAX request
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json($company);
        }
        
        // Load interactions related to this company
        $interactions = $company->interactions()
            ->orderBy('interaction_date', 'desc')
            ->get();
            
        // Load deals related to this company
        $deals = $company->deals()
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('companies.show', compact('company', 'interactions', 'deals'));
    }
    
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
            'notes' => 'nullable|string'
        ]);

        $company->update($request->all());

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true, 
                'message' => 'Company updated successfully',
                'company' => $company
            ]);
        }

        return redirect()->route('companies.show', $company)
            ->with('success', 'Company updated successfully');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Company deleted successfully']);
        }
        
        return redirect()->route('companies.index')
            ->with('success', 'Company deleted successfully');
    }
}