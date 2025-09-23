<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Interaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InteractionController extends Controller
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
        
        // Get interactions that the user has access to
        $query = Interaction::with(['company', 'deal']);
        
        if ($user->company_id) {
            // User belongs to a company - show interactions from their company
            $query->where('company_id', $user->company_id);
        } else {
            // User doesn't belong to a company - show interactions they created
            $query->where('user_id', $user->id);
        }
        
        $interactions = $query->latest()->paginate(15);
            
        return response()->json($interactions);
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
            'deal_id' => 'nullable|exists:deals,id',
            'type' => 'required|in:call,email,meeting,demo,follow-up,other',
            'notes' => 'nullable|string|max:2000',
            'interaction_date' => 'nullable|date|before_or_equal:now',
        ]);

        // Check if user has access to the selected company
        if (!$this->checkCompanyAccess($validated['company_id'], $user)) {
            return response()->json(['error' => 'Access denied to selected company'], 403);
        }
        
        // If deal_id is provided, verify access
        if (isset($validated['deal_id'])) {
            $deal = Deal::find($validated['deal_id']);
            if ($deal && !$this->checkDealAccess($deal, $user)) {
                return response()->json(['error' => 'Access denied to selected deal'], 403);
            }
        }

        $validated['user_id'] = $user->id;
        $validated['interaction_date'] = $validated['interaction_date'] ?? now();

        $interaction = Interaction::create($validated);
        return response()->json([
            'success' => true,
            'message' => 'Interaction created successfully',
            'interaction' => $interaction->load(['company', 'deal'])
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Interaction $interaction)
    {
        $user = Auth::user();
        
        // Check if user is authenticated
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        // Check if user has access to this interaction
        if (!$this->checkInteractionAccess($interaction, $user)) {
            return response()->json(['error' => 'Access denied'], 403);
        }
        
        return response()->json($interaction->load(['company', 'deal']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Interaction $interaction)
    {
        $user = Auth::user();
        
        // Check if user is authenticated
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        // Check if user has access to this interaction
        if (!$this->checkInteractionAccess($interaction, $user)) {
            return response()->json(['error' => 'Access denied'], 403);
        }
        
        $validated = $request->validate([
            'company_id' => 'sometimes|exists:companies,id',
            'deal_id' => 'nullable|exists:deals,id',
            'type' => 'sometimes|in:call,email,meeting,demo,follow-up,other',
            'notes' => 'nullable|string|max:2000',
            'interaction_date' => 'nullable|date|before_or_equal:now',
        ]);
        
        // If company_id is being updated, verify access
        if (isset($validated['company_id'])) {
            if (!$this->checkCompanyAccess($validated['company_id'], $user)) {
                return response()->json(['error' => 'Access denied to selected company'], 403);
            }
        }
        
        // If deal_id is being updated, verify access
        if (isset($validated['deal_id'])) {
            $deal = Deal::find($validated['deal_id']);
            if ($deal && !$this->checkDealAccess($deal, $user)) {
                return response()->json(['error' => 'Access denied to selected deal'], 403);
            }
        }
        
        $interaction->update($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Interaction updated successfully',
            'interaction' => $interaction->load(['company', 'deal'])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Interaction $interaction)
    {
        $user = Auth::user();
        
        // Check if user is authenticated
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        // Check if user has access to this interaction
        if (!$this->checkInteractionAccess($interaction, $user)) {
            return response()->json(['error' => 'Access denied'], 403);
        }
        
        $interaction->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Interaction deleted successfully'
        ]);
    }
    
    /**
     * Check if user has access to a specific interaction
     */
    private function checkInteractionAccess(Interaction $interaction, $user)
    {
        // User can access interactions they created or interactions from their company
        return $interaction->user_id === $user->id || 
               ($user->company_id && $interaction->company_id === $user->company_id) ||
               $this->checkCompanyAccess($interaction->company_id, $user);
    }
    
    /**
     * Check if user has access to a specific company
     */
    private function checkCompanyAccess($companyId, $user)
    {
        $company = \App\Models\Company::where('id', $companyId)
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
    
    /**
     * Check if user has access to a specific deal
     */
    private function checkDealAccess($deal, $user)
    {
        // User can access deals they created or deals from their company
        return $deal->user_id === $user->id || 
               ($user->company_id && $deal->company_id === $user->company_id) ||
               $this->checkCompanyAccess($deal->company_id, $user);
    }
}
