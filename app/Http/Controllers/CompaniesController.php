<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    public function index()
    {
        // Filter companies by the logged-in user's company_id
        $user = \Illuminate\Support\Facades\Auth::user();
        $companies = Company::where('id', $user->company_id)->paginate(10);
        return view('companies.index', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500'
        ]);

        Company::create($request->all());

        return response()->json(['success' => true, 'message' => 'Company created successfully']);
    }

    public function show(Company $company)
    {
        return response()->json($company);
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500'
        ]);

        $company->update($request->all());

        return response()->json(['success' => true, 'message' => 'Company updated successfully']);
    }

    public function destroy(Company $company)
    {
        $company->delete();
        
        return response()->json(['success' => true, 'message' => 'Company deleted successfully']);
    }
}