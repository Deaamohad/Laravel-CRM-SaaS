@extends('layouts.app')

@section('title', 'Companies - Cliento')

@section('content')
<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Companies</h1>
            <p class="text-gray-600">Manage your company database</p>
        </div>
        <button onclick="openModal('addCompanyModal')" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition-all cursor-pointer">
            Add Company
        </button>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-6a1 1 0 00-1-1H9a1 1 0 00-1 1v6a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Companies</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $companies->total() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            {{ session('success') }}
        </div>
    </div>
    @endif

    @if (session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{ session('error') }}
        </div>
    </div>
    @endif


    <!-- Companies Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">All Companies</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Industry</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email/Phone</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($companies as $company)
                    <tr class="hover:bg-gray-50">
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
                            <div class="text-sm text-gray-900">{{ $company->email ?: 'No email' }}</div>
                            <div class="text-sm text-gray-500">{{ $company->phone ?: 'No phone' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $company->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('companies.show', $company) }}" class="text-green-600 hover:text-green-900 mr-3 cursor-pointer">View</a>
                            <button onclick="editCompany({{ $company->id }})" class="text-blue-600 hover:text-blue-900 mr-3 cursor-pointer">Edit</button>
                            <button onclick="deleteCompany({{ $company->id }})" class="text-red-600 hover:text-red-900 cursor-pointer">Delete</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
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
        
        @if($companies->hasPages())
        {{ $companies->links('pagination.custom') }}
        @endif
    </div>
</div>

<!-- Add Company Modal (reuse from dashboard) -->
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
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" name="email" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone *</label>
                    <input type="tel" name="phone" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>
            
            <!-- Primary contact section has been removed -->
            
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

<!-- Edit Company Modal -->
<div id="editCompanyModal" class="fixed inset-0 z-50 flex items-center justify-center" style="display: none; background-color: rgba(0, 0, 0, 0.5);">
    <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full mx-4 transform transition-all max-h-screen overflow-y-auto pt-0 mt-8">
        <div class="bg-gradient-to-r from-green-600 to-blue-600 rounded-t-2xl p-6">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-white">Edit Company</h3>
                <button onclick="closeModal('editCompanyModal')" class="text-white hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <form id="editCompanyForm" action="{{ route('companies.update', 0) }}" method="POST" class="px-6 pb-6 space-y-4 pt-4">
            <input type="hidden" name="company_id" id="edit_company_id">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Company Name * <span class="text-xs text-gray-500">(max 50 characters)</span></label>
                <input type="text" name="name" id="edit_name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required maxlength="50">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                <input type="email" name="email" id="edit_email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Phone *</label>
                <input type="tel" name="phone" id="edit_phone" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Industry</label>
                <select name="industry" id="edit_industry" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
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
            
            <div class="flex space-x-3 pt-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-green-600 to-blue-600 text-white py-3 rounded-lg font-semibold hover:shadow-lg transition-all">
                    Update Company
                </button>
                <button type="button" onclick="closeModal('editCompanyModal')" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
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
                    <button type="submit" class="flex-1 bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                        Yes, Delete Company
                    </button>
                    <button type="button" onclick="closeModal('deleteCompanyModal')" class="flex-1 bg-gray-200 text-gray-800 py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
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
            
            // Only set address if the field exists and data has address
            const addressField = document.getElementById('edit_address');
            if (addressField && data.address) {
                addressField.value = data.address;
            }
            
            // Update the form action URL with the correct ID
            const form = document.getElementById('editCompanyForm');
            form.action = form.action.replace(/\/0$/, `/${data.id}`);
            
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
// Form has action="{{ route('companies.update', 0) }}" method="POST" with @csrf and @method('PUT')

// Update company form action before submission
document.getElementById('editCompanyForm').addEventListener('submit', function() {
    const companyId = document.getElementById('edit_company_id').value;
    this.action = this.action.replace(/\/\d+$/, `/${companyId}`);
    // Form will submit naturally - no preventDefault()
});

// Delete Company Function
function deleteCompany(companyId) {
    // Set the form action with the correct company ID
    const form = document.getElementById('deleteCompanyForm');
    form.action = form.action.replace(/\/\d+$/, `/${companyId}`);
    
    // Show the modal
    openModal('deleteCompanyModal');
}
</script>
@endsection