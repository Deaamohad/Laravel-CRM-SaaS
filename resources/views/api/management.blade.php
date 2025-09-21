@extends('layouts.app')

@section('title', 'API Management - Cliento')

@section('content')
<div class="p-6">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">API Management</h1>
        <p class="text-gray-600 mt-2">REST API endpoints for your CRM data</p>
    </div>

    <!-- Current Data Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h3 class="text-sm font-medium text-gray-600">Companies</h3>
            <p class="text-2xl font-bold text-blue-600">{{ $stats['total_companies'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h3 class="text-sm font-medium text-gray-600">Deals</h3>
            <p class="text-2xl font-bold text-green-600">{{ $stats['total_deals'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h3 class="text-sm font-medium text-gray-600">Interactions</h3>
            <p class="text-2xl font-bold text-purple-600">{{ $stats['total_interactions'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h3 class="text-sm font-medium text-gray-600">Total Deal Value</h3>
            <p class="text-2xl font-bold text-orange-600">${{ number_format($stats['total_deal_value']) }}</p>
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

    <!-- API Examples -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Quick Test</h2>
        <div class="space-y-4">
            <div>
                <h3 class="font-medium text-gray-900">Get all companies:</h3>
                <code class="block bg-gray-100 p-3 rounded text-sm">curl {{ url('/api/companies') }}</code>
            </div>
            <div>
                <h3 class="font-medium text-gray-900">Get dashboard stats:</h3>
                <code class="block bg-gray-100 p-3 rounded text-sm">curl {{ url('/api/stats') }}</code>
            </div>
            <div>
                <h3 class="font-medium text-gray-900">Create new company:</h3>
                <code class="block bg-gray-100 p-3 rounded text-sm">curl -X POST {{ url('/api/companies') }} -H "Content-Type: application/json" -d '{"name":"Test Co","email":"test@test.com"}'</code>
            </div>
        </div>
    </div>
</div>
@endsection