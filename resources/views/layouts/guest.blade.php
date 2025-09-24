<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Cliento')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- CDN Fallbacks for production and local testing -->
    @if(app()->environment('production') || true)
        <!-- Tailwind CSS CDN -->
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <!-- Alpine.js CDN -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
        <!-- Force light mode even with CDN Tailwind -->
        <style>
            * { color-scheme: light !important; }
            @media (prefers-color-scheme: dark) {
                * { color-scheme: light !important; }
            }
            
            /* Fix giant check icons in pricing cards */
            .pricing-card-feature-icon-enhanced {
                width: 1.25rem !important;
                height: 1.25rem !important;
                max-width: 1.25rem !important;
                max-height: 1.25rem !important;
            }
            
            .pricing-card-feature-enhanced svg {
                width: 1.25rem !important;
                height: 1.25rem !important;
                max-width: 1.25rem !important;
                max-height: 1.25rem !important;
            }
            
            /* Enhanced gradient text with vendor prefixes */
            .gradient-text-blue-purple {
                background: linear-gradient(to right, #2563eb, #9333ea);
                -webkit-background-clip: text;
                background-clip: text;
                -webkit-text-fill-color: transparent;
                color: transparent;
                display: inline-block;
            }
            
            .gradient-text-blue-cyan {
                background: linear-gradient(to right, #3b82f6, #06b6d4);
                -webkit-background-clip: text;
                background-clip: text;
                -webkit-text-fill-color: transparent;
                color: transparent;
                display: inline-block;
            }
            
            .gradient-text-cyan-blue-purple {
                background: linear-gradient(to right, #67e8f9, #dbeafe, #c084fc);
                -webkit-background-clip: text;
                background-clip: text;
                -webkit-text-fill-color: transparent;
                color: transparent;
                display: inline-block;
            }
            
            /* Mobile pricing cards - stack vertically on small screens */
            @media (max-width: 768px) {
                .grid.lg\\:grid-cols-3 {
                    display: flex !important;
                    flex-direction: column !important;
                    gap: 1rem !important;
                }
                
                .pricing-card-enhanced {
                    width: 100% !important;
                    margin: 0 !important;
                    transform: none !important;
                    border: 1px solid #e5e7eb !important;
                    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1) !important;
                }
                
                .pricing-card-featured-enhanced {
                    transform: none !important;
                    scale: 1 !important;
                    border: 2px solid #3b82f6 !important;
                }
                
                /* Ensure cards have proper styling */
                .pricing-card-enhanced,
                .pricing-card-featured-enhanced {
                    background: white !important;
                    border-radius: 0.5rem !important;
                    padding: 2rem !important;
                }
            }
        </style>
    @endif
</head>
<body class="bg-gray-50 min-h-screen flex flex-col" style="color-scheme: light;">
    @include('components.guest-header')
    
    <main class="flex-1">
        @if(session('success'))
            <div class="container mx-auto px-4 pt-6">
                <x-flash-message type="success" message="{{ session('success') }}" />
            </div>
        @endif
        
        @if(session('error'))
            <div class="container mx-auto px-4 pt-6">
                <x-flash-message type="error" message="{{ session('error') }}" />
            </div>
        @endif
        
        @if(session('status'))
            <div class="container mx-auto px-4 pt-6">
                <x-flash-message type="success" message="{{ session('status') }}" />
            </div>
        @endif
        
        @yield('content')
    </main>
    
    @include('components.footer')
</body>
</html>