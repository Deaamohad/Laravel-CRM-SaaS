@extends('layouts.app')

@section('title', 'Deals - Cliento')

@section('content')
<div class="p-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Deals</h1>
            <p class="text-gray-600">Track your sales pipeline</p>
        </div>
        <button onclick="openModal('createDealModal')" class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-4 sm:px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition-all cursor-pointer w-full sm:w-auto">
            Create Deal
        </button>
    </div>
    <!-- Flash Messages are handled in the layout -->

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <div class="flex items-center">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3 sm:ml-4">
                    <p class="text-xs sm:text-sm font-medium text-gray-600">Total Deals</p>
                    <p class="text-lg sm:text-2xl font-bold text-gray-900">{{ $deals->total() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <div class="flex items-center">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3 sm:ml-4">
                    <p class="text-xs sm:text-sm font-medium text-gray-600">Total Revenue</p>
                    <p class="text-lg sm:text-2xl font-bold text-gray-900">${{ number_format($deals->sum('value'), 0) }}</p>
                </div>
            </div>
        </div>
    </div>



    <!-- Deals Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">All Deals</h3>
        </div>
        
        <!-- Mobile Card View -->
        <div class="block md:hidden">
            @forelse($deals as $deal)
            <div class="border-b border-gray-200 p-4 hover:bg-gray-50 cursor-pointer" onclick="window.location.href='{{ route('companies.show', $deal->company) }}'">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1">
                        <h3 class="text-sm font-medium text-gray-900 mb-1">{{ $deal->title }}</h3>
                        <div class="flex items-center mb-2">
                            <div class="w-6 h-6 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center mr-2">
                                <span class="text-white font-semibold text-xs">{{ substr($deal->company->name, 0, 1) }}</span>
                            </div>
                            <span class="text-sm text-gray-600">{{ $deal->company->name }}</span>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-bold text-gray-900">${{ number_format($deal->value, 0) }}</div>
                        <span class="px-2 py-1 inline-flex text-xs leading-4 font-semibold rounded-full
                            @if($deal->stage === 'closed') bg-green-100 text-green-800
                            @elseif($deal->stage === 'new') bg-yellow-100 text-yellow-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ ucfirst($deal->stage) }}
                        </span>
                    </div>
                </div>
                <div class="flex items-center justify-between text-xs text-gray-500">
                    <span>{{ $deal->created_at->format('M d, Y') }}</span>
                    <div class="flex space-x-2" onclick="event.stopPropagation()">
                        <button onclick="editDeal({{ $deal->id }}, event)" class="px-2 py-1 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded text-xs">
                            Edit
                        </button>
                        <button onclick="deleteDeal({{ $deal->id }}, event)" class="px-2 py-1 bg-red-50 hover:bg-red-100 text-red-600 rounded text-xs">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-8 text-center">
                <div class="text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <p class="text-lg font-medium">No deals yet</p>
                    <p class="text-sm">Start tracking your sales pipeline by creating your first deal.</p>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Value</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stage</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($deals as $deal)
                    <tr class="hover:bg-gray-50 cursor-pointer" onclick="window.location.href='{{ route('companies.show', $deal->company) }}'">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $deal->title }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                    <span class="text-white font-semibold text-xs">{{ substr($deal->company->name, 0, 1) }}</span>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $deal->company->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm font-medium text-gray-900">${{ number_format($deal->value, 0) }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if($deal->stage === 'closed') bg-green-100 text-green-800
                                @elseif($deal->stage === 'new') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($deal->stage) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $deal->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" onclick="event.stopPropagation()">
                            <div class="flex space-x-2">
                                <button onclick="editDeal({{ $deal->id }}, event)" class="px-3 py-2 bg-blue-50 hover:bg-blue-100 text-blue-600 hover:text-blue-900 rounded-md cursor-pointer transition-colors">
                                    <span class="font-medium">Edit</span>
                                </button>
                                <button onclick="deleteDeal({{ $deal->id }}, event)" class="px-3 py-2 bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-700 rounded-md cursor-pointer transition-colors">
                                    <span class="font-medium">Delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="text-gray-500">
                                <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                <p class="text-lg font-medium">No deals yet</p>
                                <p class="text-sm">Start tracking your sales pipeline by creating your first deal.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($deals->hasPages())
        {{ $deals->links('pagination.custom') }}
        @endif
    </div>
</div>

<!-- Create Deal Modal (reuse from dashboard but get fresh company list) -->
<div id="createDealModal" class="fixed inset-0 z-50 flex items-center justify-center" style="display: none; background-color: rgba(0, 0, 0, 0.5);">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all">
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-t-2xl p-6">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-white">Create New Deal</h3>
                <button onclick="closeModal('createDealModal')" class="text-white hover:text-gray-200 cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <form id="createDealForm" action="{{ route('deals.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deal Title *</label>
                <input type="text" name="title" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" value="{{ old('title') }}">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Value *</label>
                <div class="relative">
                    <span class="absolute left-3 top-3 text-gray-500">$</span>
                    <input type="number" name="amount" required step="0.01" class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" value="{{ old('amount') }}">
                </div>
                @error('amount')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Company *</label>
                <div class="relative">
                    <input type="text" id="company_search" placeholder="Search for a company..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <input type="hidden" id="company_id" name="company_id" required value="{{ old('company_id') }}">
                    
                    <div id="company_dropdown" class="absolute z-50 mt-1 w-full bg-white border border-gray-300 rounded-lg shadow-lg hidden max-h-60 overflow-y-auto">
                        @foreach($companies as $company)
                            <div 
                                class="company-option p-3 cursor-pointer hover:bg-blue-50" 
                                data-company-id="{{ $company->id }}"
                                data-company-name="{{ $company->name }}"
                            >
                                <div class="font-medium">{{ $company->name }}</div>
                                <div class="text-xs text-gray-600">{{ $company->address ?: 'No address' }}</div>
                                <div class="text-xs text-gray-500 truncate">{{ Str::limit($company->notes, 40) ?: 'No notes' }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <div id="selected_company" class="mt-2 p-2 border border-green-200 rounded-lg bg-green-50 hidden">
                    <div class="font-medium" id="selected_company_name"></div>
                </div>
                
                @error('company_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Stage</label>
                <select name="stage" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
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
            
            <div class="flex space-x-3 pt-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-green-500 to-emerald-600 text-white py-3 rounded-lg font-semibold hover:shadow-lg transition-all cursor-pointer">
                    Create Deal
                </button>
                <button type="button" onclick="closeModal('createDealModal')" class="px-6 py-3 border cursor-pointer border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Deal Modal -->
<div id="editDealModal" class="fixed inset-0 z-50 flex items-center justify-center" style="display: none; background-color: rgba(0, 0, 0, 0.5);">
    <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full mx-4 transform transition-all mt-8 max-h-screen overflow-y-auto pt-0">
        <div class="bg-gradient-to-r from-blue-600 to-green-600 rounded-t-2xl p-6">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-white">Edit Deal</h3>
                <button onclick="closeModal('editDealModal')" class="text-white hover:text-gray-200 cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <form id="editDealForm" class="px-6 py-6 space-y-4" action="{{ route('deals.update', 0) }}" method="POST" onsubmit="updateFormAction(this)">
            <input type="hidden" name="deal_id" id="edit_deal_id">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Deal Title *</label>
                <input type="text" name="title" id="edit_title" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Value *</label>
                <div class="relative">
                    <span class="absolute left-3 top-3 text-gray-500">$</span>
                    <input type="number" name="amount" id="edit_amount" required step="0.01" class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Company *</label>
                <div class="relative">
                    <input type="text" id="edit_company_search" placeholder="Search for a company..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <input type="hidden" id="edit_company_id" name="company_id" required>
                    
                    <div id="edit_company_dropdown" class="absolute z-50 mt-1 w-full bg-white border border-gray-300 rounded-lg shadow-lg hidden max-h-60 overflow-y-auto">
                        @foreach($companies as $company)
                            <div 
                                class="edit-company-option p-3 cursor-pointer hover:bg-blue-50" 
                                data-company-id="{{ $company->id }}"
                                data-company-name="{{ $company->name }}"
                            >
                                <div class="font-medium">{{ $company->name }}</div>
                                <div class="text-xs text-gray-600">{{ $company->address ?: 'No address' }}</div>
                                <div class="text-xs text-gray-500 truncate">{{ Str::limit($company->notes, 40) ?: 'No notes' }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <div id="edit_selected_company" class="mt-2 p-2 border border-green-200 rounded-lg bg-green-50 hidden">
                    <div class="font-medium" id="edit_selected_company_name"></div>
                </div>
                
                @if(count($companies) == 0)
                    <p class="text-red-500 text-xs mt-1">No companies available. Please create a company first.</p>
                @endif
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Stage</label>
                <select name="stage" id="edit_stage" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <option value="lead">Lead</option>
                    <option value="qualified">Qualified</option>
                    <option value="proposal">Proposal</option>
                    <option value="negotiation">Negotiation</option>
                    <option value="closed-won">Closed Won</option>
                    <option value="closed-lost">Closed Lost</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" id="edit_description" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" rows="3"></textarea>
            </div>
            
            <div class="flex space-x-3 pt-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-blue-600 to-green-600 text-white py-3 rounded-lg font-semibold hover:shadow-lg transition-all cursor-pointer">
                    Update Deal
                </button>
                <button type="button" onclick="closeModal('editDealModal')" class="px-6 py-3 border cursor-pointer border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Deal Confirmation Modal is now merged with the other one below -->

<script>
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
    
    // Reset form
    const form = modal.querySelector('form');
    if (form) {
        form.reset();
    }
}

// Using standard Laravel form submission with flash messages
// The form has action="{{ route('deals.store') }}" method="POST" already set

// Edit Deal Functions
function editDeal(dealId, event) {
    // Stop event propagation to prevent row click from firing
    if (event) {
        event.stopPropagation();
    }
    
    fetch(`/deals/${dealId}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(deal => {
        document.getElementById('edit_deal_id').value = deal.id;
        document.getElementById('edit_title').value = deal.title;
        document.getElementById('edit_amount').value = deal.value; // Changed from amount to value
        
        // Populate company field in the custom dropdown
        if (deal.company && deal.company.id && deal.company.name) {
            // Set hidden input value
            document.getElementById('edit_company_id').value = deal.company.id;
            
            // Set search input text
            document.getElementById('edit_company_search').value = deal.company.name;
            
            // Keep the green selection box hidden
            document.getElementById('edit_selected_company').classList.add('hidden');
        } else {
            console.warn('No company data available for this deal');
            document.getElementById('edit_company_search').value = 'Company #' + deal.company_id;
            document.getElementById('edit_company_id').value = deal.company_id;
            
            // Ensure the green selection box is hidden
            document.getElementById('edit_selected_company').classList.add('hidden');
        }
        
        document.getElementById('edit_stage').value = deal.stage;
        
        // Set description if available
        if (deal.description) {
            document.getElementById('edit_description').value = deal.description;
        }
        
        // Update the form action URL with the correct ID
        const form = document.getElementById('editDealForm');
        form.action = form.action.replace(/\/0$/, `/${deal.id}`);
        
        openModal('editDealModal');
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Unable to load deal data. Please try again.');
    });
}

// Helper function to update form action before submit
function updateFormAction(form) {
    const dealId = document.getElementById('edit_deal_id').value;
    form.action = form.action.replace(/\/\d+$/, `/${dealId}`);
    // Form will submit normally - no need to prevent default
}

// Company dropdown functionality for Create Deal form
document.addEventListener('DOMContentLoaded', function() {
    const companySearch = document.getElementById('company_search');
    const companyDropdown = document.getElementById('company_dropdown');
    const companyIdInput = document.getElementById('company_id');
    const selectedCompany = document.getElementById('selected_company');
    const selectedCompanyName = document.getElementById('selected_company_name');
    const companyOptions = document.querySelectorAll('.company-option');

    // Add click event to each company option
    companyOptions.forEach(option => {
        option.addEventListener('click', function() {
            const companyId = this.getAttribute('data-company-id');
            const companyNameElement = this.querySelector('.font-medium');
            const companyName = companyNameElement ? companyNameElement.textContent : this.getAttribute('data-company-name');
            
            // Set the value in the hidden input
            companyIdInput.value = companyId;
            
            // Keep the green box hidden
            selectedCompany.classList.add('hidden');
            
            // Hide the dropdown
            companyDropdown.classList.add('hidden');
            
            // Show the company name in the input field
            companySearch.value = companyName;
        });
    });

    // Show dropdown on input focus
    companySearch.addEventListener('focus', function() {
        companyDropdown.classList.remove('hidden');
    });
    
    // Filter options as user types
    companySearch.addEventListener('input', function() {
        const searchText = this.value.toLowerCase();
        
        companyOptions.forEach(option => {
            const companyName = option.getAttribute('data-company-name').toLowerCase();
            
            if (companyName.includes(searchText)) {
                option.style.display = '';
            } else {
                option.style.display = 'none';
            }
        });
        
        // Show dropdown when typing
        companyDropdown.classList.remove('hidden');
    });
    
    // Hide dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!companySearch.contains(e.target) && !companyDropdown.contains(e.target)) {
            companyDropdown.classList.add('hidden');
        }
    });
});

// Company dropdown functionality for Edit Deal form
document.addEventListener('DOMContentLoaded', function() {
    const companySearch = document.getElementById('edit_company_search');
    const companyDropdown = document.getElementById('edit_company_dropdown');
    const companyIdInput = document.getElementById('edit_company_id');
    const selectedCompany = document.getElementById('edit_selected_company');
    const selectedCompanyName = document.getElementById('edit_selected_company_name');
    const companyOptions = document.querySelectorAll('.edit-company-option');

    // Add click event to each company option
    companyOptions.forEach(option => {
        option.addEventListener('click', function() {
            const companyId = this.getAttribute('data-company-id');
            const companyNameElement = this.querySelector('.font-medium');
            const companyName = companyNameElement ? companyNameElement.textContent : this.getAttribute('data-company-name');
            
            // Set the value in the hidden input
            companyIdInput.value = companyId;
            
            // Keep the green box hidden
            selectedCompany.classList.add('hidden');
            
            // Hide the dropdown
            companyDropdown.classList.add('hidden');
            
            // Show the company name in the input field
            companySearch.value = companyName;
        });
    });

    // Show dropdown on input focus
    companySearch.addEventListener('focus', function() {
        companyDropdown.classList.remove('hidden');
    });
    
    // Filter options as user types
    companySearch.addEventListener('input', function() {
        const searchText = this.value.toLowerCase();
        
        companyOptions.forEach(option => {
            const companyName = option.getAttribute('data-company-name').toLowerCase();
            
            if (companyName.includes(searchText)) {
                option.style.display = '';
            } else {
                option.style.display = 'none';
            }
        });
        
        // Show dropdown when typing
        companyDropdown.classList.remove('hidden');
    });
    
    // Hide dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!companySearch.contains(e.target) && !companyDropdown.contains(e.target)) {
            companyDropdown.classList.add('hidden');
        }
    });
});

// Delete Deal Function
function deleteDeal(dealId, event) {
    // Stop event propagation to prevent row click from firing
    if (event) {
        event.stopPropagation();
    }
    
    // Set the form action with the correct deal ID
    const form = document.getElementById('deleteDealForm');
    form.action = form.action.replace(/\/\d+$/, `/${dealId}`);
    
    // Store the deal ID in a variable for use by confirmDeleteDeal
    window.currentDealId = dealId;
    
    // Show the modal
    openModal('deleteDealModal');
}

// Function to handle delete deal submission
function confirmDeleteDeal() {
    if (window.currentDealId) {
        document.getElementById('deleteDealForm').submit();
    } else {
        console.error('No deal selected for deletion');
    }
}

// Function to handle delete deal submission
function confirmDeleteDeal() {
    if (window.currentDealId) {
        document.getElementById('deleteDealForm').submit();
    } else {
        console.error('No deal selected for deletion');
    }
}
</script>
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
                <button onclick="closeModal('deleteDealModal')" class="text-gray-400 hover:text-gray-600 cursor-pointer">
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
            
            <form id="deleteDealForm" action="{{ route('deals.destroy', 0) }}" method="POST">
                @csrf
                @method('DELETE')
                
                <div class="flex space-x-3 pt-4">
                    <button type="submit" class="flex-1 bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700 transition-all cursor-pointer">
                        Yes, Delete Deal
                    </button>
                    <button type="button" onclick="closeModal('deleteDealModal')" class="cursor-pointer px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection