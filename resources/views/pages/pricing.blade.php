@extends('layouts.guest')

@section('title', 'Pricing - Cliento')

@section('content')
<style>
@keyframes float {
    0%, 100% { 
        transform: translateY(0px) rotate(0deg);
        opacity: 0.7;
    }
    50% { 
        transform: translateY(-20px) rotate(180deg);
        opacity: 1;
    }
}

@keyframes floatReverse {
    0%, 100% { 
        transform: translateY(0px) rotate(0deg);
        opacity: 0.8;
    }
    50% { 
        transform: translateY(20px) rotate(-180deg);
        opacity: 0.4;
    }
}

@keyframes drift {
    0% { 
        transform: translateX(0px) translateY(0px) scale(1);
    }
    25% { 
        transform: translateX(10px) translateY(-15px) scale(1.1);
    }
    50% { 
        transform: translateX(-10px) translateY(-10px) scale(0.9);
    }
    75% { 
        transform: translateX(15px) translateY(5px) scale(1.05);
    }
    100% { 
        transform: translateX(0px) translateY(0px) scale(1);
    }
}

.bubble-float {
    animation: float 6s ease-in-out infinite;
}

.bubble-reverse {
    animation: floatReverse 8s ease-in-out infinite;
}

.bubble-drift {
    animation: drift 10s ease-in-out infinite;
}

.bubble-glow {
    box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
}
</style>

<section class="relative bg-gradient-to-br from-blue-800 via-blue-750 to-blue-800 text-white overflow-hidden py-32">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-16 left-16 w-28 h-28 bg-white rounded-full bubble-float bubble-glow"></div>
        <div class="absolute top-24 right-24 w-18 h-18 bg-white rounded-full bubble-reverse bubble-glow" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-24 left-24 w-22 h-22 bg-white rounded-full bubble-drift bubble-glow" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-16 right-16 w-14 h-14 bg-white rounded-full bubble-float bubble-glow" style="animation-delay: 3s;"></div>
        <div class="absolute top-1/2 left-1/3 w-10 h-10 bg-white rounded-full bubble-reverse bubble-glow" style="animation-delay: 4s;"></div>
        <div class="absolute top-1/3 right-1/3 w-16 h-16 bg-white rounded-full bubble-drift bubble-glow" style="animation-delay: 0.5s;"></div>
    </div>
    
    <div class="max-w-7xl mx-auto text-center px-4 relative z-10">
        <div class="mb-8">
            <span class="bg-blue-500/20 backdrop-blur-sm border border-blue-400/30 text-blue-100 px-5 py-2.5 rounded-full text-base font-semibold tracking-wide uppercase inline-flex items-center">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
                Transparent Pricing • No Hidden Fees
            </span>
        </div>
        
        <h1 class="text-5xl lg:text-7xl font-black tracking-tight leading-tight text-white mb-8">
            Powerful.<br>
            <span class="gradient-text-cyan-blue-purple">Affordable</span>.<br>
            <span class="text-4xl lg:text-6xl">Easy to use.</span>
        </h1>
        
        <p class="text-xl lg:text-2xl text-blue-100 max-w-3xl mx-auto font-light leading-relaxed mb-10">
            Cliento provides unmatched clarity and control for small teams.<br>
            <span class="text-white font-medium">Simple, transparent pricing to get you started today.</span>
        </p>
        
        <div class="flex flex-col lg:flex-row gap-5 justify-center items-center">
            <a href="#pricing-cards" class="bg-white text-blue-800 hover:bg-gray-100 px-9 py-4.5 rounded-xl font-bold text-lg transition-all duration-300 shadow-2xl hover:shadow-white/20 hover:scale-105 inline-flex items-center group">
                <svg class="w-5 h-5 mr-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
                View Pricing Plans
            </a>
            <a href="#" class="border-2 border-white/70 backdrop-blur-sm text-white hover:bg-white hover:text-blue-800 px-9 py-4.5 rounded-xl font-bold text-lg transition-all duration-300 hover:scale-105 inline-flex items-center group">
                <svg class="w-5 h-5 mr-2 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Try Free Demo
            </a>
        </div>
    </div>
</section>


<section id="pricing-cards" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="pricing-section-title">Choose Your Plan</h2>
            <p class="pricing-section-subtitle mb-8">Start free, upgrade when you grow. No hidden fees, cancel anytime.</p>
        </div>
        
        <div class="grid lg:grid-cols-3 gap-8 lg:gap-6">
            <div class="pricing-card-enhanced hover-lift text-center">
                <div class="mb-4">
                    <div class="bg-gray-100 rounded-full p-3 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="pricing-card-title-enhanced">Starter</h3>
                    <p class="pricing-card-description">Perfect for small businesses getting started with CRM</p>
                </div>
                
                <div class="pricing-card-price-enhanced">
                    <span class="pricing-card-price-amount-enhanced">Free</span>
                    <span class="text-gray-600 text-lg font-medium">/forever</span>
                </div>
                
                <ul class="pricing-card-features-enhanced">
                    <li class="pricing-card-feature-enhanced">
                        <svg class="pricing-card-feature-icon-enhanced" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Basic deal tracking
                    </li>
                    <li class="pricing-card-feature-enhanced">
                        <svg class="pricing-card-feature-icon-enhanced" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Contact management
                    </li>
                    <li class="pricing-card-feature-enhanced">
                        <svg class="pricing-card-feature-icon-enhanced" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Basic reporting
                    </li>
                    <li class="pricing-card-feature-enhanced">
                        <svg class="pricing-card-feature-icon-enhanced" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Email support
                    </li>
                </ul>
                
                <button class="btn-outline w-full text-lg py-4 font-bold tracking-wide">
                    Get Started Free
                </button>
                <p class="text-sm text-gray-500 text-center mt-4 font-medium">
                    No credit card required
                </p>
            </div>

            <div class="pricing-card-featured-enhanced hover-lift text-center">
                <div class="absolute -top-6 left-1/2 transform -translate-x-1/2">
                    <span class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-2 rounded-full text-sm font-bold tracking-wide shadow-lg">
                        Most Popular
                    </span>
                </div>
                
                <div class="mb-4 pt-4">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-full p-4 w-16 h-16 mx-auto mb-4 flex items-center justify-center shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="pricing-card-title-enhanced text-blue-600">Pro</h3>
                    <p class="pricing-card-description">Ideal for growing businesses that need advanced features</p>
                </div>
                
                <div class="pricing-card-price-enhanced">
                    <span class="pricing-card-price-amount-enhanced text-blue-600">$29</span>
                    <span class="text-gray-600 text-lg font-medium">/month</span>
                </div>
                
                <ul class="pricing-card-features-enhanced">
                    <li class="pricing-card-feature-enhanced">
                        <svg class="pricing-card-feature-icon-enhanced" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Advanced deal pipeline
                    </li>
                    <li class="pricing-card-feature-enhanced">
                        <svg class="pricing-card-feature-icon-enhanced" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Interaction tracking & history
                    </li>
                    <li class="pricing-card-feature-enhanced">
                        <svg class="pricing-card-feature-icon-enhanced" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Advanced reporting & analytics
                    </li>
                    <li class="pricing-card-feature-enhanced">
                        <svg class="pricing-card-feature-icon-enhanced" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Email integration & templates
                    </li>
                    <li class="pricing-card-feature-enhanced">
                        <svg class="pricing-card-feature-icon-enhanced" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Priority support
                    </li>
                </ul>
                
                <button class="btn-primary w-full text-lg py-4 font-bold tracking-wide shadow-lg hover:shadow-xl transition-all duration-300">
                    Start Free Trial
                </button>
                <p class="text-sm text-blue-600 text-center mt-4 font-medium">
                    14-day free trial • Cancel anytime
                </p>
            </div>

            <div class="pricing-card-enhanced hover-lift text-center">
                <div class="mb-4">
                    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-full p-4 w-16 h-16 mx-auto mb-4 flex items-center justify-center shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="pricing-card-title-enhanced text-purple-600">Enterprise</h3>
                    <p class="pricing-card-description">Complete solution for large organizations and teams</p>
                </div>
                
                <div class="pricing-card-price-enhanced">
                    <span class="pricing-card-price-amount-enhanced text-purple-600">$99</span>
                    <span class="text-gray-600 text-lg font-medium">/month</span>
                    <p class="text-sm text-purple-600 font-semibold mt-1">Custom pricing available</p>
                </div>
                
                <ul class="pricing-card-features-enhanced">
                    <li class="pricing-card-feature-enhanced">
                        <svg class="pricing-card-feature-icon-enhanced" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Everything in Pro
                    </li>
                    <li class="pricing-card-feature-enhanced">
                        <svg class="pricing-card-feature-icon-enhanced" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Unlimited team members
                    </li>
                    <li class="pricing-card-feature-enhanced">
                        <svg class="pricing-card-feature-icon-enhanced" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Advanced team collaboration
                    </li>
                    <li class="pricing-card-feature-enhanced">
                        <svg class="pricing-card-feature-icon-enhanced" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Custom integrations & API
                    </li>
                    <li class="pricing-card-feature-enhanced">
                        <svg class="pricing-card-feature-icon-enhanced" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Advanced security & compliance
                    </li>
                </ul>
                
                <button class="btn-secondary w-full text-lg py-4 font-bold tracking-wide">
                    Contact Sales
                </button>
                <p class="text-sm text-gray-500 text-center mt-4 font-medium">
                    Schedule a personalized demo
                </p>
            </div>
        </div>

        <div class="mt-20 text-center">
            <div class="bg-white rounded-2xl shadow-xl p-10 max-w-4xl mx-auto">
                <h3 class="text-3xl font-bold text-gray-900 mb-6">Not sure which plan is right for you?</h3>
                <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                    Our team is here to help you choose the perfect plan based on your business needs and growth goals.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/contact" class="bg-blue-600 text-white hover:bg-blue-700 px-8 py-4 rounded-lg font-bold text-lg transition-all duration-300 shadow-lg hover:shadow-xl">
                        Talk to Sales
                    </a>
                    <a href="#" class="border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white px-8 py-4 rounded-lg font-bold text-lg transition-all duration-300">
                        Try Demo
                    </a>
                </div>
                <p class="text-sm text-gray-500 mt-6">
                    Average response time: 2 hours • No commitment required
                </p>
            </div>
        </div>
    </div>
</section>
@endsection