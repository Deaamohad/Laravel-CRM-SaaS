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
    public function index(Request $request)
    {
        // Only show companies for authenticated users
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        // Get query parameters for filtering and pagination
        $perPage = $request->get('per_page', 15);
        $search = $request->get('search');
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        
        // Start building the query with proper authorization - only user's companies
        $query = Company::where('user_id', $user->id);
        
        // Apply search filter
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('industry', 'like', "%{$search}%");
            });
        }
        
        // Apply sorting
        $query->orderBy($sortBy, $sortOrder);
        
        // Get paginated results
        $companies = $query->distinct()->paginate($perPage);
        
        return response()->json([
            'success' => true,
            'message' => 'Companies retrieved successfully',
            'data' => $companies->items(),
            'meta' => [
                'current_page' => $companies->currentPage(),
                'last_page' => $companies->lastPage(),
                'per_page' => $companies->perPage(),
                'total' => $companies->total(),
                'from' => $companies->firstItem(),
                'to' => $companies->lastItem(),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        // Check if user is authenticated
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:500',
            'industry' => 'nullable|string|max:100',
        ]);

        $validated['user_id'] = $user->id;
        $company = Company::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Company created successfully',
            'company' => new CompanyResource($company)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        $user = Auth::user();
        
        // Check if user is authenticated
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        // Check if user has access to this company
        if (!$this->checkCompanyAccess($company, $user)) {
            return response()->json(['error' => 'Access denied'], 403);
        }
        
        return new CompanyResource($company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $user = Auth::user();
        
        // Check if user is authenticated
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        $validated = $request->validate([
            'name'  => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255',
            'phone' => 'sometimes|string|max:20',
            'address' => 'sometimes|string|max:500',
            'industry' => 'sometimes|string|max:100',
        ]);

        // Check if user has access to this company
        if (!$this->checkCompanyAccess($company, $user)) {
            return response()->json(['error' => 'Access denied'], 403);
        }

        $company->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Company updated successfully',
            'company' => new CompanyResource($company)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $user = Auth::user();
        
        // Check if user is authenticated
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        // Check if user has access to this company
        if (!$this->checkCompanyAccess($company, $user)) {
            return response()->json(['error' => 'Access denied'], 403);
        }

        $company->delete();

        return response()->json([
            'success' => true,
            'message' => 'Company deleted successfully'
        ]);
    }
    
    /**
     * Check if user has access to a specific company
     */
    private function checkCompanyAccess(Company $company, $user)
    {
        // User can access companies they created, belong to, or have deals/interactions with
        return $company->user_id === $user->id || 
               ($user->company_id && $company->id === $user->company_id) ||
               $company->deals()->where('user_id', $user->id)->exists() ||
               $company->interactions()->where('user_id', $user->id)->exists();
    }
}
