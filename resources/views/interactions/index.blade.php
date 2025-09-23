@extends('layouts.app')

@section('title', 'Interactions - Cliento')

@section('content')
<div class="p-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Interactions</h1>
            <p class="text-gray-600">Track all customer communications</p>
        </div>
        <button onclick="openModal('logInteractionModal')" class="bg-gradient-to-r from-purple-600 to-pink-600 text-white px-4 sm:px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition-all cursor-pointer w-full sm:w-auto">
            Log Interaction
        </button>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6">
            <div class="flex items-center">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3 sm:ml-4">
                    <p class="text-xs sm:text-sm font-medium text-gray-600">Total Interactions</p>
                    <p class="text-lg sm:text-2xl font-bold text-gray-900">{{ $interactions->total() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Messages are handled in the layout -->



    <!-- Interactions Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">All Interactions</h3>
        </div>
        
        <!-- Mobile Card View -->
        <div class="block md:hidden">
            @forelse($interactions as $interaction)
            <div class="border-b border-gray-200 p-4 hover:bg-gray-50 cursor-pointer" onclick="window.location.href='{{ route('companies.show', $interaction->company) }}'">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex-1">
                        <div class="flex items-center mb-2">
                            <div class="w-6 h-6 rounded-lg flex items-center justify-center mr-2
                                @if($interaction->type === 'call') bg-blue-100
                                @elseif($interaction->type === 'email') bg-green-100
                                @elseif($interaction->type === 'meeting') bg-purple-100
                                @else bg-gray-100
                                @endif">
                                @if($interaction->type === 'call')
                                    <svg class="w-3 h-3 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                    </svg>
                                @elseif($interaction->type === 'email')
                                    <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                    </svg>
                                @elseif($interaction->type === 'meeting')
                                    <svg class="w-3 h-3 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                @else
                                    <svg class="w-3 h-3 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                @endif
                            </div>
                            <span class="text-sm font-medium text-gray-900">{{ ucfirst($interaction->type) }}</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <div class="w-6 h-6 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center mr-2">
                                <span class="text-white font-semibold text-xs">{{ substr($interaction->company->name, 0, 1) }}</span>
                            </div>
                            <span class="text-sm text-gray-600">{{ $interaction->company->name }}</span>
                        </div>
                        <div class="text-sm text-gray-700 mb-2">
                            {{ $interaction->notes ?: 'No notes provided' }}
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-gray-500 mb-2">{{ \Carbon\Carbon::parse($interaction->interaction_date)->format('M d, Y') }}</div>
                        <div class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($interaction->interaction_date)->format('g:i A') }}</div>
                    </div>
                </div>
                <div class="flex items-center justify-end" onclick="event.stopPropagation()">
                    <div class="flex space-x-2">
                        <button onclick="editInteraction({{ $interaction->id }}, event)" class="px-2 py-1 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded text-xs">
                            Edit
                        </button>
                        <button onclick="deleteInteraction({{ $interaction->id }}, event)" class="px-2 py-1 bg-red-50 hover:bg-red-100 text-red-600 rounded text-xs">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-8 text-center">
                <div class="text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <p class="text-lg font-medium">No interactions yet</p>
                    <p class="text-sm">Start logging customer communications to track engagement.</p>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notes</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($interactions as $interaction)
                    <tr class="hover:bg-gray-50 cursor-pointer" onclick="window.location.href='{{ route('companies.show', $interaction->company) }}'">
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
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                    <span class="text-white font-semibold text-xs">{{ substr($interaction->company->name, 0, 1) }}</span>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $interaction->company->name }}</div>
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium" onclick="event.stopPropagation()">
                            <div class="flex space-x-2">
                                <button onclick="editInteraction({{ $interaction->id }}, event)" class="px-3 py-2 bg-blue-50 hover:bg-blue-100 text-blue-600 hover:text-blue-900 rounded-md cursor-pointer transition-colors">
                                    <span class="font-medium">Edit</span>
                                </button>
                                <button onclick="deleteInteraction({{ $interaction->id }}, event)" class="px-3 py-2 bg-red-50 hover:bg-red-100 text-red-600 hover:text-red-700 rounded-md cursor-pointer transition-colors">
                                    <span class="font-medium">Delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="text-gray-500">
                                <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                <p class="text-lg font-medium">No interactions yet</p>
                                <p class="text-sm">Start logging customer communications to track engagement.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($interactions->hasPages())
        {{ $interactions->links('pagination.custom') }}
        @endif
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
        
        <form id="logInteractionForm" action="{{ route('interactions.store') }}" method="POST" class="p-6 space-y-4">
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
                <div class="relative">
                    <input type="text" id="company_search" placeholder="Search for a company..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <input type="hidden" id="company_id" name="company_id" required value="{{ old('company_id') }}">
                    
                    <div id="company_dropdown" class="absolute z-50 mt-1 w-full bg-white border border-gray-300 rounded-lg shadow-lg hidden max-h-60 overflow-y-auto">
                        @foreach($companies as $company)
                            <div 
                                class="company-option p-3 cursor-pointer hover:bg-purple-50" 
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
    <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full mx-4 transform transition-all max-h-screen overflow-y-auto pt-0 mt-8">
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-t-2xl p-6">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-white">Edit Interaction</h3>
                <button onclick="closeModal('editInteractionModal')" class="text-white hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <form id="editInteractionForm" class="px-6 pb-6 space-y-4 pt-4" action="{{ route('interactions.update', 0) }}" method="POST">
            <input type="hidden" name="interaction_id" id="edit_interaction_id">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                <select name="type" id="edit_type" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <option value="call">Phone Call</option>
                    <option value="email">Email</option>
                    <option value="meeting">Meeting</option>
                    <option value="demo">Demo</option>
                    <option value="follow-up">Follow-up</option>
                    <option value="other">Other</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Company</label>
                <div class="relative">
                    <input type="text" id="edit_company_search" placeholder="Search for a company..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <input type="hidden" id="edit_company_id" name="company_id" required>
                    
                    <div id="edit_company_dropdown" class="absolute z-50 mt-1 w-full bg-white border border-gray-300 rounded-lg shadow-lg hidden max-h-60 overflow-y-auto">
                        @foreach($companies as $company)
                            <div 
                                class="edit-company-option p-3 cursor-pointer hover:bg-purple-50" 
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
                <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                <textarea name="notes" id="edit_notes" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Add interaction details..." required></textarea>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                <input type="datetime-local" name="interaction_date" id="edit_interaction_date" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
            </div>
            
            <div class="flex space-x-3 pt-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-lg font-semibold hover:shadow-lg transition-all">
                    Update Interaction
                </button>
                <button type="button" onclick="closeModal('editInteractionModal')" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Interaction Confirmation Modal -->
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
            
            <form id="deleteInteractionForm" action="{{ route('interactions.destroy', 0) }}" method="POST">
                @csrf
                @method('DELETE')
                
                <div class="flex space-x-3">
                    <button type="button" onclick="confirmDeleteInteraction()" class="flex-1 bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors">
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
// Form already has action="{{ route('interactions.store') }}" method="POST" set

// Edit Interaction Functions
function editInteraction(interactionId, event) {
    // Stop event propagation to prevent row click from firing
    if (event) {
        event.stopPropagation();
    }
    
    fetch(`/interactions/${interactionId}`, {
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
    .then(interaction => {
        document.getElementById('edit_interaction_id').value = interaction.id;
        document.getElementById('edit_type').value = interaction.type;
        
        // Set company data in the custom dropdown
        if (interaction.company && interaction.company.name) {
            // Set hidden input value
            document.getElementById('edit_company_id').value = interaction.company_id;
            
            // Set search input text
            document.getElementById('edit_company_search').value = interaction.company.name;
            
            // Keep the green selection box hidden
            document.getElementById('edit_selected_company').classList.add('hidden');
        } else {
            console.warn('No company data available for this interaction');
            document.getElementById('edit_company_id').value = interaction.company_id;
            
            // Try to find the company name from the dropdown options
            const companyOption = document.querySelector(`.edit-company-option[data-company-id="${interaction.company_id}"]`);
            if (companyOption) {
                const companyNameElement = companyOption.querySelector('.font-medium');
                document.getElementById('edit_company_search').value = companyNameElement ? companyNameElement.textContent : 'Company #' + interaction.company_id;
            } else {
                document.getElementById('edit_company_search').value = 'Company #' + interaction.company_id;
            }
            
            // Ensure the green selection box is hidden
            document.getElementById('edit_selected_company').classList.add('hidden');
        }
        
        document.getElementById('edit_notes').value = interaction.notes || ''; // Changed from description to notes
        
        // Format datetime for input
        const date = new Date(interaction.interaction_date);
        const formattedDate = date.toISOString().slice(0, 16);
        document.getElementById('edit_interaction_date').value = formattedDate;
        
        // Update the form action URL with the correct ID
        const form = document.getElementById('editInteractionForm');
        form.action = form.action.replace(/\/0$/, `/${interaction.id}`);
        
        openModal('editInteractionModal');
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error loading interaction data: ' + error.message);
    });
}

// Update form action before submitting
document.getElementById('editInteractionForm').addEventListener('submit', function(e) {
    const interactionId = document.getElementById('edit_interaction_id').value;
    this.action = this.action.replace(/\/\d+$/, `/${interactionId}`);
    // Form will submit normally
});

// Using standard Laravel form submission with flash messages
// The form has been updated with action="{{ route('interactions.update', 0) }}" method="POST"
// with @csrf and @method('PUT') directives

// Delete Interaction Function
function deleteInteraction(interactionId, event) {
    // Stop event propagation to prevent row click from firing
    if (event) {
        event.stopPropagation();
    }
    
    // Set the form action with the correct interaction ID
    const form = document.getElementById('deleteInteractionForm');
    form.action = form.action.replace(/\/\d+$/, `/${interactionId}`);
    
    // Store the interaction ID in a variable for use by confirmDeleteInteraction
    window.currentInteractionId = interactionId;
    
    // Show the modal
    openModal('deleteInteractionModal');
}

// Function to handle deletion of an interaction
function confirmDeleteInteraction() {
    if (window.currentInteractionId) {
        document.getElementById('deleteInteractionForm').submit();
    } else {
        console.error('No interaction selected for deletion');
    }
}

// Company dropdown functionality for Create Interaction form
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

// Company dropdown functionality for Edit Interaction form
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
</script>
@endsection