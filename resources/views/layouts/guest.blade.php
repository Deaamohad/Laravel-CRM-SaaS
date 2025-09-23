<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/Logo.svg') }}" type="image/svg+xml">


    <title>@yield('title', 'Cliento')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">
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