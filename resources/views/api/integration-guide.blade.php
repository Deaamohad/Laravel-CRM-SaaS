@extends('layouts.app')

@section('title', 'API Integration Guide')

@section('content')
<div class="p-6">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">API Integration Guide</h1>
        <p class="text-gray-600 mt-2">How to connect your systems with our CRM</p>
    </div>

    <!-- Step-by-Step Integration -->
    <div class="space-y-8">
        
        <!-- Step 1: Get API Access -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center mb-4">
                <div class="w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold">1</div>
                <h2 class="text-xl font-semibold ml-3">Get Your API Credentials</h2>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="font-semibold">Your API Endpoint:</p>
                <code class="text-blue-600">{{ config('app.url') }}/api/companies</code>
                
                <p class="font-semibold mt-3">Authentication:</p>
                <p class="text-sm text-gray-600">Use your login credentials to get an API token via the login endpoint.</p>
            </div>
        </div>

        <!-- Step 2: Send Data -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center mb-4">
                <div class="w-8 h-8 bg-green-100 text-green-600 rounded-full flex items-center justify-center font-bold">2</div>
                <h2 class="text-xl font-semibold ml-3">Send Company Data</h2>
            </div>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-semibold mb-3">cURL Command Example:</h3>
                    <div class="bg-gray-900 text-white p-4 rounded-lg text-sm overflow-x-auto">
<pre>curl -X POST {{ config('app.url') }}/api/companies \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -d '{
    "name": "Acme Corporation", 
    "email": "contact@acme.com",
    "phone": "+1-555-0123",
    "address": "123 Business St"
  }'</pre>
                    </div>
                </div>
                
                <div>
                    <h3 class="font-semibold mb-3">PHP Code Example:</h3>
                    <div class="bg-gray-900 text-white p-4 rounded-lg text-sm overflow-x-auto">
<pre>$data = [
    'name' => 'Acme Corporation',
    'email' => 'contact@acme.com', 
    'phone' => '+1-555-0123',
    'address' => '123 Business St'
];

$ch = curl_init('{{ config('app.url') }}/api/companies');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer YOUR_TOKEN'
]);
curl_exec($ch);</pre>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 3: Real Examples -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center mb-4">
                <div class="w-8 h-8 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center font-bold">3</div>
                <h2 class="text-xl font-semibold ml-3">Real-World Use Cases</h2>
            </div>
            
            <div class="grid md:grid-cols-3 gap-4">
                <div class="p-4 border border-blue-200 rounded-lg">
                    <h4 class="font-semibold text-blue-900 mb-2">Email Marketing</h4>
                    <p class="text-sm text-gray-600">Mailchimp sends new subscribers to your CRM automatically</p>
                    <div class="mt-2 text-xs text-blue-600">
                        webhook → /api/companies
                    </div>
                </div>
                
                <div class="p-4 border border-green-200 rounded-lg">
                    <h4 class="font-semibold text-green-900 mb-2">Website Forms</h4>
                    <p class="text-sm text-gray-600">Contact forms create leads instantly in your CRM</p>
                    <div class="mt-2 text-xs text-green-600">
                        form action → /api/companies
                    </div>
                </div>
                
                <div class="p-4 border border-purple-200 rounded-lg">
                    <h4 class="font-semibold text-purple-900 mb-2">Zapier/Make</h4>
                    <p class="text-sm text-gray-600">Connect 1000+ apps to your CRM without coding</p>
                    <div class="mt-2 text-xs text-purple-600">
                        automation → /api/companies
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 4: Test Your Integration -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center mb-4">
                <div class="w-8 h-8 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center font-bold">4</div>
                <h2 class="text-xl font-semibold ml-3">Test Your Integration</h2>
            </div>
            
            <div class="bg-yellow-50 p-4 rounded-lg">
                <p class="font-semibold mb-2">Test URLs:</p>
                <ul class="space-y-1 text-sm">
                    <li><code class="bg-white px-2 py-1 rounded">GET {{ config('app.url') }}/api/companies</code> - List all companies</li>
                    <li><code class="bg-white px-2 py-1 rounded">POST {{ config('app.url') }}/api/companies</code> - Create new company</li>
                    <li><code class="bg-white px-2 py-1 rounded">GET {{ config('app.url') }}/api/companies/1</code> - Get specific company</li>
                </ul>
                
                <p class="text-sm text-gray-600 mt-3">
                    <strong>Tip:</strong> Use tools like Postman or Insomnia to test these endpoints before integrating.
                </p>
            </div>
        </div>

    </div>

    <!-- API Reference -->
    <div class="mt-8 bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-6">
        <h2 class="text-xl font-semibold mb-4">Complete API Reference</h2>
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <h3 class="font-semibold mb-3">Authentication Endpoints</h3>
                <ul class="space-y-2 text-sm">
                    <li><code class="bg-white px-2 py-1 rounded">POST /api/login</code> - Get API token</li>
                    <li><code class="bg-white px-2 py-1 rounded">GET /api/user</code> - Get current user</li>
                    <li><code class="bg-white px-2 py-1 rounded">POST /api/logout</code> - Revoke token</li>
                </ul>
            </div>
            <div>
                <h3 class="font-semibold mb-3">Data Endpoints</h3>
                <ul class="space-y-2 text-sm">
                    <li><code class="bg-white px-2 py-1 rounded">GET /api/companies</code> - List companies</li>
                    <li><code class="bg-white px-2 py-1 rounded">POST /api/companies</code> - Create company</li>
                    <li><code class="bg-white px-2 py-1 rounded">GET /api/deals</code> - List deals</li>
                    <li><code class="bg-white px-2 py-1 rounded">GET /api/interactions</code> - List interactions</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection