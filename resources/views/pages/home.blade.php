@extends('layouts.guest')

@section('title', 'Cliento - Simple CRM for Your Business')

@section('content')
<section class="py-20 lg:py-32 bg-gradient-to-br from-gray-50 to-blue-50">
    <div class="max-w-7xl mx-auto px-4 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <div class="text-left">

                
                <h1 class="text-5xl lg:text-6xl font-black tracking-tight text-gray-900 mb-6 leading-tight">
                    Transform Your 
                    <span class="text-transparent bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text">Business</span> 
                    with Smart CRM
                </h1>
                
                <p class="text-xl lg:text-2xl text-gray-600 mb-8 leading-relaxed">
                    Manage companies, track deals, and grow your sales with our intuitive CRM platform. 
                    <span class="text-gray-900 font-medium">Get insights that drive results.</span>
                </p>
            </div>
            
            <div class="relative">
                <div class="relative z-10">
                    <img src="{{ asset('images/data.svg') }}" 
                        alt="CRM Analytics Dashboard" 
                        class="w-full h-auto" />
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Social Proof Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 lg:px-8">
        <!-- Trusted Companies -->
        <div class="text-center mb-16">
            <p class="text-gray-500 text-lg font-medium mb-8">Trusted by 10,000+ businesses worldwide</p>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8 items-center opacity-60">
                <!-- Company Logos -->
                <div class="flex items-center justify-center h-12">
                    <div class="bg-gray-300 rounded px-8 py-3 text-gray-600 font-bold text-sm">TechCorp</div>
                </div>
                <div class="flex items-center justify-center h-12">
                    <div class="bg-gray-300 rounded px-8 py-3 text-gray-600 font-bold text-sm">InnovateLabs</div>
                </div>
                <div class="flex items-center justify-center h-12">
                    <div class="bg-gray-300 rounded px-8 py-3 text-gray-600 font-bold text-sm">GlobalSales</div>
                </div>
                <div class="flex items-center justify-center h-12">
                    <div class="bg-gray-300 rounded px-8 py-3 text-gray-600 font-bold text-sm">BizGrow</div>
                </div>
                <div class="flex items-center justify-center h-12">
                    <div class="bg-gray-300 rounded px-8 py-3 text-gray-600 font-bold text-sm">DataFlow</div>
                </div>
                <div class="flex items-center justify-center h-12">
                    <div class="bg-gray-300 rounded px-8 py-3 text-gray-600 font-bold text-sm">CloudSync</div>
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid md:grid-cols-4 gap-8 mb-20" id="stats-section">
            <div class="text-center">
                <div class="text-4xl lg:text-5xl font-black text-blue-600 mb-2 counter" data-target="10000" data-suffix="+">0</div>
                <div class="text-gray-600 font-medium">Active Users</div>
            </div>
            <div class="text-center">
                <div class="text-4xl lg:text-5xl font-black text-purple-600 mb-2 counter" data-target="50" data-suffix="M+">0</div>
                <div class="text-gray-600 font-medium">Deals Managed</div>
            </div>
            <div class="text-center">
                <div class="text-4xl lg:text-5xl font-black text-green-600 mb-2 counter" data-target="99.9" data-suffix="%">0</div>
                <div class="text-gray-600 font-medium">Uptime SLA</div>
            </div>
            <div class="text-center">
                <div class="text-4xl lg:text-5xl font-black text-orange-600 mb-2 counter" data-target="4.9" data-suffix="/5">0</div>
                <div class="text-gray-600 font-medium">Customer Rating</div>
            </div>
        </div>

        <script>
        // Animated Counter Function
        function animateCounter(element, target, suffix = '', duration = 2000) {
            const start = 0;
            const increment = target / (duration / 16); // 60fps
            let current = start;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                
                // Format the number
                let displayValue;
                if (target >= 1000) {
                    displayValue = Math.floor(current).toLocaleString();
                } else {
                    displayValue = current.toFixed(1);
                }
                
                element.textContent = displayValue + suffix;
            }, 16);
        }

        // Intersection Observer for scroll-triggered animation
        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px 0px -100px 0px'
        };

        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counters = entry.target.querySelectorAll('.counter');
                    
                    counters.forEach((counter, index) => {
                        const target = parseFloat(counter.getAttribute('data-target'));
                        const suffix = counter.getAttribute('data-suffix') || '';
                        
                        // Stagger the animations slightly
                        setTimeout(() => {
                            animateCounter(counter, target, suffix, 2500);
                        }, index * 200);
                    });
                    
                    // Only animate once
                    counterObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Start observing when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            const statsSection = document.getElementById('stats-section');
            if (statsSection) {
                counterObserver.observe(statsSection);
            }
        });
        </script>

        <!-- Testimonials -->
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-black text-gray-900 mb-4">
                What Our Customers Say
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Join thousands of businesses that have transformed their sales process with our CRM
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Testimonial 1 -->
            <div class="bg-gray-50 rounded-2xl p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="flex items-center mb-4">
                    <div class="flex text-yellow-400">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    </div>
                </div>
                <blockquote class="text-gray-700 text-lg leading-relaxed mb-6">
                    "This CRM has completely transformed how we manage our sales pipeline. We've increased our close rate by 40% in just 3 months!"
                </blockquote>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white mr-4">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-900">Sarah Johnson</div>
                        <div class="text-gray-600 text-sm">Sales Director, TechStart Inc.</div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="bg-gray-50 rounded-2xl p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="flex items-center mb-4">
                    <div class="flex text-yellow-400">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    </div>
                </div>
                <blockquote class="text-gray-700 text-lg leading-relaxed mb-6">
                    "The analytics and reporting features are incredible. We finally have clear visibility into our sales performance and can make data-driven decisions."
                </blockquote>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-blue-500 rounded-full flex items-center justify-center text-white mr-4">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-900">Michael Chen</div>
                        <div class="text-gray-600 text-sm">CEO, Growth Dynamics</div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="bg-gray-50 rounded-2xl p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="flex items-center mb-4">
                    <div class="flex text-yellow-400">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    </div>
                </div>
                <blockquote class="text-gray-700 text-lg leading-relaxed mb-6">
                    "Easy to use, powerful features, and excellent customer support. Our team was up and running in minutes, not hours!"
                </blockquote>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white mr-4">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-900">Emily Rodriguez</div>
                        <div class="text-gray-600 text-sm">VP Sales, Innovation Labs</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center mt-16">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl p-12 text-white">
                <h3 class="text-3xl font-bold mb-4">Join 10,000+ Happy Customers</h3>
                <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                    See why businesses trust our CRM to grow their sales and build lasting customer relationships.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" class="bg-white text-blue-600 px-8 py-4 rounded-xl font-bold text-lg hover:shadow-lg transform hover:scale-105 transition-all duration-300">
                        Start Free Trial
                    </a>
                    <a href="{{ route('contact') }}" class="border-2 border-white text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-white hover:text-blue-600 transition-all duration-300">
                        Contact Sales
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection