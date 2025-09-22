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
        // Get all contacts without filtering by company
        $contacts = Contact::with(['company', 'user'])
            ->paginate(10);
            
        // Show all companies
        $companies = Company::all();
        
        return view('contacts.index', compact('contacts', 'companies'));
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
        
        $user = Auth::user();

        $data = $request->only(['first_name', 'last_name', 'company_id', 'email', 'phone', 'position', 'notes']);
        $data['user_id'] = $user->id; // Assign the authenticated user

        Contact::create($data);

        return redirect()->route('contacts.index')
            ->with('success', 'Contact created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        $companies = Company::all();
        return view('contacts.edit', compact('contact', 'companies'));
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

        $contact->update($request->only([
            'first_name', 'last_name', 'company_id', 'email', 'phone', 'position', 'notes'
        ]));

        return redirect()->route('contacts.show', $contact->id)
            ->with('success', 'Contact updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        
        return redirect()->route('contacts.index')
            ->with('success', 'Contact deleted successfully');
    }
}
