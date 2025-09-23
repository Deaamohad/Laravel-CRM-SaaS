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
            
            <!-- Improved Auto-scrolling Logo Carousel with JavaScript -->
            <div id="logo-carousel" class="relative">
                <!-- Gradient overlays for smooth fade effect -->
                <div class="absolute left-0 top-0 h-full w-20 bg-gradient-to-r from-white to-transparent z-10"></div>
                <div class="absolute right-0 top-0 h-full w-20 bg-gradient-to-l from-white to-transparent z-10"></div>
                
                <!-- Logo tracks with JavaScript-based infinite scroll -->
                <div id="logo-marquee" class="overflow-hidden h-40 relative">
                    <div class="logo-track" id="logo-track-primary">
                        @for($i = 1; $i <= 11; $i++)
                        <div class="flex items-center justify-center h-40 group flex-shrink-0 logo-item mx-10">
                            <img src="{{ asset('images/logos/logos (' . $i . ').png', true) }}"
                                 alt="Partner {{ $i }}"
                                 loading="lazy"
                                 class="h-28 w-auto object-contain transition-all duration-300 opacity-90 group-hover:opacity-100">
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
            
            <!-- CSS Fallback for logo carousel -->
            <style>
                /* Basic styling to ensure logos are visible even if JS fails */
                #logo-track-primary {
                    display: flex;
                    flex-wrap: nowrap;
                    overflow-x: auto;
                    -webkit-overflow-scrolling: touch;
                    scroll-behavior: smooth;
                    padding: 20px 0;
                }
                
                .logo-item img {
                    height: 7rem;
                    width: auto;
                    transition: transform 0.3s ease;
                }
                
                .logo-item:hover img {
                    transform: scale(1.05);
                }
                
                @media (max-width: 640px) {
                    .logo-item img {
                        height: 3.5rem;
                    }
                }
            </style>
            
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Set up an improved infinite scroll with multiple clones
                    function setupImprovedMarquee() {
                        const marqueeContainer = document.getElementById('logo-marquee');
                        const track = document.getElementById('logo-track-primary');
                        
                        // Make sure the elements exist
                        if (!track || !marqueeContainer) return;
                        
                        // Clear any existing clones first
                        const existingClones = marqueeContainer.querySelectorAll('.logo-track:not(#logo-track-primary)');
                        existingClones.forEach(clone => clone.remove());
                        
                        // Reset animation and position on primary track
                        track.style.animation = 'none';
                        track.style.position = 'absolute';
                        track.style.left = '0';
                        track.style.transform = 'translateX(0)';
                        
                        // Get the accurate width after images have loaded
                        const trackWidth = track.offsetWidth;
                        const containerWidth = marqueeContainer.offsetWidth;
                        
                        // Set the container height to match the track
                        marqueeContainer.style.height = track.offsetHeight + 'px';
                        
                        // Calculate how many clones we need to fill viewport plus buffer
                        // We want at least 3 complete sets to ensure no visual gaps
                        const numberOfClones = Math.max(3, Math.ceil((containerWidth * 3) / trackWidth));
                        
                        // Create multiple clones for a more robust infinite scroll
                        for (let i = 0; i < numberOfClones; i++) {
                            const clone = track.cloneNode(true);
                            clone.id = `logo-track-clone-${i}`;
                            clone.classList.add('logo-track-clone');
                            clone.style.position = 'absolute';
                            clone.style.left = '0'; // All tracks start at left 0
                            clone.style.transform = `translateX(${trackWidth * (i + 1)}px)`; // Positioned with transform instead
                            marqueeContainer.appendChild(clone);
                        }
                        
                        // Calculate a good duration - slower for better readability
                        // The entire carousel should take about 30-40 seconds for one loop
                        const totalWidth = trackWidth * (numberOfClones + 1);
                        const duration = totalWidth / 50; // pixels per second
                        
                        // Create a smooth continuous scroll with CSS transforms instead of left position
                        // This eliminates any flickering during repositioning
                        let scrollPosition = 0;
                        const scrollSpeed = 0.8; // pixels per frame - adjust for desired speed
                        
                        // Set up the continuous scroll animation
                        function animateScroll() {
                            // Increment scroll position
                            scrollPosition += scrollSpeed;
                            
                            // If we've scrolled a complete track width, reset to avoid floating point issues
                            if (scrollPosition >= trackWidth) {
                                scrollPosition = 0;
                            }
                            
                            // Get all tracks
                            const allTracks = marqueeContainer.querySelectorAll('.logo-track');
                            
                            // Apply the transform to all tracks with an offset
                            allTracks.forEach((trackElement, index) => {
                                const basePosition = index * trackWidth; // Each track starts after the previous one
                                const transformX = -scrollPosition + basePosition;
                                trackElement.style.transform = `translateX(${transformX}px)`;
                                
                                // Check if this track has moved completely off-screen to the left
                                if (transformX < -trackWidth) {
                                    // Instead of abrupt reposition, just shift it by the total width of all tracks
                                    // This creates a seamless loop
                                    const totalTracksWidth = trackWidth * allTracks.length;
                                    trackElement.style.transform = `translateX(${transformX + totalTracksWidth}px)`;
                                }
                            });
                            
                            // Continue the animation
                            animationId = requestAnimationFrame(animateScroll);
                        }
                        
                        // Start the animation
                        let animationId = requestAnimationFrame(animateScroll);
                        
                        // Pause animations on hover
                        marqueeContainer.addEventListener('mouseenter', () => {
                            cancelAnimationFrame(animationId);
                        });
                        
                        marqueeContainer.addEventListener('mouseleave', () => {
                            animationId = requestAnimationFrame(animateScroll);
                        });
                        
                        // Store the animation ID for cleanup
                        marqueeContainer.dataset.animationId = animationId;
                    }
                    
                    // Wait for images to load before setting up
                    const images = document.querySelectorAll('#logo-track-primary img');
                    
                    // Debug information
                    console.log(`Logo carousel: Found ${images.length} logo images`);
                    if (images.length > 0) {
                        images.forEach((img, index) => {
                            console.log(`Logo ${index + 1} src: ${img.src}, complete: ${img.complete}`);
                        });
                    }
                    
                    if (images.length > 0) {
                        let loadedCount = 0;
                        let errorCount = 0;
                        
                        images.forEach((img, index) => {
                            if (img.complete && img.naturalWidth !== 0) {
                                console.log(`Logo ${index + 1} already loaded`);
                                loadedCount++;
                                if (loadedCount + errorCount === images.length) {
                                    console.log('All logos processed, setting up marquee');
                                    setupImprovedMarquee();
                                }
                            } else {
                                img.addEventListener('load', () => {
                                    console.log(`Logo ${index + 1} loaded successfully`);
                                    loadedCount++;
                                    if (loadedCount + errorCount === images.length) {
                                        console.log('All logos processed, setting up marquee');
                                        setupImprovedMarquee();
                                    }
                                });
                                img.addEventListener('error', () => {
                                    console.error(`Error loading logo ${index + 1}: ${img.src}`);
                                    errorCount++;
                                    // Try to reload with a corrected path if there's an issue
                                    if (img.src.includes('http://') || img.src.includes('https://')) {
                                        // Already has protocol, don't try to fix
                                    } else {
                                        // Try without asset helper in case there's an issue with the path
                                        img.src = `/images/logos/logos (${index + 1}).png`;
                                    }
                                    
                                    if (loadedCount + errorCount === images.length) {
                                        console.log('All logos processed (with some errors), setting up marquee');
                                        setupImprovedMarquee();
                                    }
                                });
                            }
                        });
                        
                        // Fallback in case images don't load
                        setTimeout(() => {
                            console.log('Fallback timeout reached, setting up marquee');
                            setupImprovedMarquee();
                        }, 2000);
                    } else {
                        // No images, set up immediately
                        console.warn('No logo images found, setting up empty marquee');
                        setupImprovedMarquee();
                    }
                    
                    // Handle window resize for responsiveness
                    let resizeTimeout;
                    window.addEventListener('resize', () => {
                        // Debounce resize event
                        clearTimeout(resizeTimeout);
                        resizeTimeout = setTimeout(() => {
                            // Clean up existing animation
                            const marqueeContainer = document.getElementById('logo-marquee');
                            if (marqueeContainer && marqueeContainer.dataset.animationId) {
                                cancelAnimationFrame(parseInt(marqueeContainer.dataset.animationId));
                            }
                            
                            // Rebuild the marquee
                            setupImprovedMarquee();
                        }, 250);
                    });
                    
                    // Clean up when navigating away
                    window.addEventListener('beforeunload', () => {
                        const marqueeContainer = document.getElementById('logo-marquee');
                        if (marqueeContainer && marqueeContainer.dataset.animationId) {
                            cancelAnimationFrame(parseInt(marqueeContainer.dataset.animationId));
                        }
                    });
                });
            </script>
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