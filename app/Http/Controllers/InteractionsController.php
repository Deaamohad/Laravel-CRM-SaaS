<?php

namespace App\Http\Controllers;

use App\Models\Interaction;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InteractionsController extends Controller
{
    public function index()
    {
        // Get the current user's company ID
        $companyId = Auth::user()->company_id;
        
        // Filter interactions by the user's company
        $interactions = Interaction::with(['company', 'user'])
            ->whereHas('company', function ($query) use ($companyId) {
                $query->where('id', $companyId);
            })
            ->latest('interaction_date')
            ->paginate(10);
            
        // Only show companies that belong to the user's company (should be just one)
        $companies = Company::where('id', $companyId)->get();
        
        return view('interactions.index', compact('interactions', 'companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'type' => 'required|in:call,email,meeting,note',
            'interaction_date' => 'required|date',
            'notes' => 'required|string|max:1000'
        ]);

        $data = $request->only(['company_id', 'type', 'interaction_date', 'notes']);
        $data['user_id'] = Auth::id(); // Assign the authenticated user

        Interaction::create($data);

        return response()->json(['success' => true, 'message' => 'Interaction logged successfully']);
    }

    public function show(Interaction $interaction)
    {
        $interaction->load(['company', 'user']);
        return response()->json($interaction);
    }

    public function update(Request $request, Interaction $interaction)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'type' => 'required|in:call,email,meeting,note',
            'interaction_date' => 'required|date',
            'notes' => 'required|string|max:1000'
        ]);

        $data = $request->only(['company_id', 'type', 'interaction_date', 'notes']);
        // Don't update user_id - keep original creator

        $interaction->update($data);

        return response()->json(['success' => true, 'message' => 'Interaction updated successfully']);
    }

    public function destroy(Interaction $interaction)
    {
        $interaction->delete();
        
        return response()->json(['success' => true, 'message' => 'Interaction deleted successfully']);
    }
}