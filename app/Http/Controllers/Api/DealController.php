<?php

namespace App\Http\Controllers\Api;

use App\Models\Deal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Check if user is authenticated
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        // Get deals that the user has access to
        $query = Deal::with('company');
        
        // Show only deals the user created
        $query->where('user_id', $user->id);
        
        $deals = $query->latest()->paginate(15);
            
        return response()->json($deals);
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
            'company_id' => 'required|exists:companies,id',
            'title' => 'required|string|max:255',
            'value' => 'required|numeric|min:0',
            'stage' => 'required|in:lead,qualified,proposal,negotiation,closed-won,closed-lost',
        ]);

        // Check if user has access to the selected company
        if (!$this->checkCompanyAccess($validated['company_id'], $user)) {
            return response()->json(['error' => 'Access denied to selected company'], 403);
        }

        $validated['user_id'] = $user->id;

        $deal = Deal::create($validated);
        return response()->json([
            'success' => true,
            'message' => 'Deal created successfully',
            'deal' => $deal->load('company')
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Deal $deal)
    {
        $user = Auth::user();
        
        // Check if user is authenticated
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        // Check if user has access to this deal
        if (!$this->checkDealAccess($deal, $user)) {
            return response()->json(['error' => 'Access denied'], 403);
        }
        
        return response()->json($deal->load('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deal $deal)
    {
        $user = Auth::user();
        
        // Check if user is authenticated
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        // Check if user has access to this deal
        if (!$this->checkDealAccess($deal, $user)) {
            return response()->json(['error' => 'Access denied'], 403);
        }
        
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'value' => 'sometimes|numeric|min:0',
            'stage' => 'sometimes|in:lead,qualified,proposal,negotiation,closed-won,closed-lost',
            'company_id' => 'sometimes|exists:companies,id',
        ]);
        
        // If company_id is being updated, verify access
        if (isset($validated['company_id'])) {
            if (!$this->checkCompanyAccess($validated['company_id'], $user)) {
                return response()->json(['error' => 'Access denied to selected company'], 403);
            }
        }
        
        $deal->update($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Deal updated successfully',
            'deal' => $deal->load('company')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deal $deal)
    {
        $user = Auth::user();
        
        // Check if user is authenticated
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        // Check if user has access to this deal
        if (!$this->checkDealAccess($deal, $user)) {
            return response()->json(['error' => 'Access denied'], 403);
        }
        
        $deal->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Deal deleted successfully'
        ]);
    }
    
    /**
     * Check if user has access to a specific deal
     */
    private function checkDealAccess(Deal $deal, $user)
    {
        // User can access deals they created or deals from their company
        return $deal->user_id === $user->id || 
               ($user->company_id && $deal->company_id === $user->company_id) ||
               $this->checkCompanyAccess($deal->company_id, $user);
    }
    
    /**
     * Check if user has access to a specific company
     */
    private function checkCompanyAccess($companyId, $user)
    {
        $company = Company::where('id', $companyId)
            ->where(function($query) use ($user) {
                $query->where('user_id', $user->id)
                      ->orWhere('id', $user->company_id);
            })
            ->orWhereHas('deals', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->orWhereHas('interactions', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->first();
            
        return $company !== null;
    }
}
