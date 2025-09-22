<header class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-200/50 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-5">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/Logo.svg') }}" alt="Logo" class="w-12 h-12">
                <a href="{{ route('home') }}" class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                    Cliento
                </a>
            </div>

            <nav class="hidden md:flex items-center space-x-10">
                <a href="{{ route('about') }}" class="relative text-gray-700 hover:text-blue-600 transition-all duration-300 font-semibold text-lg group py-2">
                    About
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-600 to-purple-600 transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="{{ route('pricing') }}" class="relative text-gray-700 hover:text-blue-600 transition-all duration-300 font-semibold text-lg group py-2">
                    Pricing
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-600 to-purple-600 transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="{{ route('contact') }}" class="relative text-gray-700 hover:text-blue-600 transition-all duration-300 font-semibold text-lg group py-2">
                    Contact
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-blue-600 to-purple-600 transition-all duration-300 group-hover:w-full"></span>
                </a>
                
                <div class="flex items-center space-x-6">
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 transition-colors font-semibold text-lg">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-full font-semibold text-lg hover:shadow-lg transform hover:scale-105 transition-all duration-300">
                            Get Started
                        </a>
                    @else
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-700 font-medium">Hello, {{ Auth::user()->name }}!</span>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-700 hover:text-red-600 transition-colors font-semibold text-lg">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @endguest
                </div>
            </nav>

            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-gray-700 hover:text-blue-600 transition-colors p-2">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div id="mobile-menu" class="md:hidden hidden bg-white/95 backdrop-blur-md border-t border-gray-200/50">
        <div class="px-6 py-8 space-y-6">
            <a href="{{ route('about') }}" class="block text-gray-700 hover:text-blue-600 transition-colors font-semibold text-lg py-2">About</a>
            <a href="{{ route('pricing') }}" class="block text-gray-700 hover:text-blue-600 transition-colors font-semibold text-lg py-2">Pricing</a>
            <a href="{{ route('contact') }}" class="block text-gray-700 hover:text-blue-600 transition-colors font-semibold text-lg py-2">Contact</a>
            <div class="pt-6 border-t border-gray-200">
                @guest
                    <a href="{{ route('login') }}" class="block text-gray-700 hover:text-blue-600 transition-colors font-semibold text-lg py-3">Sign In</a>
                    <a href="{{ route('register') }}" class="block bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-full font-semibold text-lg text-center mt-4 hover:shadow-lg transition-all">Get Started</a>
                @else
                    <div class="space-y-3">
                        <div class="text-gray-700 font-medium py-2">Hello, {{ Auth::user()->name }}!</div>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="w-full text-left text-gray-700 hover:text-red-600 transition-colors font-semibold text-lg py-3">
                                Logout
                            </button>
                        </form>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</header>

<div class="h-24"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }
});
</script>