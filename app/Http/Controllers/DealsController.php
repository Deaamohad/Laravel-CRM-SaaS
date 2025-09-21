<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DealsController extends Controller
{
    public function index()
    {
        // Get the current user's company ID
        $companyId = Auth::user()->company_id;
        
        // Filter deals by the user's company
        $deals = Deal::with('company')
            ->whereHas('company', function ($query) use ($companyId) {
                $query->where('id', $companyId);
            })
            ->paginate(10);
            
        // Only show companies that belong to the user's company (should be just one)
        $companies = Company::where('id', $companyId)->get();
        
        return view('deals.index', compact('deals', 'companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'amount' => 'required|numeric|min:0',
            'stage' => 'required|in:lead,qualified,proposal,negotiation,closed-won,closed-lost'
        ]);

        $data = $request->only(['title', 'company_id', 'stage']);
        $data['user_id'] = Auth::id(); // Assign the authenticated user
        $data['value'] = $request->amount; // Map amount to value field in database

        Deal::create($data);

        return response()->json(['success' => true, 'message' => 'Deal created successfully']);
    }

    public function show(Deal $deal)
    {
        $deal->load('company');
        return response()->json($deal);
    }

    public function update(Request $request, Deal $deal)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'amount' => 'required|numeric|min:0',
            'stage' => 'required|in:lead,qualified,proposal,negotiation,closed-won,closed-lost'
        ]);

        $data = $request->only(['title', 'company_id', 'stage']);
        $data['value'] = $request->amount; // Map amount to value field in database
        // Don't update user_id - keep original creator

        $deal->update($data);

        return response()->json(['success' => true, 'message' => 'Deal updated successfully']);
    }

    public function destroy(Deal $deal)
    {
        $deal->delete();
        
        return response()->json(['success' => true, 'message' => 'Deal deleted successfully']);
    }
}