@extends('layouts.app')

@section('title', 'Settings - Cliento')

@section('content')
<style>
    /* Panel transition styles */
    #profile-panel, #security-panel {
        opacity: 0;
        transition: opacity 150ms ease-in-out;
    }
    .panel-active {
        opacity: 1 !important;
    }
</style>

<div class="p-4 md:p-6">
    <div class="mb-6">
        <h1 class="text-xl md:text-2xl font-bold text-gray-900">Settings</h1>
        <p class="text-gray-600 hidden md:block">Manage your profile settings</p>
    </div>

    <!-- Flash messages are handled in the main layout -->

    <div class="mb-6 flex items-center space-x-2 md:space-x-4 overflow-x-auto">
        <button id="profile-tab" class="px-3 md:px-4 py-2 text-sm md:text-lg font-medium border-b-2 border-blue-600 text-blue-600 focus:outline-none whitespace-nowrap" onclick="switchTab('profile')">
            Profile Settings
        </button>
        <button id="security-tab" class="px-3 md:px-4 py-2 text-sm md:text-lg font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700 focus:outline-none whitespace-nowrap" onclick="switchTab('security')">
            Security
        </button>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">
        <!-- Left Sidebar with Profile Info -->
        <div class="lg:col-span-1 order-2 lg:order-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 md:p-6 lg:sticky lg:top-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Profile</h3>
                <div class="flex flex-col items-center">
                    <div class="w-32 h-32 rounded-full overflow-hidden mb-4">
                        @if($user->avatar)
                            <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="Profile" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center text-white text-4xl font-semibold">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <h4 class="text-xl font-medium">{{ $user->name }}</h4>
                    <p class="text-gray-500 mb-2">{{ $user->email }}</p>
                    @if($user->job_title)
                        <p class="text-gray-400 text-sm">{{ $user->job_title }}</p>
                    @endif
                    @if($user->phone)
                        <p class="text-gray-400 text-sm mt-1">{{ $user->phone }}</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Main Content Area - Tab Panels -->
        <div class="lg:col-span-2 order-1 lg:order-2">
            <!-- Profile Information Form - Initially visible -->
            <div id="profile-panel" class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 md:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-6">Edit Profile</h3>
                
                <form id="profileForm" action="{{ route('settings.profile') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Username *</label>
                        <input type="text" name="name" value="{{ $user->name }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Job Title</label>
                        <input type="text" name="job_title" value="{{ $user->job_title ?? '' }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('job_title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                        <input type="email" name="email" value="{{ $user->email }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input type="tel" name="phone" value="{{ $user->phone ?? '' }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex space-x-3 pt-6">
                        <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition-all cursor-pointer">
                            Update Profile
                        </button>
                        <button type="button" onclick="resetProfileForm()" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Password Change Form - Initially visible (will be hidden by JS if needed) -->
            <div id="security-panel" class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 md:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Change Password</h3>
                <p class="text-sm text-gray-500 mb-6">Update your password to maintain account security</p>
                
                @if(session('error'))
                <div class="mb-4 bg-red-50 border-l-4 border-red-500 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v3a1 1 0 102 0V7zm0 7a1 1 0 10-2 0 1 1 0 102 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-800">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
                @endif
                
                <form id="passwordForm" action="{{ route('settings.password') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Password *</label>
                        <input type="password" name="current_password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('current_password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">New Password *</label>
                        <input type="password" name="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password *</label>
                        <input type="password" name="password_confirmation" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div class="flex space-x-3 pt-6">
                        <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition-all cursor-pointer">
                            Update Password
                        </button>
                        <button type="button" onclick="resetPasswordForm()" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                            Cancel
                        </button>
                    </div>
                </form>
                
                <!-- Danger Zone Section -->
                <div class="mt-12 pt-8 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Danger Zone</h3>
                    <p class="text-sm text-gray-500 mb-6">These actions are irreversible. Please be careful.</p>
                    
                    <!-- Reset All Data -->
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h4 class="font-semibold text-red-900 mb-2">Reset All Data</h4>
                                <p class="text-sm text-red-700 mb-3">This will permanently delete all your companies, deals, and interactions. This action cannot be undone.</p>
                                <ul class="text-xs text-red-600 space-y-1">
                                    <li>• All companies will be deleted</li>
                                    <li>• All deals will be deleted</li>
                                    <li>• All interactions will be deleted</li>
                                    <li>• Your account and profile will remain intact</li>
                                </ul>
                            </div>
                            <button onclick="confirmResetData()" class="ml-4 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">
                                Reset Data
                        </button>
                        </div>
                </div>

                    <!-- Delete Account -->
                    <div class="p-4 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h4 class="font-semibold text-red-900 mb-2">Delete Account</h4>
                                <p class="text-sm text-red-700 mb-3">This will permanently delete your account and all associated data. This action cannot be undone.</p>
                                <ul class="text-xs text-red-600 space-y-1">
                                    <li>• Your account will be deleted</li>
                                    <li>• All companies will be deleted</li>
                                    <li>• All deals will be deleted</li>
                                    <li>• All interactions will be deleted</li>
                                    <li>• You will be logged out immediately</li>
                                </ul>
                            </div>
                            <button onclick="confirmDeleteAccount()" class="ml-4 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">
                                Delete Account
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<script>
function resetProfileForm() {
    // Reset the form
    document.getElementById('profileForm').reset();
    
    // Also clear the file input (not always cleared by form reset)
    const fileInput = document.getElementById('avatar');
    if (fileInput) {
        fileInput.value = '';
    }
    
    showNotification('Profile form reset');
}

function resetPasswordForm() {
    // Reset the password form
    document.getElementById('passwordForm').reset();
    
    showNotification('Password form reset');
}

function showNotification(message) {
    // Show a small notification
    const notification = document.createElement('div');
    notification.className = 'fixed bottom-4 right-4 bg-gray-800 text-white px-4 py-2 rounded-md shadow-lg transition-opacity duration-300';
    notification.innerHTML = message;
    document.body.appendChild(notification);
    
    // Remove notification after 2 seconds
    setTimeout(function() {
        notification.style.opacity = '0';
        setTimeout(function() {
            document.body.removeChild(notification);
        }, 300);
    }, 2000);
}

// Switch between profile and security tabs
function switchTab(tab) {
    console.log('Switching to tab:', tab);
    
    // Update tab buttons immediately
    document.getElementById('profile-tab').classList.remove('border-blue-600', 'text-blue-600');
    document.getElementById('profile-tab').classList.add('border-transparent', 'text-gray-500');
    document.getElementById('security-tab').classList.remove('border-blue-600', 'text-blue-600');
    document.getElementById('security-tab').classList.add('border-transparent', 'text-gray-500');
    
    // Activate the selected tab
    document.getElementById(`${tab}-tab`).classList.remove('border-transparent', 'text-gray-500');
    document.getElementById(`${tab}-tab`).classList.add('border-blue-600', 'text-blue-600');
    
    // Add CSS opacity transitions
    const profilePanel = document.getElementById('profile-panel');
    const securityPanel = document.getElementById('security-panel');
    
    // Set initial styles if not already set
    if (!profilePanel.style.transition) {
        profilePanel.style.transition = 'opacity 150ms ease-in-out';
        securityPanel.style.transition = 'opacity 150ms ease-in-out';
    }
    
    // Show/hide panels with smooth transition
    if (tab === 'profile') {
        // Hide security panel
        securityPanel.style.opacity = '0';
        setTimeout(() => {
            securityPanel.classList.add('hidden');
            // Show profile panel
            profilePanel.classList.remove('hidden');
            setTimeout(() => {
                profilePanel.style.opacity = '1';
            }, 10);
        }, 150);
    } else if (tab === 'security') {
        // Hide profile panel
        profilePanel.style.opacity = '0';
        setTimeout(() => {
            profilePanel.classList.add('hidden');
            // Show security panel
            securityPanel.classList.remove('hidden');
            setTimeout(() => {
                securityPanel.style.opacity = '1';
            }, 10);
        }, 150);
    }
}

// Initialize tabs based on session or form errors
document.addEventListener('DOMContentLoaded', function() {
    console.log('Settings page loaded successfully!');
    
    // Check for active tab in session
    const activeTab = '{{ session('active_tab') }}';
    const hasSuccess = {{ session('success') ? 'true' : 'false' }};
    
    // Check for errors in the password form that would need to show that tab
    const hasPasswordErrors = {{ $errors->has('current_password') || $errors->has('password') ? 'true' : 'false' }};
    
    // Set all panels to hidden initially to prevent flash
    const profilePanel = document.getElementById('profile-panel');
    const securityPanel = document.getElementById('security-panel');
    
    console.log('Panels found:', {
        profilePanel: !!profilePanel,
        securityPanel: !!securityPanel
    });
    
    profilePanel.classList.add('hidden');
    securityPanel.classList.add('hidden');
    
    // Determine which tab to show (priority: URL parameter, then session, then password errors, then default to profile)
    if (activeTab === 'security' || hasSuccess) {
        // Show security tab immediately to prevent flicker
        document.getElementById('profile-tab').classList.remove('border-blue-600', 'text-blue-600');
        document.getElementById('profile-tab').classList.add('border-transparent', 'text-gray-500');
        document.getElementById('security-tab').classList.remove('border-transparent', 'text-gray-500');
        document.getElementById('security-tab').classList.add('border-blue-600', 'text-blue-600');
        
        securityPanel.classList.remove('hidden');
        setTimeout(() => {
            securityPanel.style.opacity = '1';
        }, 10);
    } else if (hasPasswordErrors) {
        // Show security tab immediately to prevent flicker
        document.getElementById('profile-tab').classList.remove('border-blue-600', 'text-blue-600');
        document.getElementById('profile-tab').classList.add('border-transparent', 'text-gray-500');
        document.getElementById('security-tab').classList.remove('border-transparent', 'text-gray-500');
        document.getElementById('security-tab').classList.add('border-blue-600', 'text-blue-600');
        
        securityPanel.classList.remove('hidden');
        setTimeout(() => {
            securityPanel.style.opacity = '1';
        }, 10);
    } else {
        // Show profile tab immediately to prevent flicker
        document.getElementById('profile-tab').classList.add('border-blue-600', 'text-blue-600');
        document.getElementById('security-tab').classList.add('border-transparent', 'text-gray-500');
        
        profilePanel.classList.remove('hidden');
        setTimeout(() => {
            profilePanel.style.opacity = '1';
        }, 10);
    }
    
    // Show flash messages if they exist
    if (hasSuccess) {
        // Ensure flash messages are visible regardless of which tab is shown
        const flashMessages = document.querySelectorAll('.flash-message');
        flashMessages.forEach(message => {
            message.style.display = 'block';
        });
    }
    
});


function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    const bgColor = type === 'error' ? 'bg-red-500' : type === 'success' ? 'bg-green-500' : 'bg-blue-500';
    notification.className = `fixed bottom-4 right-4 ${bgColor} text-white px-4 py-2 rounded-md shadow-lg transition-opacity duration-300 z-50`;
    notification.innerHTML = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.opacity = '0';
        setTimeout(() => {
            if (document.body.contains(notification)) {
                document.body.removeChild(notification);
            }
        }, 300);
    }, 3000);
}

// Danger Zone Functions
function confirmResetData() {
    console.log('Reset data confirmation clicked');
    openModal('resetDataModal');
}

function confirmDeleteAccount() {
    console.log('Delete account confirmation clicked');
    openModal('deleteAccountModal');
}

// Modal Functions
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
}

function resetAllData() {
    console.log('Resetting all data...');
    closeModal('resetDataModal');
    
    // Create and submit a form to use proper flash messages
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("settings.reset-data") }}';
    form.style.display = 'none';
    
    // Add CSRF token
    const csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    form.appendChild(csrfToken);
    
    // Add to page and submit
    document.body.appendChild(form);
    form.submit();
}

function deleteAccount() {
    console.log('Deleting account...');
    closeModal('deleteAccountModal');
    
    // Create and submit a form to use proper flash messages
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("settings.delete-account") }}';
    form.style.display = 'none';
    
    // Add CSRF token
    const csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    form.appendChild(csrfToken);
    
    // Add to page and submit
    document.body.appendChild(form);
    form.submit();
}
</script>

<!-- Reset Data Modal -->
<div id="resetDataModal" class="fixed inset-0 z-50 flex items-center justify-center" style="display: none; background-color: rgba(0, 0, 0, 0.5);">
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
                        <h3 class="text-lg font-semibold text-gray-900">Reset All Data</h3>
                        <p class="text-sm text-gray-600">This will permanently delete all your data</p>
                    </div>
                </div>
                <button onclick="closeModal('resetDataModal')" class="text-gray-400 hover:text-gray-600 cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="bg-red-50 rounded-lg p-4 mb-6">
                <p class="text-sm text-red-800">
                    <strong>Warning:</strong> This action cannot be undone. All your companies, deals, and interactions will be permanently deleted. Your account will remain intact.
                </p>
            </div>
            
            <div class="flex space-x-3">
                <button onclick="resetAllData()" class="flex-1 bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                    Yes, Reset All Data
                </button>
                <button onclick="closeModal('resetDataModal')" class="flex-1 bg-gray-200 text-gray-800 py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div id="deleteAccountModal" class="fixed inset-0 z-50 flex items-center justify-center" style="display: none; background-color: rgba(0, 0, 0, 0.5);">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Delete Account</h3>
                        <p class="text-sm text-gray-600">This will permanently delete your account</p>
                    </div>
                </div>
                <button onclick="closeModal('deleteAccountModal')" class="text-gray-400 hover:text-gray-600 cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="bg-red-50 rounded-lg p-4 mb-6">
                <p class="text-sm text-red-800">
                    <strong>Final Warning:</strong> This action cannot be undone. Your account and all associated data will be permanently deleted. You will be logged out immediately.
                </p>
            </div>
            
            <div class="flex space-x-3">
                <button onclick="deleteAccount()" class="flex-1 bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700 transition-colors">
                    Yes, Delete Account
                </button>
                <button onclick="closeModal('deleteAccountModal')" class="flex-1 bg-gray-200 text-gray-800 py-3 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
@endsection