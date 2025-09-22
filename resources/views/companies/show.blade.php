@extends('layouts.app')

@section('title', $company->name . ' - Company Details - Cliento')

@section('content')
<div class="p-6">
    <!-- Flash Message -->
    @if(session('success') || session('error'))
        <div id="flash-message" class="mb-6 rounded-lg p-4 shadow-md {{ session('error') ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    @if(session('error'))
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    @else
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    @endif
                    <p class="font-medium">{{ session('success') ?? session('error') }}</p>
                </div>
                <button type="button" onclick="document.getElementById('flash-message').style.display = 'none';" class="text-gray-500 hover:text-gray-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <div class="mb-6">
        <a href="{{ route('companies.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Companies
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Company Details Card -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 p-6">
                    <div class="flex items-start">
                        <div class="w-16 h-16 bg-white rounded-xl flex-shrink-0 flex items-center justify-center">
                            <span class="text-2xl font-bold text-blue-600">{{ substr($company->name, 0, 1) }}</span>
                        </div>
                        <div class="ml-4 flex-grow overflow-hidden">
                            <h1 class="text-xl font-bold text-white break-words hyphens-auto overflow-hidden max-w-full">{{ $company->name }}</h1>
                            <p class="text-blue-100">{{ $company->industry ?: 'No industry specified' }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Company Information</h3>
                        
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-gray-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Email</p>
                                    <p class="text-gray-900">{{ $company->email ?: 'N/A' }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-gray-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Phone</p>
                                    <p class="text-gray-900">{{ $company->phone ?: 'N/A' }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-gray-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Address</p>
                                    <p class="text-gray-900">{{ $company->address ?: 'N/A' }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-gray-500 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <div>
                                    <p class="text-sm text-gray-500">Created</p>
                                    <p class="text-gray-900">{{ $company->created_at->format('F j, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex space-x-2">
                        <button onclick="editCompany({{ $company->id }})" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition-colors">
                            <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="lg:col-span-2">
            <!-- Company Interactions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">Company Interactions</h3>
                    <button onclick="openModal('logInteractionModal')" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg font-medium text-sm transition-colors">
                        Log Interaction
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notes</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="interactionsTable">
                            @forelse($interactions as $interaction)
                            <tr class="hover:bg-gray-50" data-interaction-id="{{ $interaction->id }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-lg flex items-center justify-center
                                            @if($interaction->type === 'call') bg-blue-100
                                            @elseif($interaction->type === 'email') bg-green-100
                                            @elseif($interaction->type === 'meeting') bg-purple-100
                                            @else bg-gray-100
                                            @endif">
                                            @if($interaction->type === 'call')
                                                <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                                </svg>
                                            @elseif($interaction->type === 'email')
                                                <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                                </svg>
                                            @elseif($interaction->type === 'meeting')
                                                <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">{{ ucfirst($interaction->type) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 max-w-xs truncate">
                                        {{ $interaction->notes ?: 'No notes provided' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($interaction->interaction_date)->format('M d, Y g:i A') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button onclick="viewInteractionDetails({{ $interaction->id }})" class="text-blue-600 hover:text-blue-900 mr-3 cursor-pointer">View</button>
                                    <button onclick="editInteraction({{ $interaction->id }})" class="text-blue-600 hover:text-blue-900 mr-3 cursor-pointer">Edit</button>
                                    <button onclick="deleteInteraction({{ $interaction->id }})" class="text-red-600 hover:text-red-900 cursor-pointer">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="text-gray-500">
                                        <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                        <p class="text-lg font-medium">No interactions yet</p>
                                        <p class="text-sm">Log your first interaction with this company to start tracking engagement.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Company Deals -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">Company Deals</h3>
                    <button onclick="openModal('createDealModal')" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium text-sm transition-colors">
                        Add Deal
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Value</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stage</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="dealsTable">
                            @forelse($deals as $deal)
                            <tr class="hover:bg-gray-50" data-deal-id="{{ $deal->id }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $deal->title }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900">${{ number_format($deal->value, 0) }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($deal->stage === 'closed-won') bg-green-100 text-green-800
                                        @elseif($deal->stage === 'closed-lost') bg-red-100 text-red-800
                                        @elseif($deal->stage === 'lead') bg-blue-100 text-blue-800
                                        @elseif($deal->stage === 'qualified') bg-indigo-100 text-indigo-800
                                        @elseif($deal->stage === 'proposal') bg-purple-100 text-purple-800
                                        @elseif($deal->stage === 'negotiation') bg-yellow-100 text-yellow-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ ucfirst(str_replace('-', ' ', $deal->stage)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($deal->created_at)->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button onclick="editDeal({{ $deal->id }})" class="text-blue-600 hover:text-blue-900 mr-3 cursor-pointer">Edit</button>
                                    <button onclick="deleteDeal({{ $deal->id }})" class="text-red-600 hover:text-red-900 cursor-pointer">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="text-gray-500">
                                        <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                        <p class="text-lg font-medium">No deals yet</p>
                                        <p class="text-sm">Create your first deal for this company.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Deal Modal -->
<div id="createDealModal" class="fixed inset-0 z-50 flex items-center justify-center" style="display: none; background-color: rgba(0, 0, 0, 0.5);">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all">
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-t-2xl p-6">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-white">Create Deal for {{ $company->name }}</h3>
                <button onclick="closeModal('createDealModal')" class="text-white hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <form id="createDealForm" action="{{ route('deals.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <!-- Hidden field for redirect back to current page -->
            <input type="hidden" name="redirect_back" value="1">
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deal Title *</label>
                <input type="text" name="title" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Enter deal title" value="{{ old('title') }}">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Value *</label>
                <div class="relative">
                    <span class="absolute left-3 top-3 text-gray-500">$</span>
                    <input type="number" name="amount" required step="0.01" class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Enter deal value" value="{{ old('amount') }}">
                </div>
                @error('amount')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Hidden field for company ID -->
            <input type="hidden" name="company_id" value="{{ $company->id }}">
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Stage *</label>
                <select name="stage" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <option value="">Select Stage</option>
                    <option value="lead" {{ old('stage') == 'lead' ? 'selected' : '' }}>Lead</option>
                    <option value="qualified" {{ old('stage') == 'qualified' ? 'selected' : '' }}>Qualified</option>
                    <option value="proposal" {{ old('stage') == 'proposal' ? 'selected' : '' }}>Proposal</option>
                    <option value="negotiation" {{ old('stage') == 'negotiation' ? 'selected' : '' }}>Negotiation</option>
                    <option value="closed-won" {{ old('stage') == 'closed-won' ? 'selected' : '' }}>Closed Won</option>
                    <option value="closed-lost" {{ old('stage') == 'closed-lost' ? 'selected' : '' }}>Closed Lost</option>
                </select>
                @error('stage')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            @if($errors->any())
                <div class="mt-4 p-3 bg-red-100 text-red-700 rounded-lg">
                    <ul class="list-disc pl-4">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="flex space-x-3 pt-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-green-500 to-emerald-600 text-white py-3 rounded-lg font-semibold hover:shadow-lg transition-all">
                    Create Deal
                </button>
                <button type="button" onclick="closeModal('createDealModal')" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
            </div>
            
            <!-- Display any form errors -->
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

<!-- Edit Deal Modal -->
<div id="editDealModal" class="fixed inset-0 z-50 flex items-center justify-center" style="display: none; background-color: rgba(0, 0, 0, 0.5);">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all">
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-t-2xl p-6">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-white">Edit Deal</h3>
                <button onclick="closeModal('editDealModal')" class="text-white hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <form id="editDealForm" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT')
            <!-- Hidden field for redirect back to current page -->
            <input type="hidden" name="redirect_back" value="1">
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deal Title *</label>
                <input type="text" name="title" id="edit_deal_title" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Enter deal title">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Value *</label>
                <div class="relative">
                    <span class="absolute left-3 top-3 text-gray-500">$</span>
                    <input type="number" name="amount" id="edit_deal_amount" required step="0.01" class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Enter deal value">
                </div>
                @error('amount')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Hidden field for company ID -->
            <input type="hidden" name="company_id" id="edit_deal_company_id" value="{{ $company->id }}">
            <!-- Hidden field for deal ID -->
            <input type="hidden" name="deal_id" id="edit_deal_id">
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Stage *</label>
                <select name="stage" id="edit_deal_stage" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Select Stage</option>
                    <option value="lead">Lead</option>
                    <option value="qualified">Qualified</option>
                    <option value="proposal">Proposal</option>
                    <option value="negotiation">Negotiation</option>
                    <option value="closed-won">Closed Won</option>
                    <option value="closed-lost">Closed Lost</option>
                </select>
                @error('stage')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex space-x-3 pt-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-3 rounded-lg font-semibold hover:shadow-lg transition-all">
                    Update Deal
                </button>
                <button type="button" onclick="closeModal('editDealModal')" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
            </div>
            
            @if($errors->any())
                <div class="mt-4 p-3 bg-red-100 text-red-700 rounded-lg">
                    <ul class="list-disc pl-4">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
</div>

<!-- Log Interaction Modal -->
<div id="logInteractionModal" class="fixed inset-0 z-50 flex items-center justify-center" style="display: none; background-color: rgba(0, 0, 0, 0.5);">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all">
        <div class="bg-gradient-to-r from-purple-600 to-pink-600 rounded-t-2xl p-6">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-white">Log Interaction for {{ $company->name }}</h3>
                <button onclick="closeModal('logInteractionModal')" class="text-white hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <form id="logInteractionForm" action="{{ route('interactions.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <!-- Hidden field for redirect back to current page -->
            <input type="hidden" name="redirect_back" value="1">
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Interaction Type *</label>
                <select name="type" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <option value="">Select Type</option>
                    <option value="call" {{ old('type') == 'call' ? 'selected' : '' }}>Phone Call</option>
                    <option value="email" {{ old('type') == 'email' ? 'selected' : '' }}>Email</option>
                    <option value="meeting" {{ old('type') == 'meeting' ? 'selected' : '' }}>Meeting</option>
                    <option value="demo" {{ old('type') == 'demo' ? 'selected' : '' }}>Demo</option>
                    <option value="follow-up" {{ old('type') == 'follow-up' ? 'selected' : '' }}>Follow-up</option>
                    <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('type')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Hidden field for company ID -->
            <input type="hidden" name="company_id" value="{{ $company->id }}">
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                <textarea name="notes" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Add interaction details...">{{ old('notes') }}</textarea>
                @error('notes')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                <input type="datetime-local" name="interaction_date" value="{{ old('interaction_date', now()->format('Y-m-d\TH:i')) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
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
            
            @if($errors->any())
                <div class="mt-4 p-3 bg-red-100 text-red-700 rounded-lg">
                    <ul class="list-disc pl-4">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <!-- Display any form errors -->
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

<!-- Edit Interaction Modal -->
<div id="editInteractionModal" class="fixed inset-0 z-50 flex items-center justify-center" style="display: none; background-color: rgba(0, 0, 0, 0.5);">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all">
        <div class="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-t-2xl p-6">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-white">Edit Interaction</h3>
                <button onclick="closeModal('editInteractionModal')" class="text-white hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <form id="editInteractionForm" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT')
            <!-- Hidden field for redirect back to current page -->
            <input type="hidden" name="redirect_back" value="1">
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Interaction Type *</label>
                <select name="type" id="edit_interaction_type" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
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
            
            <!-- Hidden field for company ID -->
            <input type="hidden" name="company_id" id="edit_interaction_company_id" value="{{ $company->id }}">
            <!-- Hidden field for interaction ID -->
            <input type="hidden" name="interaction_id" id="edit_interaction_id">
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                <textarea name="notes" id="edit_interaction_notes" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Add interaction details..."></textarea>
                @error('notes')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                <input type="datetime-local" name="interaction_date" id="edit_interaction_date" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                @error('interaction_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex space-x-3 pt-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-indigo-600 to-blue-600 text-white py-3 rounded-lg font-semibold hover:shadow-lg transition-all">
                    Update Interaction
                </button>
                <button type="button" onclick="closeModal('editInteractionModal')" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
            </div>
            
            @if($errors->any())
                <div class="mt-4 p-3 bg-red-100 text-red-700 rounded-lg">
                    <ul class="list-disc pl-4">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
</div>

<script>
    // Setup CSRF token for AJAX requests (only needed for the edit data fetch)
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function editCompany(id) {
        window.location.href = `/companies/${id}/edit`;
    }
    
    function viewInteractionDetails(id) {
        window.location.href = `/interactions/${id}`;
    }
    
    function editInteraction(id) {
        // Fetch interaction data
        $.ajax({
            url: `/interactions/${id}`,
            method: 'GET',
            success: function(interaction) {
                // Populate the form fields
                $('#edit_interaction_id').val(interaction.id);
                $('#edit_interaction_type').val(interaction.type);
                $('#edit_interaction_notes').val(interaction.notes);
                
                // Set the form action
                document.getElementById('editInteractionForm').action = `/interactions/${id}`;
                
                // Format date for datetime-local input
                if (interaction.interaction_date) {
                    const date = new Date(interaction.interaction_date);
                    const formattedDate = date.toISOString().slice(0, 16); // Format: YYYY-MM-DDThh:mm
                    $('#edit_interaction_date').val(formattedDate);
                }
                
                // Open modal
                openModal('editInteractionModal');
            },
            error: function() {
                alert('Failed to fetch interaction data. Please try again.');
            }
        });
    }

    function editDeal(dealId) {
        // Fetch deal data
        $.ajax({
            url: `/deals/${dealId}`,
            method: 'GET',
            success: function(deal) {
                // Populate the form fields
                $('#edit_deal_id').val(deal.id);
                $('#edit_deal_title').val(deal.title);
                $('#edit_deal_amount').val(deal.value);
                $('#edit_deal_stage').val(deal.stage);
                
                // Set the form action
                document.getElementById('editDealForm').action = `/deals/${dealId}`;
                
                // Open modal
                openModal('editDealModal');
            },
            error: function() {
                alert('Failed to fetch deal data. Please try again.');
            }
        });
    }

    function deleteDeal(dealId) {
        // Store the deal ID for the delete form
        $('#delete_deal_id').val(dealId);
        
        // Show the modal
        openModal('deleteDealModal');
        
        // Set up the form action
        const form = document.getElementById('deleteDealForm');
        form.action = `/deals/${dealId}`;
    }
    
    function deleteInteraction(interactionId) {
        // Store the interaction ID for the delete form
        $('#delete_interaction_id').val(interactionId);
        
        // Show the modal
        openModal('deleteInteractionModal');
        
        // Set up the form action
        const form = document.getElementById('deleteInteractionForm');
        form.action = `/interactions/${interactionId}`;
    }
    
    // Function removed: showNotification is no longer needed as we're using Laravel flash messages
    
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
        
        // Reset form and clear errors
        const form = modal.querySelector('form');
        if (form) {
            form.reset();
            
            // Clear error messages
            $(modal).find('.text-red-500').hide();
            $(modal).find('.bg-red-100').hide();
        }
    }
</script>

<!-- Delete Interaction Modal -->
<div id="deleteInteractionModal" class="fixed inset-0 z-50 flex items-center justify-center" style="display: none; background-color: rgba(0, 0, 0, 0.5);">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Delete Interaction</h3>
                    <p class="text-sm text-gray-600">Are you sure you want to delete this interaction?</p>
                </div>
            </div>
            
            <div class="bg-red-50 rounded-lg p-4 mb-6">
                <p class="text-sm text-red-800">
                    <strong>Warning:</strong> This will permanently delete this interaction record. This action cannot be undone.
                </p>
            </div>
            
            <form id="deleteInteractionForm" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" id="delete_interaction_id" name="interaction_id">
                <input type="hidden" name="redirect_back" value="1">
                
                <div class="flex space-x-3">
                    <button type="submit" class="flex-1 bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                        Yes, Delete Interaction
                    </button>
                    <button type="button" onclick="closeModal('deleteInteractionModal')" class="flex-1 bg-gray-200 text-gray-800 py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Deal Modal -->
<div id="deleteDealModal" class="fixed inset-0 z-50 flex items-center justify-center" style="display: none; background-color: rgba(0, 0, 0, 0.5);">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Delete Deal</h3>
                        <p class="text-sm text-gray-600">Are you sure you want to delete this deal?</p>
                    </div>
                </div>
                <button onclick="closeModal('deleteDealModal')" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="bg-red-50 rounded-lg p-4 mb-6">
                <p class="text-sm text-red-800">
                    <strong>Warning:</strong> This action cannot be undone. The deal and all associated data will be permanently removed.
                </p>
            </div>
            
            <form id="deleteDealForm" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" id="delete_deal_id" name="deal_id">
                <input type="hidden" name="redirect_back" value="1">
                
                <div class="flex space-x-3 pt-4">
                    <button type="submit" class="flex-1 bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700 transition-all">
                        Yes, Delete Deal
                    </button>
                    <button type="button" onclick="closeModal('deleteDealModal')" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection