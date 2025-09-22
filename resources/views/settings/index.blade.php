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

<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Settings</h1>
        <p class="text-gray-600">Manage your profile settings</p>
    </div>

    <!-- Flash messages are handled in the main layout -->

    <div class="mb-6 flex items-center space-x-4">
        <button id="profile-tab" class="px-4 py-2 text-lg font-medium border-b-2 border-blue-600 text-blue-600 focus:outline-none" onclick="switchTab('profile')">
            Profile Settings
        </button>
        <button id="security-tab" class="px-4 py-2 text-lg font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700 focus:outline-none" onclick="switchTab('security')">
            Security
        </button>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Sidebar with Profile Info -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-6">
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
        <div class="lg:col-span-2">
            <!-- Profile Information Form - Initially visible -->
            <div id="profile-panel" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
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
                                        {{ substr($user->first_name ?? '', 0, 1) }}{{ substr($user->last_name ?? '', 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div class="ml-5">
                                <label for="avatar" class="bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 cursor-pointer">
                                    Change
                                </label>
                                <input id="avatar" name="avatar" type="file" accept="image/*" class="sr-only">
                                <p class="mt-1 text-xs text-gray-500">JPG, PNG, GIF up to 2MB</p>
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
            <div id="security-panel" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
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
    } else {
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
    // Check for active tab in session
    const activeTab = '{{ session('active_tab') }}';
    
    // Check for errors in the password form that would need to show that tab
    const hasPasswordErrors = {{ $errors->has('current_password') || $errors->has('password') ? 'true' : 'false' }};
    const successMessage = {{ session('success') ? 'true' : 'false' }};
    
    // Set both panels to hidden initially to prevent flash
    const profilePanel = document.getElementById('profile-panel');
    const securityPanel = document.getElementById('security-panel');
    
    profilePanel.classList.add('hidden');
    securityPanel.classList.add('hidden');
    
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
</script>
@endsection