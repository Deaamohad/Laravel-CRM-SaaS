<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Interaction;
use Illuminate\Http\Request;

class InteractionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        
        if (!$user || !$user->company_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        // Only show interactions from the user's company
        $interactions = Interaction::with(['company', 'deal'])
            ->where('company_id', $user->company_id)
            ->latest()
            ->paginate(15);
            
        return response()->json($interactions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'deal_id' => 'nullable|exists:deals,id',
            'type' => 'required|in:call,email,meeting,note',
            'subject' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'date' => 'required|date',
        ]);

        $interaction = Interaction::create($validated);
        return response()->json($interaction->load(['company', 'deal']), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
