<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    /**
     * Receive webhook data from external systems
     * This is how other websites/apps send data to your CRM
     */
    public function receiveCompanyData(Request $request)
    {
        // Log the incoming webhook for debugging
        Log::info('Webhook received', ['data' => $request->all()]);
        
        try {
            // Validate the incoming data
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:500',
                'source' => 'nullable|string|max:100' // Track where it came from
            ]);
            
            // Create the company in your CRM
            $company = Company::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'address' => $validated['address'] ?? null,
            ]);
            
            // Log successful creation
            Log::info('Company created via webhook', ['company_id' => $company->id, 'source' => $validated['source'] ?? 'unknown']);
            
            // Return success response to the external system
            return response()->json([
                'success' => true,
                'message' => 'Company created successfully',
                'company_id' => $company->id,
                'data' => $company
            ], 201);
            
        } catch (\Exception $e) {
            // Log error for debugging
            Log::error('Webhook failed', ['error' => $e->getMessage(), 'data' => $request->all()]);
            
            // Return error response
            return response()->json([
                'success' => false,
                'message' => 'Failed to create company',
                'error' => $e->getMessage()
            ], 400);
        }
    }
    
    /**
     * Handle bulk company import from external systems
     */
    public function bulkImport(Request $request)
    {
        $companies = $request->validate([
            'companies' => 'required|array',
            'companies.*.name' => 'required|string|max:255',
            'companies.*.email' => 'required|email|max:255',
            'companies.*.phone' => 'nullable|string|max:20',
            'companies.*.address' => 'nullable|string|max:500',
        ]);
        
        $created = [];
        $errors = [];
        
        foreach ($companies['companies'] as $index => $companyData) {
            try {
                $company = Company::create($companyData);
                $created[] = $company;
            } catch (\Exception $e) {
                $errors[] = [
                    'index' => $index,
                    'data' => $companyData,
                    'error' => $e->getMessage()
                ];
            }
        }
        
        return response()->json([
            'success' => true,
            'created_count' => count($created),
            'error_count' => count($errors),
            'created' => $created,
            'errors' => $errors
        ]);
    }
}