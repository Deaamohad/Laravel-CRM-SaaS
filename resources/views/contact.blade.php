@extends('layouts.guest')

@section('title', 'Contact Us - CRM SaaS')

@section('content')
<section class="relative bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-20 text-white">
    <div class="max-w-6xl mx-auto px-4">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="contact-mega-title text-white mb-8 leading-tight">
                    Get in<br>
                    <span class="text-transparent bg-gradient-to-r from-blue-400 to-cyan-400 bg-clip-text">Touch</span>
                </h1>
                <p class="text-2xl text-gray-300 mb-8 max-w-lg font-light leading-relaxed">
                    Have questions about our CRM solution? We're here to help you succeed and grow your business.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#contact-form" class="btn-primary text-lg px-8 py-4 font-semibold tracking-wide">
                        <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Send Message
                    </a>
                    <a href="tel:+962790000000" class="btn-outline text-lg px-8 py-4 border-gray-400 text-gray-300 hover:bg-gray-800 font-semibold tracking-wide">
                        <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        Call Us Now
                    </a>
                </div>
            </div>
            
            <div class="relative">
                <div class="bg-gradient-to-br from-blue-500 to-blue-700 rounded-3xl p-12 relative overflow-hidden">
                    <div class="absolute inset-0 opacity-20">
                        <div class="absolute top-4 left-4 w-16 h-16 bg-white rounded-full"></div>
                        <div class="absolute top-20 right-8 w-8 h-8 bg-white rounded-full"></div>
                        <div class="absolute bottom-12 left-8 w-12 h-12 bg-white rounded-full"></div>
                        <div class="absolute bottom-4 right-4 w-6 h-6 bg-white rounded-full"></div>
                    </div>
                    
                    <div class="relative z-10 text-center">
                        <div class="bg-white rounded-full w-32 h-32 mx-auto mb-6 flex items-center justify-center">
                            <svg class="w-16 h-16 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        </div>
                        
                        <div class="bg-white rounded-full w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                            </svg>
                        </div>
                        
                        <div class="text-white">
                            <h3 class="text-2xl font-semibold mb-2">24/7 Support</h3>
                            <p class="text-blue-100">Ready to help you succeed</p>
                        </div>
                        
                        <div class="absolute -top-4 -left-4">
                            <div class="bg-white rounded-lg p-3 shadow-lg">
                                <div class="flex items-center space-x-2">
                                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="absolute -bottom-4 -right-4">
                            <div class="bg-blue-600 text-white rounded-lg p-3 shadow-lg">
                                <p class="text-sm">How can we help?</p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="contact-section-title text-5xl mb-8">Let's Start a Conversation</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto font-light leading-relaxed">
                Whether you need a demo, have questions about pricing, or want to discuss how our CRM can transform your business, we're here to help you succeed.
            </p>
        </div>

        <div class="grid lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2">
                <div id="contact-form" class="bg-white rounded-2xl shadow-xl p-12 border border-gray-100">
                    <div class="flex items-center mb-10">
                        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-4 mr-6 shadow-lg">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="contact-form-title text-3xl mb-2">Send us a Message</h3>
                            <p class="contact-form-subtitle text-lg">We'll get back to you within 2 hours during business days</p>
                        </div>
                    </div>

                    <form class="space-y-8">
                        <div>
                            <h4 class="contact-section-header">Personal Information</h4>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="form-label-enhanced">First Name *</label>
                                    <input type="text" class="form-input-enhanced" placeholder="Ahmad" required>
                                </div>
                                <div>
                                    <label class="form-label-enhanced">Last Name *</label>
                                    <input type="text" class="form-input-enhanced" placeholder="Al-Mahmoud" required>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="contact-section-header">Contact Details</h4>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="form-label-enhanced">Email Address *</label>
                                    <input type="email" class="form-input-enhanced" placeholder="ahmad@company.jo" required>
                                </div>
                                <div>
                                    <label class="form-label-enhanced">Phone Number</label>
                                    <input type="tel" class="form-input-enhanced" placeholder="+962 7 9999 9999">
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="contact-section-header">Business Information</h4>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="form-label-enhanced">Company Name</label>
                                    <input type="text" class="form-input-enhanced" placeholder="Jordan Tech Solutions">
                                </div>
                                <div>
                                    <label class="form-label-enhanced">Industry</label>
                                    <select class="form-input-enhanced">
                                        <option value="">Select your industry</option>
                                        <option value="technology">Technology</option>
                                        <option value="retail">Retail</option>
                                        <option value="manufacturing">Manufacturing</option>
                                        <option value="healthcare">Healthcare</option>
                                        <option value="finance">Finance</option>
                                        <option value="education">Education</option>
                                        <option value="real-estate">Real Estate</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="contact-section-header">How Can We Help?</h4>
                            <div class="mb-6">
                                <label class="form-label-enhanced">Subject *</label>
                                <select class="form-input-enhanced" required>
                                    <option value="">Choose your inquiry type</option>
                                    <option value="demo">Request a Demo</option>
                                    <option value="sales">Sales Inquiry</option>
                                    <option value="pricing">Pricing Information</option>
                                    <option value="support">Technical Support</option>
                                    <option value="partnership">Partnership Opportunity</option>
                                    <option value="integration">Integration Questions</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div>
                                <label class="form-label-enhanced">Message *</label>
                                <textarea class="form-input-enhanced" rows="6" placeholder="Tell us about your business needs, current challenges, or any specific questions you have about our CRM solution..." required></textarea>
                            </div>
                        </div>

                        <div class="pt-6">
                            <button type="submit" class="btn-primary w-full text-lg py-4 font-bold tracking-wide shadow-lg hover:shadow-xl transition-all duration-300">
                                <svg class="w-6 h-6 mr-3 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Send Message
                            </button>
                            <p class="text-sm text-gray-500 text-center mt-4 font-medium">
                                🔒 We respect your privacy. Your information will never be shared with third parties.
                            </p>
                        </div>
                    </form>
                </div>
            </div>

            <div class="space-y-8">
                <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                    <div class="flex items-center mb-6">
                        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-4 mr-4 shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h3 class="contact-info-title text-2xl">Visit Our Office</h3>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <h4 class="font-bold text-gray-900 text-lg mb-2">Main Office</h4>
                            <p class="contact-info-subtitle text-lg leading-relaxed">
                                King Abdullah II Street<br>
                                Business District, Building 25<br>
                                3rd Floor, Suite 301<br>
                                <span class="font-semibold text-gray-800">Amman 11183, Jordan</span>
                            </p>
                        </div>
                        <div class="pt-4 border-t border-gray-200">
                            <p class="text-sm text-gray-600 font-medium">
                                <strong class="text-gray-800">Office Hours:</strong><br>
                                Sunday - Thursday: 9:00 AM - 6:00 PM<br>
                                Friday - Saturday: Closed
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                    <div class="flex items-center mb-6">
                        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-4 mr-4 shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <h3 class="contact-info-title text-2xl">Direct Contact</h3>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <h4 class="font-bold text-gray-900 mb-3 text-lg">Phone Numbers</h4>
                            <div class="space-y-3">
                                <p class="text-gray-700 text-lg">
                                    <strong class="text-gray-900">Main:</strong> <a href="tel:+96260000000" class="contact-highlight-text text-xl font-bold">+962 6 000 0000</a>
                                </p>
                                <p class="text-gray-700 text-lg">
                                    <strong class="text-gray-900">Mobile:</strong> <a href="tel:+962790000000" class="contact-highlight-text text-xl font-bold">+962 00 000 0000</a>
                                </p>
                                <p class="text-sm text-gray-600 font-medium">📞 Available 24/7 for urgent support</p>
                            </div>
                        </div>
                        
                        <div class="border-t border-gray-200 pt-6">
                            <h4 class="font-bold text-gray-900 mb-3 text-lg">Email Addresses</h4>
                            <div class="space-y-3">
                                <p class="text-gray-700 text-lg">
                                    <strong class="text-gray-900">General:</strong> <a href="mailto:info@crmapp.jo" class="contact-highlight-text text-xl font-bold">info@crmapp.jo</a>
                                </p>
                                <p class="text-gray-700 text-lg">
                                    <strong class="text-gray-900">Sales:</strong> <a href="mailto:sales@crmapp.jo" class="contact-highlight-text text-xl font-bold">sales@crmapp.jo</a>
                                </p>
                                <p class="text-gray-700 text-lg">
                                    <strong class="text-gray-900">Support:</strong> <a href="mailto:support@crmapp.jo" class="contact-highlight-text text-xl font-bold">support@crmapp.jo</a>
                                </p>
                                <p class="text-sm text-gray-600 font-medium">⚡ Response within 2 hours during business days</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl shadow-lg p-8 text-white">
                    <div class="text-center">
                        <div class="bg-white bg-opacity-20 rounded-full p-4 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-4">Need Immediate Help?</h3>
                        <p class="text-blue-100 mb-6">
                            Join thousands of businesses in Jordan and the Middle East already using our CRM
                        </p>
                        <div class="space-y-3">
                            <a href="tel:+96270000000" class="btn-outline border-white text-white hover:bg-white hover:text-blue-700 w-full block text-center">
                                Call Now
                            </a>
                            <a href="#" class="bg-white text-blue-700 hover:bg-gray-100 px-6 py-3 rounded-lg font-medium w-full block text-center transition-colors">
                                Start Free Trial
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-16 grid md:grid-cols-3 gap-8">
            <div class="text-center p-6">
                <div class="bg-purple-100 rounded-full p-4 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h4 class="text-lg font-semibold text-gray-900 mb-2">Quick Response</h4>
                <p class="text-gray-600">Average response time of 2 hours during business days</p>
            </div>
            
            <div class="text-center p-6">
                <div class="bg-green-100 rounded-full p-4 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h4 class="text-lg font-semibold text-gray-900 mb-2">Local Expertise</h4>
                <p class="text-gray-600">Based in Jordan with deep understanding of Middle East business</p>
            </div>
            
            <div class="text-center p-6">
                <div class="bg-orange-100 rounded-full p-4 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                    <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h4 class="text-lg font-semibold text-gray-900 mb-2">Dedicated Support</h4>
                <p class="text-gray-600">Personal account manager for Enterprise customers</p>
            </div>
        </div>
    </div>
</section>
@endsection