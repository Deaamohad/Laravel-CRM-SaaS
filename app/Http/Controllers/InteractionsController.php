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
        // Get the current user
        $user = Auth::user();
        
        // Get only interactions associated with the current user or their company
        $interactions = Interaction::with(['company', 'user'])
            ->where(function($query) use ($user) {
                $query->where('user_id', $user->id)
                      ->orWhere('company_id', $user->company_id);
            })
            ->latest('interaction_date')
            ->paginate(10);
            
        // Show ALL companies that the user has access to:
        // 1. Companies created by the user
        // 2. The company the user belongs to
        // 3. Companies that have deals created by the user
        // 4. Companies that have interactions created by the user
        $companies = Company::where(function($query) use ($user) {
            // Companies user created or belongs to
            if ($user->company_id) {
                $query->where('id', $user->company_id)
                      ->orWhere('user_id', $user->id);
            } else {
                $query->where('user_id', $user->id);
            }
        })
        ->orWhereHas('deals', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->orWhereHas('interactions', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->orderBy('name')
        ->distinct()
        ->get();
        
        return view('interactions.index', compact('interactions', 'companies'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'company_id' => 'required|exists:companies,id',
                'type' => 'required|in:call,email,meeting,demo,follow-up,other',
                'interaction_date' => 'nullable|date',
                'notes' => 'nullable|string|max:2000'
            ]);
            
            // No authorization check needed as users can log interactions for any company
            $user = Auth::user();
    
            $data = $request->only(['company_id', 'type', 'interaction_date', 'notes']);
            $data['user_id'] = $user->id; // Assign the authenticated user
            
            // Set default interaction date if not provided
            if (empty($data['interaction_date'])) {
                $data['interaction_date'] = now();
            }
    
            $interaction = Interaction::create($data);
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Interaction logged successfully',
                    'interaction' => $interaction
                ]);
            }
            
            // Check if the redirect_back flag is set or if coming from the company page
            if ($request->has('redirect_back') || (request()->header('referer') && strpos(request()->header('referer'), 'companies/' . $data['company_id']) !== false)) {
                return redirect()->route('companies.show', $data['company_id'])
                    ->with('success', 'Interaction logged successfully.');
            }
    
            return redirect()->route('interactions.index')
                ->with('success', 'Interaction logged successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e; // Re-throw for normal form submissions
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error logging interaction: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->route('interactions.index')
                ->with('error', 'Error logging interaction: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(Interaction $interaction)
    {
        // Security check - ensure the interaction belongs to the user or user's company
        $user = Auth::user();
        if ($interaction->user_id !== $user->id && $interaction->company_id != $user->company_id) {
            abort(403, 'Unauthorized action.');
        }
        
        // Check if request wants JSON
        if (request()->expectsJson() || request()->wantsJson() || request()->ajax()) {
            return response()->json($interaction);
        }
        
        // Otherwise show the view
        $interaction->load(['company', 'user']);
        return view('interactions.show', compact('interaction'));
    }

    public function update(Request $request, Interaction $interaction)
    {
        try {
            $user = Auth::user();
            
            // Check if user has permission to update this interaction
            if ($interaction->user_id !== $user->id && $interaction->company_id !== $user->company_id) {
                abort(403, 'Unauthorized action.');
            }
            
            $request->validate([
                'company_id' => 'required|exists:companies,id',
                'type' => 'required|in:call,email,meeting,demo,follow-up,other',
                'interaction_date' => 'nullable|date',
                'notes' => 'nullable|string|max:2000'
            ]);
            
            // Ensure the company_id is valid - either:
            // 1. A company the user created, or
            // 2. The user's own company
            $companyAccess = Company::where('id', $request->company_id)
                ->where(function($query) use ($user) {
                    $query->where('user_id', $user->id)
                        ->orWhere('id', $user->company_id);
                })->exists();
                
            if (!$companyAccess) {
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json(['success' => false, 'message' => 'You can only assign interactions to companies you have access to'], 403);
                }
                return redirect()->back()->with('error', 'You can only assign interactions to companies you have access to');
            }
    
            $data = $request->only(['company_id', 'type', 'interaction_date']);
            
            // Handle both notes and description fields - they refer to the same data
            if ($request->has('notes')) {
                $data['notes'] = $request->notes;
            } elseif ($request->has('description')) {
                $data['notes'] = $request->description;
            }
            
            // Don't update user_id - keep original creator
            
            // Set default interaction date if not provided
            if (empty($data['interaction_date'])) {
                $data['interaction_date'] = now();
            }
    
            $interaction->update($data);
    
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'Interaction updated successfully']);
            }
            
            // Check if the redirect_back flag is set
            if ($request->has('redirect_back')) {
                // If coming from company page, redirect back there
                return redirect()->route('companies.show', $data['company_id'])
                    ->with('success', 'Interaction updated successfully.');
            }
            
            return redirect()->route('interactions.index')->with('success', 'Interaction updated successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e; // Re-throw for normal form submissions
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Error updating interaction: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->route('interactions.index')
                ->with('error', 'Error updating interaction: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Interaction $interaction)
    {
        // No authorization check needed as users can delete any interaction
        $user = Auth::user();
        
        // Store company_id before deleting the interaction
        $companyId = $interaction->company_id;
        
        $interaction->delete();
        
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Interaction deleted successfully']);
        }
        
        // Check if we should redirect back to the company page
        if (request()->has('redirect_back')) {
            return redirect()->route('companies.show', $companyId)
                ->with('success', 'Interaction deleted successfully.');
        }
        
        // Default redirect to interactions index
        return redirect()->route('interactions.index')->with('success', 'Interaction deleted successfully');
    }
}