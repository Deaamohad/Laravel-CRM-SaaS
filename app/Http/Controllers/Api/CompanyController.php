<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CompanyController extends Controller
{
    /**
     * Display a listing of companies with pagination and filtering.
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function index()
    {
        // Only show companies for authenticated users within their company scope
        $user = Auth::user();
        
        if (!$user || !$user->company_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        // Users should only see their own company
        $companies = Company::where('id', $user->company_id)->latest()->paginate(15);
        
        return response()->json([
            'success' => true,
            'message' => 'Companies retrieved successfully',
            'data' => $companies->items(),
            'meta' => [
                'current_page' => $companies->currentPage(),
                'last_page' => $companies->lastPage(),
                'per_page' => $companies->perPage(),
                'total' => $companies->total(),
            ]
        ]);
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

        return new CompanyResource($company);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        $user = Auth::user();
        
        // Check if user is authorized to view this company
        if (!$user || !$user->company_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        // In a multi-tenant app, users can only view their own company
        if ($company->id !== $user->company_id) {
            return response()->json([
                'error' => 'Access denied. You can only view your own company data.',
                'message' => 'Company not found or you do not have permission to access it.'
            ], 404); // Return 404 to not reveal that the company exists
        }
        
        return new CompanyResource($company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $user = Auth::user();
        
        // Check authorization
        if (!$user || $company->id !== $user->company_id) {
            return response()->json(['error' => 'Access denied'], 404);
        }
        
        $validated = $request->validate([
            'name'  => 'sometimes|string|max:30',
            'email' => 'sometimes|email|max:255',
            'phone' => 'sometimes|string|max:20',
        ]);

        $company->update($validated);

        return new CompanyResource($company);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $user = Auth::user();
        
        // Check authorization
        if (!$user || $company->id !== $user->company_id) {
            return response()->json(['error' => 'Access denied'], 404);
        }
        
        $company->delete();

        return response()->json(['message' => 'Company deleted successfully.']);
    }
}
