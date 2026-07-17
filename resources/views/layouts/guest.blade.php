<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PT CCM') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="{{ asset('img/fcslogo.png') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .guest-logo {
                max-height: 52px;
                width: auto;
                object-fit: contain;
                display: block;
            }
        </style>
    </head>
    <body class="font-sans text-slate-900 antialiased bg-slate-50">
        <div class="min-h-screen flex flex-col md:flex-row">
            
            <!-- Left Side - Form -->
            <div class="flex-1 flex flex-col justify-center items-center px-4 sm:px-6 lg:px-8 py-12 md:py-0 md:max-w-lg lg:max-w-xl xl:max-w-2xl">
                <div class="w-full max-w-md bg-white rounded-xl shadow-lg border border-slate-200 p-8">
                    <!-- Logo -->
                    <div class="flex justify-center mb-8">
                        <a href="/" class="flex flex-col items-center gap-2">
                            <img src="{{ asset('img/bg-fcs.png') }}" class="guest-logo" alt="Logo FCS">
                            <span class="text-sm font-semibold tracking-widest text-slate-500 uppercase">Woodtrack</span>
                        </a>
                    </div>
                    
                    {{ $slot }}
                </div>
                
                <div class="mt-8 text-sm text-slate-500">
                    &copy; {{ date('Y') }} FCS App. All rights reserved.
                </div>
            </div>

            <!-- Right Side - Image (hidden on small screens) -->
            <div class="hidden md:block flex-1 relative overflow-hidden bg-slate-900">
                <!-- Gradient overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/30 to-slate-900/10 z-10"></div>
                <!-- Background image -->
                <img 
                    src="{{ asset('img/background.png') }}" 
                    alt="Factory Background" 
                    class="absolute inset-0 w-full h-full object-cover"
                    onerror="this.src='https://images.unsplash.com/photo-1565626423450-48135ab22da0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80'"
                >
                
                <div class="absolute bottom-12 left-12 z-20 max-w-sm">
                    <h2 class="text-2xl font-bold text-white mb-3">Industrial Grade Production Management</h2>
                    <p class="text-slate-300 text-sm leading-relaxed">Sistem terintegrasi untuk manajemen antrian mesin dan Surat Perintah Kerja yang reliabel.</p>
                </div>
            </div>

        </div>
    </body>
</html>
