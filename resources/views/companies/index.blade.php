@extends('layouts.app')

@section('title', 'Companies - Cliento')

@section('content')
<div class="p-4 md:p-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
        <div>
            <h1 class="text-xl md:text-2xl font-bold text-gray-900">Companies</h1>
            <p class="text-gray-600 hidden md:block">Manage your company database</p>
        </div>
        <button onclick="openModal('addCompanyModal')" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 md:px-6 py-2 md:py-3 rounded-lg font-semibold hover:shadow-lg transition-all cursor-pointer text-sm md:text-base">
            Add Company
        </button>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 md:gap-6 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 md:p-6">
            <div class="flex items-center">
                <div class="w-8 h-8 md:w-12 md:h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 md:w-6 md:h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-6a1 1 0 00-1-1H9a1 1 0 00-1 1v6a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3 md:ml-4">
                    <p class="text-xs md:text-sm font-medium text-gray-600">Total Companies</p>
                    <p class="text-lg md:text-2xl font-bold text-gray-900">{{ $companies->total() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Messages are handled in the layout -->


    <!-- Companies Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-4 md:p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">All Companies</h3>
        </div>
        
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Industry</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email/Phone</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Notes</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($companies as $company)
                    <tr class="hover:bg-gray-50 cursor-pointer" onclick="window.location='{{ route('companies.show', $company) }}'">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                    <span class="text-white font-semibold text-sm">{{ substr($company->name, 0, 1) }}</span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900 truncate max-w-xs" title="{{ $company->name }}">{{ $company->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm text-gray-900">{{ $company->industry ?: 'Not specified' }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm text-gray-900">{{ $company->address ?: 'No address' }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $company->email ?: 'No email' }}</div>
                            <div class="text-sm text-gray-500">{{ $company->phone ?: 'No phone' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $company->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 max-w-md">
                            <span class="text-sm text-gray-500 overflow-hidden text-ellipsis inline-block w-80">{{ Str::limit($company->notes, 100) ?: 'No notes' }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="text-gray-500">
                                <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <p class="text-lg font-medium">No companies yet</p>
                                <p class="text-sm">Get started by adding your first company.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden">
            @forelse($companies as $company)
            <div class="p-4 border-b border-gray-200 hover:bg-gray-50 cursor-pointer" onclick="window.location='{{ route('companies.show', $company) }}'">
                <div class="flex items-start space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-semibold text-sm">{{ substr($company->name, 0, 1) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-sm font-medium text-gray-900 truncate">{{ $company->name }}</h3>
                        <p class="text-xs text-gray-500 mt-1">{{ $company->industry ?: 'No industry' }}</p>
                        <div class="mt-2 space-y-1">
                            @if($company->email)
                                <p class="text-xs text-gray-600">{{ $company->email }}</p>
                            @endif
                            @if($company->phone)
                                <p class="text-xs text-gray-600">{{ $company->phone }}</p>
                            @endif
                            <p class="text-xs text-gray-500">{{ $company->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-8 text-center">
                <div class="text-gray-500">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No companies</h3>
                    <p class="mt-1 text-sm text-gray-500">Get started by creating a new company.</p>
                </div>
            </div>
            @endforelse
        </div>
        
        @if($companies->hasPages())
        {{ $companies->links('pagination.custom') }}
        @endif
    </div>
</div>

<!-- Add Company Modal (reuse from dashboard) -->
<div id="addCompanyModal" class="fixed inset-0 z-50 flex items-center justify-center p-4" style="display: none; background-color: rgba(0, 0, 0, 0.5);">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full max-h-[90vh] overflow-y-auto transform transition-all">
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-t-2xl p-6">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-white">Add New Company</h3>
                <button onclick="closeModal('addCompanyModal')" class="text-white hover:text-gray-200 cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <form id="addCompanyForm" action="{{ route('companies.store') }}" method="POST" class="p-6 space-y-4">
            @csrf
            <div class="border-b border-gray-200 pb-4 mb-4">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Company Information</h4>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Company Name * <span class="text-xs text-gray-500">(max 50 characters)</span></label>
                    <input type="text" name="name" required maxlength="50" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                
                <div class="mb-4">
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
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                    <input type="tel" name="phone" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                    <input type="text" name="address" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                    <textarea name="notes" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Add any notes about this company..."></textarea>
                </div>
            </div>
            
            <!-- Primary contact section has been removed -->
            
            <div class="flex space-x-3 pt-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-lg font-semibold hover:shadow-lg transition-all cursor-pointer">
                    Add Company
                </button>
                <button type="button" onclick="closeModal('addCompanyModal')" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Company Confirmation Modal -->
<div id="deleteCompanyModal" class="fixed inset-0 z-50 flex items-center justify-center" style="display: none; background-color: rgba(0, 0, 0, 0.5);">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Delete Company</h3>
                    <p class="text-sm text-gray-600">Are you sure you want to delete this company?</p>
                </div>
            </div>
            
            <div class="bg-red-50 rounded-lg p-4 mb-6">
                <p class="text-sm text-red-800">
                    <strong>Warning:</strong> This will permanently delete the company and all associated deals and interactions. This action cannot be undone.
                </p>
            </div>
            
            <form id="deleteCompanyForm" action="{{ route('companies.destroy', 0) }}" method="POST">
                @csrf
                @method('DELETE')
                
                <div class="flex space-x-3">
                    <button type="submit" class="flex-1 bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors cursor-pointer">
                        Yes, Delete Company
                    </button>
                    <button type="button" onclick="closeModal('deleteCompanyModal')" class="flex-1 bg-gray-200 text-gray-800 py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors cursor-pointer">
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
// Form has action="{{ route('companies.store') }}" method="POST" already set

// Edit Company Functions
function editCompany(companyId) {
    // We'll still use fetch to get the company data for the form
    fetch(`/companies/${companyId}`, {
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
    .then(data => {
        if (data && data.id) {
            document.getElementById('edit_company_id').value = data.id;
            document.getElementById('edit_name').value = data.name || '';
            document.getElementById('edit_email').value = data.email || '';
            document.getElementById('edit_phone').value = data.phone || '';
            
            // Set industry if available
            if (data.industry) {
                document.getElementById('edit_industry').value = data.industry;
            }
            
            // Set address if available
            document.getElementById('edit_address').value = data.address || '';
            
            // Update the form action URL with the correct ID
            const form = document.getElementById('editCompanyForm');
            form.action = `{{ url('/companies') }}/${data.id}`;
            
            openModal('editCompanyModal');
        } else {
            console.error('Error: Could not load company data');
            window.location.reload(); // Reload to show any potential flash error messages
        }
    })
    .catch(error => {
        console.error('Error:', error);
        window.location.reload(); // Reload to show any potential flash error messages
    });
}

// Using Laravel flash messages instead of client-side notifications
</script>

<!-- Using standard Laravel form submission -->

<script>
// Using standard Laravel form submission with flash messages
// No edit or delete functionality in the companies index page anymore
// These actions are now available only on the company show page
</script>
@endsection