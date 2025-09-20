<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use COM;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Company::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:30',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $company = Company::create($validated);

        return $company;
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return $company;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'name'  => 'sometimes|string|max:30',
            'email' => 'sometimes|email|max:255',
            'phone' => 'sometimes|string|max:20',
        ]);

        $company->update($validated);

        return $company;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return response()->json(['message' => 'Company deleted successfully.']);
    }
}
