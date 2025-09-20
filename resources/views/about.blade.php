@extends('layouts.guest')

@section('title', 'About Us - CRM SaaS')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-32 text-white overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-10 w-32 h-32 bg-white rounded-full animate-pulse"></div>
        <div class="absolute top-40 right-20 w-20 h-20 bg-white rounded-full animate-pulse delay-1000"></div>
        <div class="absolute bottom-32 left-20 w-24 h-24 bg-white rounded-full animate-pulse delay-500"></div>
        <div class="absolute bottom-20 right-10 w-16 h-16 bg-white rounded-full animate-pulse delay-2000"></div>
    </div>
    
    <div class="max-w-6xl mx-auto text-center px-4 relative z-10">
        <!-- Badge -->
        <div class="mb-8">
            <span class="bg-blue-500/20 backdrop-blur-sm border border-blue-400/30 text-blue-100 px-6 py-3 rounded-full text-lg font-semibold tracking-wide uppercase inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
                Our Story • Our Mission
            </span>
        </div>
        
        <!-- Main Title -->
        <h1 class="text-6xl lg:text-7xl font-black tracking-tight leading-none text-white mb-8">
            Empowering <span class="text-transparent bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text">Businesses</span><br>
            Around the World
        </h1>
        
        <!-- Subtitle -->
        <p class="text-2xl lg:text-3xl text-gray-300 max-w-4xl mx-auto font-light leading-relaxed mb-12">
            We're on a mission to simplify customer relationship management for businesses of all sizes.
        </p>
        
        <!-- Animated Stats Row - Directly under title -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 max-w-4xl mx-auto mb-8">
            <div class="text-center">
                <div class="text-5xl font-black text-white mb-2">
                    <span class="counter" data-target="10000">0</span>+
                </div>
                <div class="text-blue-200 font-semibold text-lg">Happy Customers</div>
                <div class="text-blue-300 text-sm">Worldwide and growing</div>
            </div>
            <div class="text-center">
                <div class="text-5xl font-black text-white mb-2">
                    <span class="counter" data-target="99.9">0</span>%
                </div>
                <div class="text-blue-200 font-semibold text-lg">Uptime</div>
                <div class="text-blue-300 text-sm">Reliable and secure</div>
            </div>
            <div class="text-center">
                <div class="text-5xl font-black text-white mb-2">
                    <span class="counter" data-target="24">0</span>/7
                </div>
                <div class="text-blue-200 font-semibold text-lg">Support</div>
                <div class="text-blue-300 text-sm">Always here to help</div>
            </div>
        </div>
    </div>
</section>

<!-- Our Story Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="text-4xl font-bold text-gray-900 mb-8">Our Story</h2>
                <div class="space-y-6 text-lg text-gray-700 leading-relaxed">
                    <p>
                        Founded in 2020, CRM SaaS was born from a simple idea: customer relationship management should be powerful yet easy to use. We noticed that many businesses struggled with complex, expensive CRM solutions that required extensive training and setup.
                    </p>
                    <p>
                        Our team of experienced developers and business analysts came together to create a solution that would democratize CRM access for businesses of all sizes. From startups to enterprises, we believe every organization deserves the tools to build meaningful customer relationships.
                    </p>
                    <p>
                        Today, we're proud to serve over 10,000 customers worldwide, helping them streamline their sales processes, improve customer satisfaction, and grow their businesses.
                    </p>
                </div>
            </div>
            <div class="relative">
                <div class="bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl p-8 text-white shadow-2xl">
                    <h3 class="text-2xl font-bold mb-6">Our Mission</h3>
                    <p class="text-lg leading-relaxed mb-6">
                        To empower businesses with intuitive, powerful CRM tools that help them build stronger customer relationships and achieve sustainable growth.
                    </p>
                    <div class="bg-white/20 backdrop-blur-sm rounded-lg p-4">
                        <p class="font-semibold">
                            "Simplicity is the ultimate sophistication in customer relationship management."
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-6">Our Values</h2>
            <p class="text-xl text-gray-600 font-light">The principles that guide everything we do</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Value 1 -->
            <div class="text-center p-8 rounded-2xl bg-gradient-to-br from-blue-50 to-blue-100 hover:shadow-lg transition-all duration-300">
                <div class="bg-blue-500 rounded-full p-4 w-16 h-16 mx-auto mb-6 flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Simplicity</h3>
                <p class="text-gray-600">We believe powerful tools should be easy to use and understand.</p>
            </div>
            
            <!-- Value 2 -->
            <div class="text-center p-8 rounded-2xl bg-gradient-to-br from-green-50 to-green-100 hover:shadow-lg transition-all duration-300">
                <div class="bg-green-500 rounded-full p-4 w-16 h-16 mx-auto mb-6 flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Reliability</h3>
                <p class="text-gray-600">Your data is safe with us, and our platform is always available when you need it.</p>
            </div>
            
            <!-- Value 3 -->
            <div class="text-center p-8 rounded-2xl bg-gradient-to-br from-purple-50 to-purple-100 hover:shadow-lg transition-all duration-300">
                <div class="bg-purple-500 rounded-full p-4 w-16 h-16 mx-auto mb-6 flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Customer Success</h3>
                <p class="text-gray-600">Your success is our success. We're here to support you every step of the way.</p>
            </div>
            
            <!-- Value 4 -->
            <div class="text-center p-8 rounded-2xl bg-gradient-to-br from-orange-50 to-orange-100 hover:shadow-lg transition-all duration-300">
                <div class="bg-orange-500 rounded-full p-4 w-16 h-16 mx-auto mb-6 flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Innovation</h3>
                <p class="text-gray-600">We continuously evolve and improve to meet your changing business needs.</p>
            </div>
            
            <!-- Value 5 -->
            <div class="text-center p-8 rounded-2xl bg-gradient-to-br from-red-50 to-red-100 hover:shadow-lg transition-all duration-300">
                <div class="bg-red-500 rounded-full p-4 w-16 h-16 mx-auto mb-6 flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Passion</h3>
                <p class="text-gray-600">We love what we do, and it shows in every feature we build.</p>
            </div>
            
            <!-- Value 6 -->
            <div class="text-center p-8 rounded-2xl bg-gradient-to-br from-indigo-50 to-indigo-100 hover:shadow-lg transition-all duration-300">
                <div class="bg-indigo-500 rounded-full p-4 w-16 h-16 mx-auto mb-6 flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Security</h3>
                <p class="text-gray-600">Your data privacy and security are our top priorities.</p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 bg-gradient-to-br from-blue-600 to-purple-700">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h2 class="text-4xl font-bold text-white mb-6">Ready to Transform Your Business?</h2>
        <p class="text-xl text-blue-100 mb-8 font-light leading-relaxed">
            Join thousands of businesses that trust CRM SaaS to manage their customer relationships.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/pricing" class="bg-white text-blue-600 hover:bg-gray-100 px-8 py-4 rounded-lg font-bold text-lg transition-all duration-300 shadow-lg hover:shadow-xl">
                View Pricing
            </a>
            <a href="/contact" class="border-2 border-white text-white hover:bg-white hover:text-blue-600 px-8 py-4 rounded-lg font-bold text-lg transition-all duration-300">
                Contact Us
            </a>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Counter Animation Function
    function animateCounter(element) {
        const target = parseFloat(element.getAttribute('data-target'));
        const duration = 2000; // 2 seconds
        const stepTime = 50; // Update every 50ms
        const steps = duration / stepTime;
        const increment = target / steps;
        let current = 0;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            
            // Format the number
            if (target >= 1000) {
                element.textContent = Math.floor(current).toLocaleString();
            } else {
                element.textContent = current.toFixed(1);
            }
        }, stepTime);
    }
    
    // Intersection Observer for triggering animation when in viewport
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counters = entry.target.querySelectorAll('.counter');
                counters.forEach(counter => {
                    if (!counter.classList.contains('animated')) {
                        counter.classList.add('animated');
                        animateCounter(counter);
                    }
                });
            }
        });
    }, {
        threshold: 0.3
    });
    
    // Observe the hero stats section
    const heroStatsSection = document.querySelector('section .grid.grid-cols-1.md\\:grid-cols-3');
    if (heroStatsSection) {
        observer.observe(heroStatsSection);
    }
});
</script>
@endsection