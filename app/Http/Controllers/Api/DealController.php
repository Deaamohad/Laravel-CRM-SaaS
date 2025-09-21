<?php

namespace App\Http\Controllers\Api;

use App\Models\Deal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deals = Deal::with('company')->latest()->paginate(15);
        return response()->json($deals);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'title' => 'required|string|max:255',
            'value' => 'required|numeric|min:0',
            'status' => 'required|in:lead,proposal,negotiation,closed_won,closed_lost',
            'priority' => 'required|in:low,medium,high',
            'expected_close_date' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $deal = Deal::create($validated);
        return response()->json($deal->load('company'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Deal $deal)
    {
        return response()->json($deal->load('company'));
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
