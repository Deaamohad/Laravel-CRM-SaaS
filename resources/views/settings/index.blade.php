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
        <button id="api-tab" class="px-3 md:px-4 py-2 text-sm md:text-lg font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700 focus:outline-none whitespace-nowrap" onclick="switchTab('api')">
            API Tokens
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
                
                <form id="profileForm" action="{{ route('settings.profile') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    
                    <!-- Profile Picture -->
                    <div class="mb-8">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Profile Picture</label>
                        <div class="mt-2 flex items-center">
                            <div class="w-20 h-20 rounded-full overflow-hidden bg-gray-100 flex items-center justify-center">
                                @if($user->avatar)
                                    <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="Profile" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center text-white text-xl font-semibold">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div class="ml-5 flex flex-col">
                                <label for="avatar" class="bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 cursor-pointer">

                                    Change
                                </label>
                                <input id="avatar" name="avatar" type="file" accept="image/*" class="sr-only">
                                <p class="mt-1.5 text-xs text-gray-500">JPG, PNG, GIF up to 2MB</p>
                            </div>
                        </div>
                        @error('avatar')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
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
            </div>
            
            <!-- API Tokens Panel -->
            <div id="api-panel" class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 md:p-6" style="display: none;">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">API Token Management</h3>
                <p class="text-sm text-gray-500 mb-6">Create and manage your API tokens for integrations and automation.</p>
                
                <!-- Create New Token -->
                <div class="mb-6 p-4 bg-blue-50 rounded-lg">
                    <h4 class="font-semibold text-blue-900 mb-2">Create New API Token</h4>
                    <form id="createTokenForm" class="flex flex-col md:flex-row gap-2">
                        <input type="text" id="tokenName" placeholder="Token name (e.g., 'Mobile App')" 
                               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Create Token
                        </button>
                    </form>
                </div>

                <!-- Current Tokens -->
                <div id="tokensList">
                    <h4 class="font-semibold text-gray-900 mb-3">Your API Tokens</h4>
                    <div id="tokensContainer" class="space-y-3">
                        <p class="text-gray-500 text-sm">Loading tokens...</p>
                    </div>
                </div>

                <!-- API Documentation Link -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <a href="{{ route('api.management') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        View Full API Documentation
                    </a>
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

// Switch between profile, security, and API tabs
function switchTab(tab) {
    // Update tab buttons immediately
    document.getElementById('profile-tab').classList.remove('border-blue-600', 'text-blue-600');
    document.getElementById('profile-tab').classList.add('border-transparent', 'text-gray-500');
    document.getElementById('security-tab').classList.remove('border-blue-600', 'text-blue-600');
    document.getElementById('security-tab').classList.add('border-transparent', 'text-gray-500');
    document.getElementById('api-tab').classList.remove('border-blue-600', 'text-blue-600');
    document.getElementById('api-tab').classList.add('border-transparent', 'text-gray-500');
    
    // Activate the selected tab
    document.getElementById(`${tab}-tab`).classList.remove('border-transparent', 'text-gray-500');
    document.getElementById(`${tab}-tab`).classList.add('border-blue-600', 'text-blue-600');
    
    // Add CSS opacity transitions
    const profilePanel = document.getElementById('profile-panel');
    const securityPanel = document.getElementById('security-panel');
    const apiPanel = document.getElementById('api-panel');
    
    // Set initial styles if not already set
    if (!profilePanel.style.transition) {
        profilePanel.style.transition = 'opacity 150ms ease-in-out';
        securityPanel.style.transition = 'opacity 150ms ease-in-out';
        apiPanel.style.transition = 'opacity 150ms ease-in-out';
    }
    
    // Show/hide panels with smooth transition
    if (tab === 'profile') {
        // Hide other panels
        securityPanel.style.opacity = '0';
        apiPanel.style.opacity = '0';
        setTimeout(() => {
            securityPanel.classList.add('hidden');
            apiPanel.classList.add('hidden');
            // Show profile panel
            profilePanel.classList.remove('hidden');
            setTimeout(() => {
                profilePanel.style.opacity = '1';
            }, 10);
        }, 150);
    } else if (tab === 'security') {
        // Hide other panels
        profilePanel.style.opacity = '0';
        apiPanel.style.opacity = '0';
        setTimeout(() => {
            profilePanel.classList.add('hidden');
            apiPanel.classList.add('hidden');
            // Show security panel
            securityPanel.classList.remove('hidden');
            setTimeout(() => {
                securityPanel.style.opacity = '1';
            }, 10);
        }, 150);
    } else if (tab === 'api') {
        // Hide other panels
        profilePanel.style.opacity = '0';
        securityPanel.style.opacity = '0';
        setTimeout(() => {
            profilePanel.classList.add('hidden');
            securityPanel.classList.add('hidden');
            // Show API panel
            apiPanel.classList.remove('hidden');
            setTimeout(() => {
                apiPanel.style.opacity = '1';
                loadApiTokens(); // Load tokens when API tab is shown
            }, 10);
        }, 150);
    }
}

// Initialize tabs based on session or form errors
document.addEventListener('DOMContentLoaded', function() {
    // Check for active tab in session
    const activeTab = '{{ session('active_tab') }}';
    
    // Check for errors in the password form that would need to show that tab
    const hasPasswordErrors = {{ $errors->has('current_password') || $errors->has('password') ? 'true' : 'false' }};
    const successMessage = {{ session('success') ? 'true' : 'false' }};
    
    // Set all panels to hidden initially to prevent flash
    const profilePanel = document.getElementById('profile-panel');
    const securityPanel = document.getElementById('security-panel');
    const apiPanel = document.getElementById('api-panel');
    
    profilePanel.classList.add('hidden');
    securityPanel.classList.add('hidden');
    apiPanel.classList.add('hidden');
    
    // Determine which tab to show (priority: active_tab in session, then password errors, then default to profile)
    if (activeTab === 'security') {
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
    if (successMessage) {
        // Ensure flash messages are visible regardless of which tab is shown
        const flashMessages = document.querySelectorAll('.flash-message');
        flashMessages.forEach(message => {
            message.style.display = 'block';
        });
    }
    
    // Preview selected image before upload
    const avatar = document.getElementById('avatar');
    
    if (avatar) {
        avatar.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const profileImgContainer = document.querySelector('.w-20.h-20.rounded-full.overflow-hidden img, .w-20.h-20.rounded-full.overflow-hidden div');
                    
                    if (profileImgContainer) {
                        // If it's already an image tag
                        if (profileImgContainer.tagName === 'IMG') {
                            profileImgContainer.src = e.target.result;
                        } else {
                            // If it's a div with initials, replace with an image
                            const parent = profileImgContainer.parentElement;
                            parent.innerHTML = '<img src="' + e.target.result + '" alt="Profile" class="w-full h-full object-cover">';
                        }
                    }
                }
                reader.readAsDataURL(file);
            }
        });
    }
});

// API Token Management Functions
function loadApiTokens() {
    fetch('/api/tokens', {
        method: 'GET',
        headers: {
            'Authorization': 'Bearer ' + getAuthToken(),
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        const container = document.getElementById('tokensContainer');
        if (data.success && data.tokens.length > 0) {
            container.innerHTML = data.tokens.map(token => `
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div>
                        <h5 class="font-medium text-gray-900">${token.name}</h5>
                        <p class="text-sm text-gray-500">Created: ${new Date(token.created_at).toLocaleDateString()}</p>
                        ${token.last_used_at ? `<p class="text-xs text-gray-400">Last used: ${new Date(token.last_used_at).toLocaleDateString()}</p>` : ''}
                    </div>
                    <button onclick="revokeToken(${token.id})" class="px-3 py-1 text-sm text-red-600 hover:text-red-800 hover:bg-red-50 rounded">
                        Revoke
                    </button>
                </div>
            `).join('');
        } else {
            container.innerHTML = '<p class="text-gray-500 text-sm">No API tokens found. Create one above to get started.</p>';
        }
    })
    .catch(error => {
        console.error('Error loading tokens:', error);
        document.getElementById('tokensContainer').innerHTML = '<p class="text-red-500 text-sm">Error loading tokens. Please refresh the page.</p>';
    });
}

function getAuthToken() {
    // Try to get token from localStorage or sessionStorage
    return localStorage.getItem('api_token') || sessionStorage.getItem('api_token') || '';
}

// Handle token creation form
document.addEventListener('DOMContentLoaded', function() {
    const createTokenForm = document.getElementById('createTokenForm');
    if (createTokenForm) {
        createTokenForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const tokenName = document.getElementById('tokenName').value.trim();
            if (!tokenName) {
                showNotification('Please enter a token name', 'error');
                return;
            }
            
            fetch('/api/tokens', {
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + getAuthToken(),
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    token_name: tokenName
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show the token to the user
                    showTokenModal(data.token, tokenName);
                    document.getElementById('tokenName').value = '';
                    loadApiTokens(); // Reload the tokens list
                } else {
                    showNotification('Error creating token: ' + (data.message || 'Unknown error'), 'error');
                }
            })
            .catch(error => {
                console.error('Error creating token:', error);
                showNotification('Error creating token. Please try again.', 'error');
            });
        });
    }
});

function showTokenModal(token, tokenName) {
    const modal = document.createElement('div');
    modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
    modal.innerHTML = `
        <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">API Token Created</h3>
            <p class="text-sm text-gray-600 mb-4">Your new token for "${tokenName}" has been created. Copy it now - you won't be able to see it again!</p>
            <div class="bg-gray-100 p-3 rounded border mb-4">
                <code class="text-sm break-all">${token}</code>
            </div>
            <div class="flex space-x-3">
                <button onclick="copyTokenToClipboard('${token}')" class="flex-1 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Copy Token
                </button>
                <button onclick="closeTokenModal()" class="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                    Close
                </button>
            </div>
        </div>
    `;
    document.body.appendChild(modal);
}

function copyTokenToClipboard(token) {
    navigator.clipboard.writeText(token).then(() => {
        showNotification('Token copied to clipboard!', 'success');
        closeTokenModal();
    });
}

function closeTokenModal() {
    const modal = document.querySelector('.fixed.inset-0.bg-black.bg-opacity-50');
    if (modal) {
        modal.remove();
    }
}

function revokeToken(tokenId) {
    if (!confirm('Are you sure you want to revoke this token? This action cannot be undone.')) {
        return;
    }
    
    fetch(`/api/tokens/${tokenId}`, {
        method: 'DELETE',
        headers: {
            'Authorization': 'Bearer ' + getAuthToken(),
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Token revoked successfully', 'success');
            loadApiTokens(); // Reload the tokens list
        } else {
            showNotification('Error revoking token: ' + (data.message || 'Unknown error'), 'error');
        }
    })
    .catch(error => {
        console.error('Error revoking token:', error);
        showNotification('Error revoking token. Please try again.', 'error');
    });
}

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
</script>
@endsection