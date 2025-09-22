@extends('layouts.app')

@section('title', 'Settings - Cliento')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Settings</h1>
        <p class="text-gray-600">Manage your CRM preferences and configuration</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Settings Menu -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Settings Menu</h3>
                <nav class="space-y-2">
                    <a href="#profile" class="flex items-center px-3 py-2 text-blue-600 bg-blue-50 rounded-lg cursor-pointer">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                        Profile Settings
                    </a>
                    <a href="#notifications" class="flex items-center px-3 py-2 text-gray-600 hover:bg-gray-50 rounded-lg cursor-pointer">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                        </svg>
                        Notifications
                    </a>
                    <a href="#security" class="flex items-center px-3 py-2 text-gray-600 hover:bg-gray-50 rounded-lg cursor-pointer">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                        </svg>
                        Security
                    </a>
                    <a href="#data" class="flex items-center px-3 py-2 text-gray-600 hover:bg-gray-50 rounded-lg cursor-pointer">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                        Data Management
                    </a>
                </nav>
            </div>
        </div>

        <!-- Settings Content -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Profile Settings</h3>
                
                <!-- Flash Messages are handled in the layout -->
                
                <form id="profileForm" action="{{ route('settings.profile') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                            <input type="text" name="first_name" value="{{ $user->first_name }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                            <input type="text" name="last_name" value="{{ $user->last_name }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input type="tel" name="phone" value="+1 (555) 123-4567" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Company</label>
                        <input type="text" name="company" value="{{ $user->company }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div class="flex items-center">
                        <input type="checkbox" id="marketing" name="marketing_emails" value="1" {{ $user->marketing_emails ? 'checked' : '' }} class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="marketing" class="ml-2 text-sm text-gray-600">
                            Subscribe to marketing updates and product news
                        </label>
                    </div>
                    
                    <div class="flex space-x-3 pt-4">
                        <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition-all cursor-pointer">
                            Update Profile
                        </button>
                        <button type="button" onclick="resetForm()" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>

            <!-- Data Management Section -->
            <div class="mt-6 bg-white rounded-xl shadow-sm border border-red-200 p-6">
                <h3 class="text-lg font-semibold text-red-900 mb-4">Data Management</h3>
                <p class="text-gray-600 mb-6">Manage your CRM data and account settings. These actions cannot be undone.</p>
                
                <div class="space-y-4">
                    <button onclick="resetData()" class="w-full md:w-auto px-4 py-2 border border-red-300 text-red-700 rounded-lg hover:bg-red-50 transition-colors cursor-pointer">
                        Reset All Data
                    </button>
                    <button onclick="deleteAccount()" class="w-full md:w-auto px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors ml-0 md:ml-3 cursor-pointer">
                        Delete Account
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reset Data Modal -->
<div id="resetDataModal" class="fixed inset-0 z-50 items-center justify-center" style="display: none; background-color: rgba(0, 0, 0, 0.5);">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Reset All Data</h3>
                    <p class="text-sm text-gray-600">Are you sure you want to reset all CRM data?</p>
                </div>
            </div>
            
            <div class="bg-yellow-50 rounded-lg p-4 mb-6">
                <p class="text-sm text-yellow-800">
                    <strong>Warning:</strong> This will delete all companies, deals, and interactions. This action cannot be undone.
                </p>
            </div>
            
            <div class="flex space-x-3">
                <button onclick="confirmResetData()" class="flex-1 bg-yellow-600 text-white py-3 rounded-lg font-semibold hover:bg-yellow-700 transition-colors cursor-pointer">
                    Yes, Reset Data
                </button>
                <button onclick="closeModal('resetDataModal')" class="flex-1 bg-gray-200 text-gray-800 py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors cursor-pointer">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div id="deleteAccountModal" class="fixed inset-0 z-50 items-center justify-center" style="display: none; background-color: rgba(0, 0, 0, 0.5);">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Delete Account</h3>
                    <p class="text-sm text-gray-600">Are you sure you want to delete your account?</p>
                </div>
            </div>
            
            <div class="bg-red-50 rounded-lg p-4 mb-6">
                <p class="text-sm text-red-800">
                    <strong>Warning:</strong> This will permanently delete your account and all data. This action cannot be undone.
                </p>
            </div>
            
            <div class="flex space-x-3">
                <button onclick="confirmDeleteAccount()" class="flex-1 bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors cursor-pointer">
                    Yes, Delete Account
                </button>
                <button onclick="closeModal('deleteAccountModal')" class="flex-1 bg-gray-200 text-gray-800 py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors cursor-pointer">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function resetForm() {
    document.getElementById('profileForm').reset();
}

function resetData() {
    openModal('resetDataModal');
}

function deleteAccount() {
    openModal('deleteAccountModal');
}

function openModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

function confirmResetData() {
    // In a real app, this would make an API call
    alert('Demo: All data would be reset here');
    closeModal('resetDataModal');
}

function confirmDeleteAccount() {
    // In a real app, this would make an API call
    alert('Demo: Account would be deleted here');
    closeModal('deleteAccountModal');
}
</script>

<!-- Delete Account Confirmation Modal -->
<div id="deleteAccountModal" class="fixed inset-0 z-50 items-center justify-center" style="display: none; background-color: rgba(0, 0, 0, 0.5);">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Delete Account</h3>
                    <p class="text-sm text-gray-600">This action is irreversible!</p>
                </div>
            </div>
            
            <div class="bg-red-50 rounded-lg p-4 mb-6">
                <p class="text-sm text-red-800">
                    <strong>Final Warning:</strong> This will permanently delete your account and all associated data. This action cannot be undone.
                </p>
            </div>
            
            <div class="flex space-x-3">
                <button onclick="confirmDeleteAccount()" class="flex-1 bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                    Yes, Delete Account
                </button>
                <button onclick="closeModal('deleteAccountModal')" class="flex-1 bg-gray-200 text-gray-800 py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Modal functions
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Profile form submission is now handled by standard Laravel form submission

// Reset form function
function resetForm() {
    document.getElementById('profileForm').reset();
    document.querySelector('input[name="company"]').value = 'Cliento CRM';
    document.querySelector('select[name="timezone"]').value = 'UTC-05:00 Eastern Time';
    document.getElementById('email-notifications').checked = true;
    document.getElementById('marketing-emails').checked = false;
}

// Reset data function
function resetData() {
    openModal('resetDataModal');
}

function confirmResetData() {
    fetch('/settings/reset-data', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        closeModal('resetDataModal');
        if (data.success) {
            alert('All data has been reset successfully!');
        } else {
            alert('Error resetting data: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        closeModal('resetDataModal');
        console.error('Error:', error);
        alert('Error resetting data');
    });
}

// Delete account function
function deleteAccount() {
    openModal('deleteAccountModal');
}

function confirmDeleteAccount() {
    fetch('/settings/delete-account', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        closeModal('deleteAccountModal');
        if (data.success) {
            alert('Account deletion initiated. All data has been cleared.');
            window.location.href = '/';
        } else {
            alert('Error deleting account: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        closeModal('deleteAccountModal');
        console.error('Error:', error);
        alert('Error deleting account');
    });
}
</script>
@endsection