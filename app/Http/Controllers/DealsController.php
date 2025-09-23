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
        // Get the current user
        $user = Auth::user();
        
        // Get deals created by the current user
        $deals = Deal::with('company')
            ->where('user_id', $user->id)
            ->latest('created_at')
            ->paginate(10);
            
        // Get companies created by the user
        $companies = Company::where('user_id', $user->id)
            ->orderBy('name')
            ->get();
        
        return view('deals.index', compact('deals', 'companies'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'company_id' => 'required|exists:companies,id',
                'amount' => 'required|numeric|min:0',
                'stage' => 'required|in:lead,qualified,proposal,negotiation,closed-won,closed-lost'
            ]);
            
            // No security check needed as users can create deals for any company
            $user = Auth::user();

            $data = $request->only(['title', 'company_id', 'stage']);
            $data['user_id'] = $user->id; // Assign the authenticated user
            $data['value'] = $request->amount; // Map amount to value field in database

            $deal = Deal::create($data);
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Deal created successfully',
                    'deal' => $deal
                ]);
            }
            
            // Check if the redirect_back flag is set or if coming from the company page
            if ($request->has('redirect_back') || (request()->header('referer') && strpos(request()->header('referer'), 'companies/' . $data['company_id']) !== false)) {
                // If coming from company page, redirect back there
                return redirect()->route('companies.show', $data['company_id'])
                    ->with('success', 'Deal created successfully.');
            }
            
            // Default redirect to deals index
            return redirect()->route('deals.index')
                ->with('success', 'Deal created successfully');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error creating deal: ' . $e->getMessage());
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->route('deals.index')
                ->with('error', 'Error: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(Deal $deal)
    {
        // Security check - ensure the deal belongs to the user's company or was created by the user
        $user = Auth::user();
        if ($deal->company_id != $user->company_id && $deal->user_id != $user->id) {
            abort(403, 'Unauthorized action.');
        }
        
        // Ensure the company data is fully loaded
        $deal->load('company');
        
        // Get available companies for the dropdown (only user's companies)
        $companies = Company::where('user_id', $user->id)
        ->orderBy('name')
        ->distinct()
        ->get();
        
        // Include companies with the response if needed by the frontend
        $response = $deal->toArray();
        $response['available_companies'] = $companies;
        
        return response()->json($deal);
    }

    public function update(Request $request, Deal $deal)
    {
        $user = Auth::user();
        
        // Check if user has permission to update this deal
        if ($deal->user_id !== $user->id && $deal->company_id !== $user->company_id) {
            abort(403, 'Unauthorized action.');
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'amount' => 'required|numeric|min:0',
            'stage' => 'required|in:lead,qualified,proposal,negotiation,closed-won,closed-lost'
        ]);
        
        // Ensure the company_id is valid - only companies the user created
        $companyAccess = Company::where('id', $request->company_id)
            ->where('user_id', $user->id)
            ->exists();
            
        if (!$companyAccess) {
            return response()->json(['success' => false, 'message' => 'You can only assign deals to companies you have access to'], 403);
        }

        $data = $request->only(['title', 'company_id', 'stage']);
        $data['value'] = $request->amount; // Map amount to value field in database
        // Don't update user_id - keep original creator

        $deal->update($data);

        // Check if request is AJAX or wants JSON
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Deal updated successfully']);
        }
        
        // Check if the redirect_back flag is set or if coming from the company page
        if ($request->has('redirect_back')) {
            // If coming from company page, redirect back there
            return redirect()->route('companies.show', $data['company_id'])
                ->with('success', 'Deal updated successfully.');
        }
        
        // For regular form submissions, redirect with a flash message
        return redirect()->route('deals.index')->with('success', 'Deal updated successfully');
    }

    public function destroy(Deal $deal)
    {
        // No authorization check needed as users can delete any deal
        $user = Auth::user();
        
        // Store company_id before deleting the deal
        $companyId = $deal->company_id;
        
        $deal->delete();
        
        // Check if request is AJAX or wants JSON
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Deal deleted successfully']);
        }
        
        // Check if we should redirect back to the company page
        if (request()->has('redirect_back')) {
            return redirect()->route('companies.show', $companyId)
                ->with('success', 'Deal deleted successfully.');
        }
        
        // For regular form submissions, redirect with a flash message
        return redirect()->route('deals.index')->with('success', 'Deal deleted successfully');
    }
}