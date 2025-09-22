@extends('layouts.app')

@section('title', 'Dashboard - Cliento')
@section('page-title', 'Dashboard')
@section('page-description', 'Welcome back! Here\'s what\'s happening with your business.')

@section('content')
<!-- Flash Messages -->
@if(session('success'))
    <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded-md">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
            </div>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded-md">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L10 11.414l2.707-2.707a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-red-700 font-medium">{{ session('error') }}</p>
            </div>
        </div>
    </div>
@endif

<!-- Include notification component (for any remaining JavaScript notifications) -->
@include('components.notification')

<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Companies -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Companies</p>
                    <p class="text-3xl font-bold text-gray-900 companies-count">{{ number_format($stats['total_companies']) }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-6a1 1 0 00-1-1H9a1 1 0 00-1 1v6a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Deals -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Deals</p>
                    <p class="text-3xl font-bold text-gray-900 deals-count">{{ number_format($stats['total_deals']) }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Revenue</p>
                    <p class="text-3xl font-bold text-gray-900 total-revenue">${{ number_format($stats['total_revenue']) }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Conversion Rate -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Conversion Rate</p>
                    <p class="text-3xl font-bold text-gray-900 conversion-rate">{{ $stats['conversion_rate'] }}%</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Deals Chart -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Deals Overview</h3>
            </div>
            
            <!-- Simple Chart Representation -->
            <div class="space-y-4">
                @foreach($monthly_deals as $month_data)
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">{{ $month_data['month'] }}</span>
                    <div class="flex-1 mx-4 bg-gray-200 rounded-full h-2">
                        <div class="bg-gradient-to-r from-blue-500 to-purple-500 h-2 rounded-full" 
                             style="width: {{ $month_data['deals'] > 0 ? ($month_data['deals'] / max(array_column($monthly_deals, 'deals'))) * 100 : 0 }}%"></div>
                    </div>
                    <span class="text-sm font-medium text-gray-900">{{ $month_data['deals'] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Recent Activity</h3>
                <a href="{{ route('interactions.index') }}" class="text-sm text-blue-600 hover:text-blue-700">View all</a>
            </div>
            
            <div class="space-y-4" id="recent-activity-list">
                @forelse($stats['recent_interactions'] as $interaction)
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm text-gray-900">{{ $interaction->type }} interaction</p>
                        <p class="text-xs text-gray-500">{{ $interaction->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-4">
                    <p class="text-gray-500 text-sm">No recent interactions</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Recent Items -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Companies -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Recent Companies</h3>
                <a href="{{ route('companies.index') }}" class="text-sm text-blue-600 hover:text-blue-700">View all</a>
            </div>
            
            <div class="space-y-4">
                @forelse($recent_companies as $company)
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-blue-500 rounded-lg flex items-center justify-center text-white font-semibold">
                            {{ strtoupper(substr($company->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $company->name }}</p>
                            <p class="text-xs text-gray-500">{{ $company->industry ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <span class="text-xs text-gray-500">{{ $company->created_at->diffForHumans() }}</span>
                </div>
                @empty
                <div class="text-center py-4">
                    <p class="text-gray-500 text-sm">No companies yet</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Deals -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Recent Deals</h3>
                <a href="{{ route('deals.index') }}" class="text-sm text-blue-600 hover:text-blue-700">View all</a>
            </div>
            
            <div class="space-y-4">
                @forelse($recent_deals as $deal)
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $deal->title }}</p>
                            <p class="text-xs text-gray-500">{{ $deal->company->name ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-900">${{ number_format($deal->value) }}</p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @if($deal->stage === 'closed-won') bg-green-100 text-green-800
                            @elseif($deal->stage === 'closed-lost') bg-red-100 text-red-800
                            @elseif($deal->stage === 'new') bg-yellow-100 text-yellow-800
                            @elseif($deal->stage === 'negotiation') bg-blue-100 text-blue-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ ucfirst(str_replace('-', ' ', $deal->stage)) }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="text-center py-4">
                    <p class="text-gray-500 text-sm">No deals yet</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-6">Quick Actions</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <button onclick="openModal('addCompanyModal')" class="flex items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition-colors">
                <div class="text-center">
                    <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-sm font-medium text-gray-700">Add Company</p>
                </div>
            </button>
            
            <button onclick="openModal('createDealModal')" class="flex items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-green-500 hover:bg-green-50 transition-colors">
                <div class="text-center">
                    <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-sm font-medium text-gray-700">Create Deal</p>
                </div>
            </button>
            
            <button onclick="openModal('logInteractionModal')" class="flex items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-purple-500 hover:bg-purple-50 transition-colors">
                <div class="text-center">
                    <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-sm font-medium text-gray-700">Log Interaction</p>
                </div>
            </button>
        </div>
    </div>
</div>

<!-- Add Company Modal -->
<div id="addCompanyModal" class="fixed inset-0 z-50 flex items-center justify-center" style="display: none; background-color: rgba(0, 0, 0, 0.5);">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all">
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-t-2xl p-6">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-white">Add New Company</h3>
                <button onclick="closeModal('addCompanyModal')" class="text-white hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <form id="addCompanyForm" action="{{ route('companies.quick-add') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Company Name *</label>
                <input type="text" name="name" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Industry</label>
                <select name="industry" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Select Industry</option>
                    <option value="Technology">Technology</option>
                    <option value="Healthcare">Healthcare</option>
                    <option value="Finance">Finance</option>
                    <option value="Education">Education</option>
                    <option value="Retail">Retail</option>
                    <option value="Manufacturing">Manufacturing</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                <input type="email" name="email" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Phone *</label>
                <input type="tel" name="phone" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            
            <div class="flex space-x-3 pt-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-lg font-semibold hover:shadow-lg transition-all">
                    Add Company
                </button>
                <button type="button" onclick="closeModal('addCompanyModal')" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Create Deal Modal -->
<div id="createDealModal" class="fixed inset-0 z-50 flex items-center justify-center" style="display: none; background-color: rgba(0, 0, 0, 0.5);">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all">
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-t-2xl p-6">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-white">Create New Deal</h3>
                <button onclick="closeModal('createDealModal')" class="text-white hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <form id="createDealForm" action="{{ route('deals.quick-create') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deal Title *</label>
                <input type="text" name="title" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Value *</label>
                <div class="relative">
                    <span class="absolute left-3 top-3 text-gray-500">$</span>
                    <input type="number" name="value" required step="0.01" class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Company *</label>
                <select name="company_id" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <option value="">Select Company</option>
                    @foreach($recent_companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Stage</label>
                <select name="stage" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <option value="lead">Lead</option>
                    <option value="qualified">Qualified</option>
                    <option value="proposal">Proposal</option>
                    <option value="negotiation">Negotiation</option>
                    <option value="closed-won">Closed Won</option>
                    <option value="closed-lost">Closed Lost</option>
                </select>
            </div>
            
            <div class="flex space-x-3 pt-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-green-500 to-emerald-600 text-white py-3 rounded-lg font-semibold hover:shadow-lg transition-all">
                    Create Deal
                </button>
                <button type="button" onclick="closeModal('createDealModal')" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Log Interaction Modal -->
<div id="logInteractionModal" class="fixed inset-0 z-50 flex items-center justify-center" style="display: none; background-color: rgba(0, 0, 0, 0.5);">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all">
        <div class="bg-gradient-to-r from-purple-600 to-pink-600 rounded-t-2xl p-6">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-white">Log Interaction</h3>
                <button onclick="closeModal('logInteractionModal')" class="text-white hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <form id="logInteractionForm" action="{{ route('interactions.quick-log') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Interaction Type *</label>
                <select name="type" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <option value="">Select Type</option>
                    <option value="call">Phone Call</option>
                    <option value="email">Email</option>
                    <option value="meeting">Meeting</option>
                    <option value="demo">Demo</option>
                    <option value="follow-up">Follow-up</option>
                    <option value="other">Other</option>
                </select>
                @error('type')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Company *</label>
                <select name="company_id" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <option value="">Select Company</option>
                    @foreach($recent_companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
                @error('company_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Add a hidden field for contact_id with null value -->
            <input type="hidden" name="contact_id" value="">
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                <textarea name="notes" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Add interaction details..."></textarea>
                @error('notes')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                <input type="datetime-local" name="interaction_date" value="{{ now()->format('Y-m-d\TH:i') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                @error('interaction_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex space-x-3 pt-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 text-white py-3 rounded-lg font-semibold hover:shadow-lg transition-all">
                    Log Interaction
                </button>
                <button type="button" onclick="closeModal('logInteractionModal')" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
            </div>
            
            <!-- Display general form errors -->
            @if ($errors->any())
                <div class="mt-4 p-3 bg-red-100 text-red-700 rounded-lg">
                    <ul class="list-disc pl-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
</div>

<script>
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        console.log("Opening modal:", modalId);
    } else {
        console.error("Modal not found:", modalId);
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
        
        // Reset form
        const form = modal.querySelector('form');
        console.log("Closing modal:", modalId);
    } else {
        console.error("Modal not found:", modalId);
    }
    if (form) {
        form.reset();
    }
}

// Close modal when clicking outside
document.addEventListener('click', function(e) {
    const modals = ['addCompanyModal', 'createDealModal', 'logInteractionModal'];
    modals.forEach(modalId => {
        const modal = document.getElementById(modalId);
        if (modal.style.display === 'flex' && e.target === modal) {
            closeModal(modalId);
        }
    });
});

// Add company form submission
document.getElementById('addCompanyForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    // Show a loading spinner
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalBtnText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<div class="inline-block animate-spin rounded-full h-4 w-4 border-t-2 border-b-2 border-white mr-2"></div> Processing...';
    submitBtn.disabled = true;
    
    fetch('/companies/quick-add', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => {
                throw new Error(err.message || 'Something went wrong');
            });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            closeModal('addCompanyModal');
            // Show success message
            showNotification('Success', 'Company added successfully', 'success');
            
            // Update the company stats
            updateDashboardStats();
            
            // Reload the page immediately
            location.reload();
        } else {
            showNotification('Error', data.message || 'Error adding company', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        
        // Get form values to help with debugging
        const name = formData.get('name');
        const email = formData.get('email');
        const phone = formData.get('phone');
        
        // Check if there are obvious errors in the form data
        let errorMessage = 'Error adding company. ';
        
        if (!name) errorMessage += 'Company name is required. ';
        if (!email) errorMessage += 'Email is required. ';
        if (!phone) errorMessage += 'Phone is required. ';
        
        showNotification('Error', error.message || errorMessage + 'Please check your form and try again.', 'error');
    })
    .finally(() => {
        // Restore button state
        submitBtn.innerHTML = originalBtnText;
        submitBtn.disabled = false;
    });
});

// Create deal form submission
document.getElementById('createDealForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    // Show a loading spinner
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalBtnText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<div class="inline-block animate-spin rounded-full h-4 w-4 border-t-2 border-b-2 border-white mr-2"></div> Processing...';
    submitBtn.disabled = true;
    
    fetch('/deals/quick-create', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        // Check if the response is JSON
        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) {
            return response.json().then(data => {
                if (!response.ok) {
                    throw new Error(data.message || 'Server error: ' + response.status);
                }
                return data;
            }).catch(e => {
                // If JSON parsing fails, throw a specific error
                throw new Error('Failed to parse JSON response: ' + e.message);
            });
        } else {
            // If not JSON, it's likely a redirect - just reload the page
            if (response.ok || response.redirected) {
                location.reload();
                return { success: true };
            } else {
                throw new Error('Server error: ' + response.status);
            }
        }
    })
    .then(data => {
        if (data.success) {
            closeModal('createDealModal');
            showNotification('Success', 'Deal created successfully', 'success');
            // Reload immediately
            location.reload();
        } else {
            showNotification('Error', data.message || 'Error creating deal', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        
        // Get form values to help with debugging
        const title = formData.get('title');
        const value = formData.get('value');
        const stage = formData.get('stage');
        const company_id = formData.get('company_id');
        
        // Check if there are obvious errors in the form data
        let errorMessage = 'Error creating deal. ';
        
        if (!title) errorMessage += 'Title is required. ';
        if (!value) errorMessage += 'Value is required. ';
        if (!company_id) errorMessage += 'Company is required. ';
        
        // Use a more detailed error message
        showNotification('Error', errorMessage + 'Please check your form and try again.', 'error');
        
        // Keep form open so user can fix issues
    })
    .finally(() => {
        // Restore button state
        submitBtn.innerHTML = originalBtnText;
        submitBtn.disabled = false;
    });
});

// Log interaction form submission - improved with better feedback and error handling
document.getElementById('logInteractionForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent normal form submission so we can handle success/failure nicely
    
    // Basic client-side validation
    const type = this.querySelector('select[name="type"]').value;
    const company_id = this.querySelector('select[name="company_id"]').value;
    
    if (!type || !company_id) {
        let errorMessage = '';
        if (!type) errorMessage += 'Interaction type is required. ';
        if (!company_id) errorMessage += 'Company is required. ';
        
        showNotification('Error', 'Please correct the following errors: ' + errorMessage, 'error');
        return false;
    }
    
    // Show loading spinner
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalBtnText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<div class="inline-block animate-spin rounded-full h-4 w-4 border-t-2 border-b-2 border-white mr-2"></div> Processing...';
    submitBtn.disabled = true;
    
    // Create form data object
    const formData = new FormData(this);
    
    // Make sure we have the CSRF token
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    
    // Send the form data via fetch API
    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        },
        credentials: 'same-origin'
    })
    .then(response => {
        if (response.ok) {
            return response.json();
        } else {
            return response.json().then(data => {
                throw new Error(data.message || 'Server error');
            });
        }
    })
    .then(data => {
        // Success! Close the modal and show success message
        closeModal('logInteractionModal');
        showNotification('Success', 'Interaction logged successfully', 'success');
        
        // Reset the form for next time
        this.reset();
        
        // Reload the page immediately
        location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Error', error.message || 'Error logging interaction', 'error');
    })
    .finally(() => {
        // Restore button state
        submitBtn.innerHTML = originalBtnText;
        submitBtn.disabled = false;
    });
});
});

// Function to update recent activity list
function updateRecentActivity() {
    const activityList = document.getElementById('recent-activity-list');
    if (!activityList) return;
    
    fetch('/api/recent-activities', {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.activities && data.activities.length > 0) {
            // Clear existing content
            activityList.innerHTML = '';
            
            // Add new activities
            data.activities.forEach(interaction => {
                const activityItem = document.createElement('div');
                activityItem.className = 'flex items-start space-x-3';
                activityItem.innerHTML = `
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm text-gray-900">${interaction.type} interaction</p>
                        <p class="text-xs text-gray-500">${interaction.time_ago}</p>
                    </div>
                `;
                activityList.appendChild(activityItem);
            });
            
            // Animate the new content
            activityList.querySelectorAll('.flex.items-start').forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(10px)';
                setTimeout(() => {
                    item.style.transition = 'opacity 0.3s, transform 0.3s';
                    item.style.opacity = '1';
                    item.style.transform = 'translateY(0)';
                }, index * 100);
            });
        } else {
            activityList.innerHTML = `
                <div class="text-center py-4">
                    <p class="text-gray-500 text-sm">No recent interactions</p>
                </div>
            `;
        }
    })
    .catch(error => {
        console.error('Error fetching activities:', error);
    });
}

// Function to update dashboard stats
function updateDashboardStats() {
    fetch('/api/dashboard-stats', {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        // Update counters if they exist
        if (data.stats) {
            const counters = {
                'companies-count': data.stats.total_companies,
                'deals-count': data.stats.total_deals,
                'total-revenue': '$' + data.stats.total_revenue,
                'conversion-rate': data.stats.conversion_rate + '%'
            };
            
            for (const [selector, value] of Object.entries(counters)) {
                const element = document.querySelector('.' + selector);
                if (element) {
                    element.textContent = value;
                    
                    // Add a brief highlight effect
                    element.classList.add('text-blue-600');
                    setTimeout(() => {
                        element.classList.remove('text-blue-600');
                        element.classList.add('text-gray-900');
                    }, 1500);
                }
            }
        }
    })
    .catch(error => {
        console.error('Error fetching dashboard stats:', error);
    });
}

// Simple notification function
function showNotification(title, message, type) {
    const notificationDiv = document.createElement('div');
    notificationDiv.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${
        type === 'success' ? 'bg-green-100 border-l-4 border-green-500 text-green-700' : 
        'bg-red-100 border-l-4 border-red-500 text-red-700'
    }`;
    
    notificationDiv.innerHTML = `
        <div class="flex items-center">
            <div class="flex-shrink-0">
                ${type === 'success' 
                    ? '<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>'
                    : '<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>'
                }
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium">${title}</p>
                <p class="text-xs mt-1">${message}</p>
            </div>
        </div>
    `;
    
    document.body.appendChild(notificationDiv);
    
    setTimeout(() => {
        notificationDiv.classList.add('opacity-0', 'transition-opacity', 'duration-500');
        setTimeout(() => {
            document.body.removeChild(notificationDiv);
        }, 500);
    }, 3000);
}
</script>
@endsection