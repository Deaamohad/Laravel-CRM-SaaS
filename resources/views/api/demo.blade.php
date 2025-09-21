@extends('layouts.app')

@section('title', 'API & Integrations - Cliento')

@section('content')
<div class="p-6">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">API & Integrations</h1>
        <p class="text-gray-600 mt-2">Connect your business systems to Cliento CRM. Automate data sync, trigger workflows, and build custom integrations.</p>
    </div>

    <!-- API Status & Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">API Status</p>
                    <p class="text-2xl font-bold text-green-600">Active</p>
                </div>
                <div class="h-12 w-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">API Calls Today</p>
                    <p class="text-2xl font-bold text-gray-900">1,247</p>
                </div>
                <div class="h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Active Tokens</p>
                    <p class="text-2xl font-bold text-gray-900">3</p>
                </div>
                <div class="h-12 w-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Rate Limit</p>
                    <p class="text-2xl font-bold text-gray-900">85%</p>
                </div>
                <div class="h-12 w-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <svg class="h-6 w-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Column: API Management -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- API Tokens Section -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900">API Access Tokens</h2>
                        <button onclick="showCreateTokenModal()" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                            Generate New Token
                        </button>
                    </div>
                    <p class="text-sm text-gray-600 mt-1">Manage API access tokens for your integrations</p>
                </div>
                
                <div class="p-6">
                    <div class="space-y-4">
                        <!-- Existing Token -->
                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3">
                                    <div class="h-2 w-2 bg-green-400 rounded-full"></div>
                                    <div>
                                        <p class="font-medium text-gray-900">Website Contact Form</p>
                                        <p class="text-sm text-gray-500">Created: Sept 15, 2025 • Last used: 2 hours ago</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">sk_live_...x7k9</code>
                                <button class="text-gray-400 hover:text-gray-600">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                </button>
                                <button class="text-red-400 hover:text-red-600">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3">
                                    <div class="h-2 w-2 bg-green-400 rounded-full"></div>
                                    <div>
                                        <p class="font-medium text-gray-900">Mobile App Sync</p>
                                        <p class="text-sm text-gray-500">Created: Sept 10, 2025 • Last used: 1 day ago</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <code class="bg-gray-100 px-3 py-1 rounded text-sm font-mono">sk_live_...m2n8</code>
                                <button class="text-gray-400 hover:text-gray-600">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                </button>
                                <button class="text-red-400 hover:text-red-600">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- API Testing Interface -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">API Testing Console</h2>
                    <p class="text-sm text-gray-600 mt-1">Test your API endpoints before implementing in production</p>
                </div>
                
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="font-medium text-gray-900 mb-4">Available Endpoints</h3>
                            <div class="space-y-2">
                                <button onclick="testEndpoint('GET', '/api/companies')" 
                                        class="w-full text-left p-3 border border-gray-200 rounded-lg hover:border-blue-300 hover:bg-blue-50 transition-colors">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <span class="font-mono text-sm text-green-600">GET</span>
                                            <span class="ml-2 text-gray-900">/api/companies</span>
                                        </div>
                                        <div class="text-xs text-gray-500">List companies</div>
                                    </div>
                                </button>

                                <button onclick="testEndpoint('POST', '/api/companies')" 
                                        class="w-full text-left p-3 border border-gray-200 rounded-lg hover:border-blue-300 hover:bg-blue-50 transition-colors">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <span class="font-mono text-sm text-blue-600">POST</span>
                                            <span class="ml-2 text-gray-900">/api/companies</span>
                                        </div>
                                        <div class="text-xs text-gray-500">Create company</div>
                                    </div>
                                </button>

                                <button onclick="testEndpoint('GET', '/api/companies/{id}')" 
                                        class="w-full text-left p-3 border border-gray-200 rounded-lg hover:border-blue-300 hover:bg-blue-50 transition-colors">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <span class="font-mono text-sm text-green-600">GET</span>
                                            <span class="ml-2 text-gray-900">/api/companies/{id}</span>
                                        </div>
                                        <div class="text-xs text-gray-500">Get company</div>
                                    </div>
                                </button>
                            </div>
                        </div>

                        <div>
                            <h3 class="font-medium text-gray-900 mb-4">Response</h3>
                            <div id="apiResponse" class="bg-gray-50 border border-gray-200 rounded-lg p-4 min-h-[200px] font-mono text-sm">
                                <div class="text-gray-500">Click an endpoint to test...</div>
                            </div>
                            <div id="responseStatus" class="mt-2 text-sm"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Documentation & Integration -->
        <div class="space-y-6">
            
            <!-- Quick Start Guide -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Quick Start</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-sm font-medium">1</div>
                            <div>
                                <p class="font-medium text-gray-900">Generate API Token</p>
                                <p class="text-sm text-gray-600">Create a secure token for your integration</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-sm font-medium">2</div>
                            <div>
                                <p class="font-medium text-gray-900">Test Endpoints</p>
                                <p class="text-sm text-gray-600">Use the console to verify your integration</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="flex-shrink-0 w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-sm font-medium">3</div>
                            <div>
                                <p class="font-medium text-gray-900">Implement in Production</p>
                                <p class="text-sm text-gray-600">Deploy your integration with confidence</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Popular Integrations -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Popular Integrations</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="p-4 border border-gray-200 rounded-lg">
                            <h3 class="font-medium text-gray-900 mb-2">Website Contact Forms</h3>
                            <p class="text-sm text-gray-600 mb-3">Automatically create companies from your website contact forms</p>
                            <div class="bg-gray-50 p-3 rounded text-xs font-mono">
                                <span class="text-blue-600">POST</span> /api/companies<br>
                                Content-Type: application/json<br>
                                Authorization: Bearer your_token
                            </div>
                        </div>

                        <div class="p-4 border border-gray-200 rounded-lg">
                            <h3 class="font-medium text-gray-900 mb-2">Mobile App Sync</h3>
                            <p class="text-sm text-gray-600 mb-3">Keep your mobile sales app synchronized with CRM data</p>
                            <div class="bg-gray-50 p-3 rounded text-xs font-mono">
                                <span class="text-green-600">GET</span> /api/companies?updated_since=timestamp
                            </div>
                        </div>

                        <div class="p-4 border border-gray-200 rounded-lg">
                            <h3 class="font-medium text-gray-900 mb-2">Zapier Integration</h3>
                            <p class="text-sm text-gray-600 mb-3">Connect with 5000+ apps through Zapier workflows</p>
                            <div class="bg-gray-50 p-3 rounded text-xs font-mono">
                                Trigger: New Company Created<br>
                                Action: Send to Slack, Email, etc.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- API Documentation -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Documentation</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <a href="#" class="block p-3 border border-gray-200 rounded-lg hover:border-blue-300 hover:bg-blue-50 transition-colors">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-gray-900">API Reference</p>
                                    <p class="text-sm text-gray-600">Complete endpoint documentation</p>
                                </div>
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </a>

                        <a href="#" class="block p-3 border border-gray-200 rounded-lg hover:border-blue-300 hover:bg-blue-50 transition-colors">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-gray-900">Code Examples</p>
                                    <p class="text-sm text-gray-600">PHP, JavaScript, Python samples</p>
                                </div>
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </a>

                        <a href="#" class="block p-3 border border-gray-200 rounded-lg hover:border-blue-300 hover:bg-blue-50 transition-colors">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-gray-900">Webhooks Guide</p>
                                    <p class="text-sm text-gray-600">Real-time event notifications</p>
                                </div>
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </a>

                        <a href="#" class="block p-3 border border-gray-200 rounded-lg hover:border-blue-300 hover:bg-blue-50 transition-colors">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-medium text-gray-900">Rate Limits</p>
                                    <p class="text-sm text-gray-600">Usage limits and best practices</p>
                                </div>
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Webhooks Section -->
    <div class="mt-8 bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Webhooks</h2>
                    <p class="text-sm text-gray-600 mt-1">Receive real-time notifications when data changes in your CRM</p>
                </div>
                <button onclick="showWebhookModal()" class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-green-700 transition-colors">
                    Configure Webhook
                </button>
            </div>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-4 border border-gray-200 rounded-lg">
                    <h3 class="font-medium text-gray-900 mb-2">Company Events</h3>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li>• Company created</li>
                        <li>• Company updated</li>
                        <li>• Company deleted</li>
                    </ul>
                </div>
                
                <div class="p-4 border border-gray-200 rounded-lg">
                    <h3 class="font-medium text-gray-900 mb-2">Deal Events</h3>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li>• Deal created</li>
                        <li>• Deal stage changed</li>
                        <li>• Deal won/lost</li>
                    </ul>
                </div>
                
                <div class="p-4 border border-gray-200 rounded-lg">
                    <h3 class="font-medium text-gray-900 mb-2">Interaction Events</h3>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li>• Interaction logged</li>
                        <li>• Follow-up scheduled</li>
                        <li>• Meeting completed</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals and JavaScript will go here -->
<script>
function testEndpoint(method, endpoint) {
    const responseDiv = document.getElementById('apiResponse');
    const statusDiv = document.getElementById('responseStatus');
    
    responseDiv.innerHTML = '<div class="text-blue-600">Testing ' + method + ' ' + endpoint + '...</div>';
    statusDiv.innerHTML = '';
    
    let url = endpoint;
    if (endpoint.includes('{id}')) {
        url = endpoint.replace('{id}', '1'); // Test with ID 1
    }
    
    fetch(url, {
        method: method,
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (response.ok) {
            statusDiv.innerHTML = '<span class="text-green-600 font-medium">✓ ' + response.status + ' ' + response.statusText + '</span>';
        } else {
            statusDiv.innerHTML = '<span class="text-red-600 font-medium">✗ ' + response.status + ' ' + response.statusText + '</span>';
        }
        return response.json();
    })
    .then(data => {
        responseDiv.innerHTML = '<pre class="whitespace-pre-wrap text-xs">' + JSON.stringify(data, null, 2) + '</pre>';
    })
    .catch(error => {
        statusDiv.innerHTML = '<span class="text-red-600 font-medium">✗ Network Error</span>';
        responseDiv.innerHTML = '<div class="text-red-600">Error: ' + error.message + '</div>';
    });
}

function showCreateTokenModal() {
    alert('Token generation modal would open here');
}

function showWebhookModal() {
    alert('Webhook configuration modal would open here');
}
</script>
@endsection

    <!-- Integration Examples -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Real-World Integration Examples</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="p-4 border border-blue-200 rounded-lg">
                <h4 class="font-semibold text-blue-900 mb-2">🏢 Website Integration</h4>
                <p class="text-sm text-gray-600 mb-3">Contact forms on your website automatically create companies in CRM</p>
                <code class="text-xs bg-blue-50 p-2 block rounded">
                    &lt;form action="/api/companies" method="POST"&gt;
                </code>
            </div>
            
            <div class="p-4 border border-green-200 rounded-lg">
                <h4 class="font-semibold text-green-900 mb-2">📱 Mobile App</h4>
                <p class="text-sm text-gray-600 mb-3">Sales reps use mobile app to access same data</p>
                <code class="text-xs bg-green-50 p-2 block rounded">
                    fetch('/api/companies')
                </code>
            </div>
            
            <div class="p-4 border border-purple-200 rounded-lg">
                <h4 class="font-semibold text-purple-900 mb-2">🔗 Third-party Tools</h4>
                <p class="text-sm text-gray-600 mb-3">Zapier, Make.com, or custom integrations</p>
                <code class="text-xs bg-purple-50 p-2 block rounded">
                    Authorization: Bearer token
                </code>
            </div>
        </div>
    </div>

    <!-- Integration Examples -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
            <span class="mr-2">🌐</span> Real-World Integration Examples
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="p-4 border border-blue-200 rounded-lg bg-blue-50">
                <h4 class="font-semibold text-blue-900 mb-2 flex items-center">
                    <span class="mr-2">🏢</span> Website Integration
                </h4>
                <p class="text-sm text-blue-700 mb-3">Contact forms on your website automatically create companies in CRM</p>
                <div class="bg-blue-100 p-3 rounded-md">
                    <code class="text-xs text-blue-800 block">
                        &lt;form action="/api/companies" method="POST"&gt;<br>
                        &nbsp;&nbsp;&lt;input name="name" required&gt;<br>
                        &nbsp;&nbsp;&lt;input name="email" required&gt;<br>
                        &lt;/form&gt;
                    </code>
                </div>
            </div>
            
            <div class="p-4 border border-green-200 rounded-lg bg-green-50">
                <h4 class="font-semibold text-green-900 mb-2 flex items-center">
                    <span class="mr-2">📱</span> Mobile App
                </h4>
                <p class="text-sm text-green-700 mb-3">Sales reps use mobile app to access same data</p>
                <div class="bg-green-100 p-3 rounded-md">
                    <code class="text-xs text-green-800 block">
                        fetch('/api/companies')<br>
                        &nbsp;&nbsp;.then(res => res.json())<br>
                        &nbsp;&nbsp;.then(data => display(data))
                    </code>
                </div>
            </div>
            
            <div class="p-4 border border-purple-200 rounded-lg bg-purple-50">
                <h4 class="font-semibold text-purple-900 mb-2 flex items-center">
                    <span class="mr-2">🔗</span> Third-party Tools
                </h4>
                <p class="text-sm text-purple-700 mb-3">Zapier, Make.com, or custom integrations</p>
                <div class="bg-purple-100 p-3 rounded-md">
                    <code class="text-xs text-purple-800 block">
                        headers: {<br>
                        &nbsp;&nbsp;'Authorization': 'Bearer token',<br>
                        &nbsp;&nbsp;'Content-Type': 'application/json'<br>
                        }
                    </code>
                </div>
            </div>
        </div>

        <!-- API Features Showcase -->
        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="p-4 bg-gradient-to-r from-blue-50 to-indigo-50 border border-indigo-200 rounded-lg">
                <h4 class="font-semibold text-indigo-900 mb-2">🚀 Professional Features</h4>
                <ul class="text-sm text-indigo-700 space-y-1">
                    <li>• <strong>Pagination:</strong> Handle large datasets efficiently</li>
                    <li>• <strong>Search & Filter:</strong> Find companies quickly</li>
                    <li>• <strong>Sorting:</strong> Order results by any field</li>
                    <li>• <strong>Error Handling:</strong> Robust error responses</li>
                </ul>
            </div>
            
            <div class="p-4 bg-gradient-to-r from-green-50 to-emerald-50 border border-emerald-200 rounded-lg">
                <h4 class="font-semibold text-emerald-900 mb-2">🔒 Enterprise Ready</h4>
                <ul class="text-sm text-emerald-700 space-y-1">
                    <li>• <strong>Authentication:</strong> Secure API access</li>
                    <li>• <strong>Rate Limiting:</strong> Prevent API abuse</li>
                    <li>• <strong>Validation:</strong> Data integrity guaranteed</li>
                    <li>• <strong>Logging:</strong> Full audit trail</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Interactive Test Forms -->
    
    <!-- Search Form -->
    <div id="searchForm" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6" style="display: none;">
        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
            <span class="mr-2">🔍</span> Test Advanced Search & Filtering
        </h3>
        <form onsubmit="searchCompanies(event)" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <input type="text" name="search" placeholder="Search by name, email, or industry" 
                       class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <select name="industry" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">All Industries</option>
                    <option value="Technology">Technology</option>
                    <option value="Healthcare">Healthcare</option>
                    <option value="Finance">Finance</option>
                    <option value="Education">Education</option>
                    <option value="Manufacturing">Manufacturing</option>
                </select>
                <select name="sort_by" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="name">Sort by Name</option>
                    <option value="created_at">Sort by Date</option>
                    <option value="email">Sort by Email</option>
                </select>
            </div>
            <div class="flex items-center gap-4">
                <label class="flex items-center">
                    <input type="radio" name="sort_order" value="asc" checked class="mr-2"> Ascending
                </label>
                <label class="flex items-center">
                    <input type="radio" name="sort_order" value="desc" class="mr-2"> Descending
                </label>
                <input type="number" name="per_page" placeholder="Results per page (1-100)" min="1" max="100" 
                       class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center">
                <span class="mr-2">🔍</span> Search via API
            </button>
        </form>
    </div>

    <!-- Pagination Form -->
    <div id="paginationForm" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6" style="display: none;">
        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
            <span class="mr-2">📊</span> Test Pagination Controls
        </h3>
        <form onsubmit="testPagination(event)" class="flex gap-4 items-end">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Page Number</label>
                <input type="number" name="page" placeholder="1" min="1" value="1"
                       class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Items per Page</label>
                <select name="per_page" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    <option value="5">5 items</option>
                    <option value="10" selected>10 items</option>
                    <option value="25">25 items</option>
                    <option value="50">50 items</option>
                </select>
            </div>
            <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 cursor-pointer transition-colors flex items-center">
                <span class="mr-2">📊</span> Test Pagination
            </button>
        </form>
    </div>

    <!-- Create Form -->
    <div id="createForm" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6" style="display: none;">
        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
            <span class="mr-2">➕</span> Test POST /api/companies
        </h3>
        <form onsubmit="createCompanyViaAPI(event)" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Company Name *</label>
                    <input type="text" name="name" placeholder="e.g., Tech Solutions Inc." required 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                    <input type="email" name="email" placeholder="e.g., contact@techsolutions.com" required 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone *</label>
                    <input type="text" name="phone" placeholder="e.g., +1-555-123-4567" required 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Industry</label>
                    <select name="industry" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select Industry</option>
                        <option value="Technology">Technology</option>
                        <option value="Healthcare">Healthcare</option>
                        <option value="Finance">Finance</option>
                        <option value="Education">Education</option>
                        <option value="Manufacturing">Manufacturing</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                <input type="text" name="address" placeholder="e.g., 123 Business Ave, City, State 12345" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 cursor-pointer transition-colors flex items-center">
                <span class="mr-2">➕</span> Create via API
            </button>
        </form>
    </div>

    <!-- Get Specific Company Form -->
    <div id="getForm" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6" style="display: none;">
        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
            <span class="mr-2">🔎</span> Test GET /api/companies/{id}
        </h3>
        <form onsubmit="getCompanyViaAPI(event)" class="flex gap-4 items-end">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Company ID</label>
                <input type="number" name="company_id" placeholder="e.g., 1" required min="1"
                       class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
            </div>
            <button type="submit" class="bg-yellow-600 text-white px-6 py-2 rounded-lg hover:bg-yellow-700 cursor-pointer transition-colors flex items-center">
                <span class="mr-2">🔎</span> Get via API
            </button>
        </form>
        <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
            <p class="text-yellow-700 text-sm">💡 Try IDs 1-10 to see existing companies, or use a non-existent ID to test error handling</p>
        </div>
    </div>
</div>

<script>
let requestStartTime;

function testAPI(method, endpoint, params = null) {
    hideAllForms();
    const responseDiv = document.getElementById('apiResponse');
    const statusDiv = document.getElementById('responseStatus');
    const timeDiv = document.getElementById('responseTime');
    
    // Build URL with params
    let url = endpoint;
    if (params) {
        const urlParams = new URLSearchParams(params);
        url += '?' + urlParams.toString();
    }
    
    statusDiv.innerHTML = `<span class="text-blue-600 font-medium">🔄 ${method} ${url}</span>`;
    responseDiv.innerHTML = '<div class="flex items-center text-blue-500"><div class="animate-spin rounded-full h-4 w-4 border-b-2 border-blue-500 mr-2"></div>Loading...</div>';
    timeDiv.innerHTML = '';
    
    requestStartTime = Date.now();
    
    fetch(url, {
        method: method,
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        const responseTime = Date.now() - requestStartTime;
        timeDiv.innerHTML = `⏱️ Response time: ${responseTime}ms`;
        
        if (response.ok) {
            statusDiv.innerHTML = `<span class="text-green-600 font-medium">✅ ${response.status} ${response.statusText}</span>`;
        } else {
            statusDiv.innerHTML = `<span class="text-red-600 font-medium">❌ ${response.status} ${response.statusText}</span>`;
        }
        
        return response.json();
    })
    .then(data => {
        // Pretty format the JSON with syntax highlighting
        const formattedJson = JSON.stringify(data, null, 2);
        responseDiv.innerHTML = `<pre class="whitespace-pre-wrap text-sm">${syntaxHighlight(formattedJson)}</pre>`;
    })
    .catch(error => {
        const responseTime = Date.now() - requestStartTime;
        timeDiv.innerHTML = `⏱️ Response time: ${responseTime}ms`;
        statusDiv.innerHTML = `<span class="text-red-600 font-medium">❌ Network Error</span>`;
        responseDiv.innerHTML = `<span class="text-red-500">❌ Error: ${error.message}</span>`;
    });
}

function syntaxHighlight(json) {
    json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
    return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
        var cls = 'text-red-600';
        if (/^"/.test(match)) {
            if (/:$/.test(match)) {
                cls = 'text-blue-600 font-medium';
            } else {
                cls = 'text-green-600';
            }
        } else if (/true|false/.test(match)) {
            cls = 'text-purple-600 font-medium';
        } else if (/null/.test(match)) {
            cls = 'text-gray-500 font-medium';
        } else if (/\d/.test(match)) {
            cls = 'text-orange-600';
        }
        return '<span class="' + cls + '">' + match + '</span>';
    });
}

function hideAllForms() {
    document.getElementById('createForm').style.display = 'none';
    document.getElementById('getForm').style.display = 'none';
    document.getElementById('searchForm').style.display = 'none';
    document.getElementById('paginationForm').style.display = 'none';
}

function showCreateForm() {
    hideAllForms();
    document.getElementById('createForm').style.display = 'block';
}

function showGetForm() {
    hideAllForms();
    document.getElementById('getForm').style.display = 'block';
}

function showSearchForm() {
    hideAllForms();
    document.getElementById('searchForm').style.display = 'block';
}

function showPaginationForm() {
    hideAllForms();
    document.getElementById('paginationForm').style.display = 'block';
}

function searchCompanies(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);
    const params = {};
    
    // Build search parameters
    for (let [key, value] of formData.entries()) {
        if (value.trim() !== '') {
            params[key] = value.trim();
        }
    }
    
    testAPI('GET', '/api/companies', params);
}

function testPagination(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);
    const params = {};
    
    for (let [key, value] of formData.entries()) {
        if (value.trim() !== '') {
            params[key] = value.trim();
        }
    }
    
    testAPI('GET', '/api/companies', params);
}

function createCompanyViaAPI(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);
    const data = Object.fromEntries(formData);
    
    const responseDiv = document.getElementById('apiResponse');
    const statusDiv = document.getElementById('responseStatus');
    const timeDiv = document.getElementById('responseTime');
    
    statusDiv.innerHTML = '<span class="text-blue-600 font-medium">🔄 POST /api/companies</span>';
    responseDiv.innerHTML = '<div class="flex items-center text-blue-500"><div class="animate-spin rounded-full h-4 w-4 border-b-2 border-blue-500 mr-2"></div>Creating company...</div>';
    timeDiv.innerHTML = '';
    
    requestStartTime = Date.now();
    
    fetch('/api/companies', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        const responseTime = Date.now() - requestStartTime;
        timeDiv.innerHTML = `⏱️ Response time: ${responseTime}ms`;
        
        if (response.ok) {
            statusDiv.innerHTML = `<span class="text-green-600 font-medium">✅ ${response.status} ${response.statusText}</span>`;
        } else {
            statusDiv.innerHTML = `<span class="text-red-600 font-medium">❌ ${response.status} ${response.statusText}</span>`;
        }
        
        return response.json();
    })
    .then(data => {
        const formattedJson = JSON.stringify(data, null, 2);
        responseDiv.innerHTML = `<pre class="whitespace-pre-wrap text-sm">${syntaxHighlight(formattedJson)}</pre>`;
        
        if (data.success) {
            form.reset();
            // Show success message
            statusDiv.innerHTML += ' <span class="text-green-600">🎉 Company created successfully!</span>';
        }
    })
    .catch(error => {
        const responseTime = Date.now() - requestStartTime;
        timeDiv.innerHTML = `⏱️ Response time: ${responseTime}ms`;
        statusDiv.innerHTML = '<span class="text-red-600 font-medium">❌ Network Error</span>';
        responseDiv.innerHTML = `<span class="text-red-500">❌ Error: ${error.message}</span>`;
    });
}

function getCompanyViaAPI(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);
    const companyId = formData.get('company_id');
    
    const responseDiv = document.getElementById('apiResponse');
    const statusDiv = document.getElementById('responseStatus');
    const timeDiv = document.getElementById('responseTime');
    
    statusDiv.innerHTML = `<span class="text-blue-600 font-medium">🔄 GET /api/companies/${companyId}</span>`;
    responseDiv.innerHTML = '<div class="flex items-center text-blue-500"><div class="animate-spin rounded-full h-4 w-4 border-b-2 border-blue-500 mr-2"></div>Fetching company...</div>';
    timeDiv.innerHTML = '';
    
    requestStartTime = Date.now();
    
    fetch(`/api/companies/${companyId}`, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        const responseTime = Date.now() - requestStartTime;
        timeDiv.innerHTML = `⏱️ Response time: ${responseTime}ms`;
        
        if (response.ok) {
            statusDiv.innerHTML = `<span class="text-green-600 font-medium">✅ ${response.status} ${response.statusText}</span>`;
        } else {
            statusDiv.innerHTML = `<span class="text-red-600 font-medium">❌ ${response.status} ${response.statusText}</span>`;
        }
        
        return response.json();
    })
    .then(data => {
        const formattedJson = JSON.stringify(data, null, 2);
        responseDiv.innerHTML = `<pre class="whitespace-pre-wrap text-sm">${syntaxHighlight(formattedJson)}</pre>`;
        form.reset();
    })
    .catch(error => {
        const responseTime = Date.now() - requestStartTime;
        timeDiv.innerHTML = `⏱️ Response time: ${responseTime}ms`;
        statusDiv.innerHTML = '<span class="text-red-600 font-medium">❌ Network Error</span>';
        responseDiv.innerHTML = `<span class="text-red-500">❌ Error: ${error.message}</span>`;
    });
}

function copyResponse() {
    const responseDiv = document.getElementById('apiResponse');
    const textContent = responseDiv.textContent || responseDiv.innerText;
    
    navigator.clipboard.writeText(textContent).then(() => {
        // Show temporary success message
        const originalText = responseDiv.innerHTML;
        responseDiv.innerHTML = '<div class="text-green-600 font-medium">📋 Copied to clipboard!</div>';
        setTimeout(() => {
            responseDiv.innerHTML = originalText;
        }, 2000);
    });
}

function clearResponse() {
    document.getElementById('apiResponse').innerHTML = '<span class="text-gray-500">💡 Click any "Test" button above to see live API responses...</span>';
    document.getElementById('responseStatus').innerHTML = '';
    document.getElementById('responseTime').innerHTML = '';
}

// Auto-test the basic endpoint on page load
document.addEventListener('DOMContentLoaded', function() {
    // Small delay to let the page fully load
    setTimeout(() => {
        testAPI('GET', '/api/companies', { per_page: 5 });
    }, 500);
});
</script>
@endsection