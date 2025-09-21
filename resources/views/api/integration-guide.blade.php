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
                
                <p class="font-semibold mt-3">Your API Token:</p>
                <code class="text-green-600">abc123-your-secret-token</code>
                
                <p class="text-sm text-gray-600 mt-2">
                    Use this token in the Authorization header: <code>Authorization: Bearer abc123-your-secret-token</code>
                </p>
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
  -H "Authorization: Bearer abc123" \
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
    'Authorization: Bearer abc123'
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

    <!-- Real Integration Examples -->
    <div class="mt-8 bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-6">
    <h2 class="text-xl font-semibold mb-4">Companies Already Using Our API</h2>
        <div class="grid md:grid-cols-2 gap-4">
            <div class="bg-white p-4 rounded-lg">
                <h3 class="font-semibold">TechCorp Solutions</h3>
                <p class="text-sm text-gray-600">"We connected our website forms directly to the CRM. Now every lead is automatically tracked!"</p>
                <div class="mt-2 text-xs text-blue-600">Integration: Website → API → CRM</div>
            </div>
            <div class="bg-white p-4 rounded-lg">
                <h3 class="font-semibold">Marketing Pro Inc</h3>
                <p class="text-sm text-gray-600">"Our mobile sales team uses a custom app that syncs with your CRM via the API."</p>
                <div class="mt-2 text-xs text-green-600">Integration: Mobile App → API → CRM</div>
            </div>
        </div>
    </div>
</div>
@endsection