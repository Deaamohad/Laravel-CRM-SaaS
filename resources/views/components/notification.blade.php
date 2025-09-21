<!-- Notification Toast -->
<div id="notification" class="fixed top-4 right-4 z-50 transform translate-x-full transition-all duration-500 ease-in-out opacity-0 pointer-events-none">
    <div id="notification-content" class="bg-white rounded-lg shadow-xl border-l-4 p-6 min-w-80 max-w-md">
        <div class="flex items-start space-x-4">
            <div id="notification-icon" class="flex-shrink-0 mt-1">
                <!-- Success Icon -->
                <svg id="success-icon" class="h-6 w-6 text-green-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <!-- Error Icon -->
                <svg id="error-icon" class="h-6 w-6 text-red-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <p id="notification-title" class="text-sm font-semibold text-gray-900 mb-1"></p>
                <p id="notification-message" class="text-sm text-gray-600 leading-relaxed"></p>
            </div>
            <div class="flex-shrink-0 ml-4">
                <button onclick="hideNotification()" class="inline-flex text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 rounded-full p-1 transition-colors">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let notificationTimeout;

function showNotification(type, title, message) {
    const notification = document.getElementById('notification');
    const content = document.getElementById('notification-content');
    const titleEl = document.getElementById('notification-title');
    const messageEl = document.getElementById('notification-message');
    const successIcon = document.getElementById('success-icon');
    const errorIcon = document.getElementById('error-icon');
    
    // Clear any existing timeout
    if (notificationTimeout) {
        clearTimeout(notificationTimeout);
    }
    
    // Set content
    titleEl.textContent = title;
    messageEl.textContent = message;
    
    // Reset classes and icons
    content.className = 'bg-white rounded-lg shadow-xl border-l-4 p-6 min-w-80 max-w-md';
    successIcon.classList.add('hidden');
    errorIcon.classList.add('hidden');
    
    if (type === 'success') {
        content.classList.add('border-green-500');
        successIcon.classList.remove('hidden');
    } else if (type === 'error') {
        content.classList.add('border-red-500');
        errorIcon.classList.remove('hidden');
    }
    
    // Show notification - slide in from right
    notification.classList.remove('opacity-0', 'pointer-events-none');
    notification.classList.add('opacity-100', 'pointer-events-auto');
    
    // Small delay to ensure opacity is set first
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
        notification.classList.add('translate-x-0');
    }, 10);
    
    // Auto hide after 4 seconds
    notificationTimeout = setTimeout(() => {
        hideNotification();
    }, 4000);
}

function hideNotification() {
    const notification = document.getElementById('notification');
    
    if (notificationTimeout) {
        clearTimeout(notificationTimeout);
        notificationTimeout = null;
    }
    
    // Slide out to the right (reverse animation) - same direction as it came in
    notification.classList.remove('translate-x-0');
    notification.classList.add('translate-x-full');
    
    // Wait for slide animation to complete, then fade out and remove pointer events
    setTimeout(() => {
        notification.classList.remove('opacity-100', 'pointer-events-auto');
        notification.classList.add('opacity-0', 'pointer-events-none');
    }, 500); // Match the CSS transition duration
}

// Ensure notification is hidden on page load
document.addEventListener('DOMContentLoaded', function() {
    const notification = document.getElementById('notification');
    if (notification) {
        // Force hidden state on load
        notification.classList.add('translate-x-full', 'opacity-0', 'pointer-events-none');
        notification.classList.remove('translate-x-0', 'opacity-100', 'pointer-events-auto');
    }
});
</script>