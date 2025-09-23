@extends('layouts.app')

@section('title', 'API Management - Cliento')

@section('content')
<div class="p-4 md:p-6">
    <div class="mb-8">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">API Management</h1>
        <p class="text-gray-600 mt-2">REST API endpoints for your CRM data - Perfect for integrations and automation</p>
    </div>

    <!-- Current Data Stats -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 md:p-6">
            <h3 class="text-xs md:text-sm font-medium text-gray-600">Companies</h3>
            <p class="text-xl md:text-2xl font-bold text-blue-600">{{ $stats['total_companies'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 md:p-6">
            <h3 class="text-xs md:text-sm font-medium text-gray-600">Deals</h3>
            <p class="text-xl md:text-2xl font-bold text-green-600">{{ $stats['total_deals'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 md:p-6">
            <h3 class="text-xs md:text-sm font-medium text-gray-600">Interactions</h3>
            <p class="text-xl md:text-2xl font-bold text-purple-600">{{ $stats['total_interactions'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 md:p-6">
            <h3 class="text-xs md:text-sm font-medium text-gray-600">Total Deal Value</h3>
            <p class="text-xl md:text-2xl font-bold text-orange-600">${{ number_format($stats['total_deal_value']) }}</p>
        </div>
    </div>

    <!-- API Authentication Guide -->
    <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">API Authentication</h2>
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <h3 class="font-semibold text-gray-900 mb-2">Step 1: Get Your API Token</h3>
                <div class="bg-gray-900 text-white p-4 rounded-lg text-sm overflow-x-auto">
<pre>curl -X POST {{ config('app.url') }}/api/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "your-email@company.com",
    "password": "your-password"
  }'</pre>
                </div>
                <p class="text-sm text-gray-600 mt-2">This returns a token that you'll use for all API calls.</p>
            </div>
            <div>
                <h3 class="font-semibold text-gray-900 mb-2">Step 2: Use Token in Requests</h3>
                <div class="bg-gray-900 text-white p-4 rounded-lg text-sm overflow-x-auto">
<pre>curl -H "Authorization: Bearer YOUR_TOKEN_HERE" \
     {{ config('app.url') }}/api/companies</pre>
                </div>
                <p class="text-sm text-gray-600 mt-2">Include the token in the Authorization header for all protected endpoints.</p>
            </div>
        </div>
    </div>

    <!-- API Endpoints -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Available API Endpoints</h2>
        <div class="space-y-3">
            @foreach($apiEndpoints as $endpoint => $description)
            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                <code class="text-sm font-mono text-blue-600">{{ $endpoint }}</code>
                <span class="text-sm text-gray-600">{{ $description }}</span>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Integration Examples -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Integration Examples</h2>
        
        <div class="grid md:grid-cols-2 gap-6">
            <div class="border border-blue-200 rounded-lg p-4">
                <h3 class="font-semibold text-blue-900 mb-3">Website Contact Form</h3>
                <p class="text-sm text-gray-600 mb-3">Automatically create companies from website forms</p>
                <div class="bg-gray-900 text-white p-3 rounded text-xs overflow-x-auto">
<pre>POST {{ config('app.url') }}/api/companies
Authorization: Bearer YOUR_TOKEN
Content-Type: application/json

{
  "name": "New Lead Company",
  "email": "lead@company.com",
  "phone": "+1-555-0123",
  "industry": "Technology"
}</pre>
                </div>
            </div>

            <div class="border border-green-200 rounded-lg p-4">
                <h3 class="font-semibold text-green-900 mb-3">Mobile App Integration</h3>
                <p class="text-sm text-gray-600 mb-3">Access CRM data from mobile applications</p>
                <div class="bg-gray-900 text-white p-3 rounded text-xs overflow-x-auto">
<pre>GET {{ config('app.url') }}/api/companies
Authorization: Bearer YOUR_TOKEN

Response: List of companies with pagination</pre>
                </div>
            </div>
        </div>
    </div>

    <!-- API Testing Tools -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Test Your API</h2>
        <div class="grid md:grid-cols-3 gap-4">
            <div class="p-4 bg-gray-50 rounded-lg">
                <h3 class="font-semibold text-gray-900 mb-2">Postman Collection</h3>
                <p class="text-sm text-gray-600 mb-3">Import our API collection for easy testing</p>
                <a href="{{ asset('POSTMAN_API_TESTING_GUIDE.md') }}" class="text-blue-600 text-sm hover:underline" target="_blank">View Testing Guide</a>
            </div>
            <div class="p-4 bg-gray-50 rounded-lg">
                <h3 class="font-semibold text-gray-900 mb-2">cURL Commands</h3>
                <p class="text-sm text-gray-600 mb-3">Ready-to-use command line examples</p>
                <button onclick="showCurlExamples()" class="text-blue-600 text-sm hover:underline">View Examples</button>
            </div>
            <div class="p-4 bg-gray-50 rounded-lg">
                <h3 class="font-semibold text-gray-900 mb-2">API Documentation</h3>
                <p class="text-sm text-gray-600 mb-3">Complete endpoint documentation</p>
                <a href="{{ route('api.guide') }}" class="text-blue-600 text-sm hover:underline">View Guide</a>
            </div>
        </div>
    </div>

    <!-- Quick Test Commands -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Quick Test Commands</h2>
        <div class="space-y-4">
            <div>
                <h3 class="font-medium text-gray-900 mb-2">1. Login and get token:</h3>
                <div class="bg-gray-900 text-white p-3 rounded text-sm overflow-x-auto">
<pre>curl -X POST {{ config('app.url') }}/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"your-email@company.com","password":"your-password"}'</pre>
                </div>
            </div>
            <div>
                <h3 class="font-medium text-gray-900 mb-2">2. Get all companies (replace YOUR_TOKEN):</h3>
                <div class="bg-gray-900 text-white p-3 rounded text-sm overflow-x-auto">
<pre>curl -H "Authorization: Bearer YOUR_TOKEN" \
     {{ config('app.url') }}/api/companies</pre>
                </div>
            </div>
            <div>
                <h3 class="font-medium text-gray-900 mb-2">3. Create new company:</h3>
                <div class="bg-gray-900 text-white p-3 rounded text-sm overflow-x-auto">
<pre>curl -X POST {{ config('app.url') }}/api/companies \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"name":"Test Company","email":"test@test.com","phone":"+1-555-0123"}'</pre>
                </div>
            </div>
            <div>
                <h3 class="font-medium text-gray-900 mb-2">4. Get dashboard stats:</h3>
                <div class="bg-gray-900 text-white p-3 rounded text-sm overflow-x-auto">
<pre>curl -H "Authorization: Bearer YOUR_TOKEN" \
     {{ config('app.url') }}/api/dashboard-stats</pre>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show a temporary success message
        const button = event.target;
        const originalText = button.textContent;
        button.textContent = 'Copied!';
        button.classList.add('text-green-600');
        
        setTimeout(() => {
            button.textContent = originalText;
            button.classList.remove('text-green-600');
        }, 2000);
    });
}

function showCurlExamples() {
    alert('Check the "Quick Test Commands" section below for ready-to-use cURL examples!');
}
</script>
@endsection