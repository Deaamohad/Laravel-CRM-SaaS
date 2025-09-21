<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the current user's company ID
        $companyId = Auth::user()->company_id;
        
        // Filter contacts by the user's company
        $contacts = Contact::with(['company', 'user'])
            ->whereHas('company', function ($query) use ($companyId) {
                $query->where('id', $companyId);
            })
            ->paginate(10);
            
        // Only show companies that belong to the user's company (should be just one)
        $companies = Company::where('id', $companyId)->get();
        
        return view('contacts.index', compact('contacts', 'companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'position' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000'
        ]);

        $data = $request->only(['first_name', 'last_name', 'company_id', 'email', 'phone', 'position', 'notes']);
        $data['user_id'] = Auth::id(); // Assign the authenticated user

        Contact::create($data);

        return response()->json(['success' => true, 'message' => 'Contact created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        $contact->load(['company', 'user', 'interactions']);
        return response()->json($contact);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'position' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:1000'
        ]);

        $data = $request->only(['first_name', 'last_name', 'company_id', 'email', 'phone', 'position', 'notes']);
        // Don't update user_id - keep original creator

        $contact->update($data);

        return response()->json(['success' => true, 'message' => 'Contact updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        
        return response()->json(['success' => true, 'message' => 'Contact deleted successfully']);
    }
}
