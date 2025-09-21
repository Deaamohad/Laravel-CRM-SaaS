@extends('layouts.app')

@section('title', 'Search Results - Cliento')
@section('page-title', 'Search Results')
@section('page-description', 'Search results for "' . request('q') . '"')

@section('content')
<div class="space-y-6">
    <!-- Search Header -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">
                    Search Results for "<span class="text-blue-600">{{ request('q') }}</span>"
                </h2>
                <p class="text-sm text-gray-600 mt-1">
                    Found {{ $results['total'] }} results across companies, deals, and interactions
                </p>
            </div>
            
            <!-- Advanced Search Toggle -->
            <button 
                x-data=""
                @click="$dispatch('toggle-advanced-search')"
                class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors"
            >
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                </svg>
                Advanced Filters
            </button>
        </div>
    </div>

    <!-- Advanced Search Panel -->
    <div 
        x-data="{ show: false }"
        @toggle-advanced-search.window="show = !show"
        x-show="show"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform scale-95"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95"
        class="bg-white rounded-lg shadow-sm p-6"
        style="display: none;"
    >
        <form method="GET" action="{{ route('search.global') }}" class="space-y-4">
            <input type="hidden" name="q" value="{{ request('q') }}">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Date Range -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date Range</label>
                    <div class="space-y-2">
                        <input 
                            type="date" 
                            name="date_from" 
                            value="{{ request('date_from') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="From"
                        >
                        <input 
                            type="date" 
                            name="date_to" 
                            value="{{ request('date_to') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="To"
                        >
                    </div>
                </div>

                <!-- Deal Value Range -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deal Value Range</label>
                    <div class="space-y-2">
                        <input 
                            type="number" 
                            name="value_min" 
                            value="{{ request('value_min') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Minimum value"
                        >
                        <input 
                            type="number" 
                            name="value_max" 
                            value="{{ request('value_max') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Maximum value"
                        >
                    </div>
                </div>

                <!-- Deal Stage -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deal Stage</label>
                    <select 
                        name="stage" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="">All Stages</option>
                        <option value="lead" {{ request('stage') === 'lead' ? 'selected' : '' }}>Lead</option>
                        <option value="qualified" {{ request('stage') === 'qualified' ? 'selected' : '' }}>Qualified</option>
                        <option value="proposal" {{ request('stage') === 'proposal' ? 'selected' : '' }}>Proposal</option>
                        <option value="negotiation" {{ request('stage') === 'negotiation' ? 'selected' : '' }}>Negotiation</option>
                        <option value="closed_won" {{ request('stage') === 'closed_won' ? 'selected' : '' }}>Closed Won</option>
                        <option value="closed_lost" {{ request('stage') === 'closed_lost' ? 'selected' : '' }}>Closed Lost</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                <button 
                    type="button"
                    @click="window.location.href = '{{ route('search.global', ['q' => request('q')]) }}'"
                    class="px-4 py-2 text-gray-600 bg-gray-100 rounded-md hover:bg-gray-200 transition-colors"
                >
                    Clear Filters
                </button>
                <button 
                    type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors"
                >
                    Apply Filters
                </button>
            </div>
        </form>
    </div>

    <!-- Results Tabs -->
    <div class="bg-white rounded-lg shadow-sm">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8 px-6" aria-label="Tabs">
                <button 
                    @click="activeTab = 'all'"
                    :class="activeTab === 'all' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                    x-data="{ activeTab: 'all' }"
                >
                    All Results ({{ $results['total'] }})
                </button>
                @if($results['companies']->count() > 0)
                <button 
                    @click="activeTab = 'companies'"
                    :class="activeTab === 'companies' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                >
                    Companies ({{ $results['companies']->count() }})
                </button>
                @endif
                @if($results['deals']->count() > 0)
                <button 
                    @click="activeTab = 'deals'"
                    :class="activeTab === 'deals' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                >
                    Deals ({{ $results['deals']->count() }})
                </button>
                @endif
                @if($results['interactions']->count() > 0)
                <button 
                    @click="activeTab = 'interactions'"
                    :class="activeTab === 'interactions' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                >
                    Interactions ({{ $results['interactions']->count() }})
                </button>
                @endif
            </nav>
        </div>

        <div class="p-6" x-data="{ activeTab: 'all' }">
            <!-- All Results -->
            <div x-show="activeTab === 'all'" class="space-y-6">
                @if($results['companies']->count() > 0)
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Companies</h3>
                    <div class="space-y-3">
                        @foreach($results['companies'] as $company)
                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ $company->name }}</h4>
                                        <p class="text-sm text-gray-500">{{ $company->email }}</p>
                                    </div>
                                </div>
                                <a href="{{ route('companies.show', $company) }}" class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200 transition-colors">
                                    View Details
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($results['deals']->count() > 0)
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Deals</h3>
                    <div class="space-y-3">
                        @foreach($results['deals'] as $deal)
                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ $deal->title }}</h4>
                                        <p class="text-sm text-gray-500">{{ $deal->company->name ?? 'No company' }} • ${{ number_format($deal->value) }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 capitalize">
                                        {{ $deal->stage }}
                                    </span>
                                    <a href="{{ route('deals.show', $deal) }}" class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 rounded-md hover:bg-green-200 transition-colors">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($results['interactions']->count() > 0)
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Interactions</h3>
                    <div class="space-y-3">
                        @foreach($results['interactions'] as $interaction)
                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900 capitalize">{{ $interaction->type }}</h4>
                                        <p class="text-sm text-gray-500">{{ $interaction->company->name ?? 'No company' }} • {{ $interaction->created_at->format('M j, Y') }}</p>
                                    </div>
                                </div>
                                <a href="{{ route('interactions.show', $interaction) }}" class="inline-flex items-center px-3 py-1 bg-purple-100 text-purple-700 rounded-md hover:bg-purple-200 transition-colors">
                                    View Details
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Individual Tab Content -->
            @if($results['companies']->count() > 0)
            <div x-show="activeTab === 'companies'" class="space-y-3" style="display: none;">
                @foreach($results['companies'] as $company)
                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">{{ $company->name }}</h4>
                                <p class="text-sm text-gray-500">{{ $company->email }}</p>
                                @if($company->phone)
                                <p class="text-sm text-gray-500">{{ $company->phone }}</p>
                                @endif
                            </div>
                        </div>
                        <a href="{{ route('companies.show', $company) }}" class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200 transition-colors">
                            View Details
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            @if($results['deals']->count() > 0)
            <div x-show="activeTab === 'deals'" class="space-y-3" style="display: none;">
                @foreach($results['deals'] as $deal)
                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">{{ $deal->title }}</h4>
                                <p class="text-sm text-gray-500">{{ $deal->company->name ?? 'No company' }}</p>
                                @if($deal->description)
                                <p class="text-sm text-gray-400">{{ Str::limit($deal->description, 100) }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="text-right">
                                <p class="font-medium text-gray-900">${{ number_format($deal->value) }}</p>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 capitalize">
                                    {{ $deal->stage }}
                                </span>
                            </div>
                            <a href="{{ route('deals.show', $deal) }}" class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 rounded-md hover:bg-green-200 transition-colors">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            @if($results['interactions']->count() > 0)
            <div x-show="activeTab === 'interactions'" class="space-y-3" style="display: none;">
                @foreach($results['interactions'] as $interaction)
                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900 capitalize">{{ $interaction->type }}</h4>
                                <p class="text-sm text-gray-500">{{ $interaction->company->name ?? 'No company' }}</p>
                                @if($interaction->notes)
                                <p class="text-sm text-gray-400">{{ Str::limit($interaction->notes, 100) }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center space-x-3">
                            <p class="text-sm text-gray-500">{{ $interaction->created_at->format('M j, Y') }}</p>
                            <a href="{{ route('interactions.show', $interaction) }}" class="inline-flex items-center px-3 py-1 bg-purple-100 text-purple-700 rounded-md hover:bg-purple-200 transition-colors">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
@endsection