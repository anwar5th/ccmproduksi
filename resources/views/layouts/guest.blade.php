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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased bg-slate-50">
        <div class="min-h-screen flex flex-col md:flex-row">
            
            <!-- Left Side - Form -->
            <div class="flex-1 flex flex-col justify-center items-center px-4 sm:px-6 lg:px-8 py-12 md:py-0">
                <div class="w-full max-w-md bg-white rounded-xl shadow-lg border border-slate-200 p-8">
                    <!-- Logo Optional -->
                    <div class="flex justify-center mb-8">
                        <a href="/" class="flex flex-col items-center">
                            <x-application-ccm class="block h-12 w-auto fill-current text-slate-800" />
                            <span class="mt-2 text-xl font-bold tracking-tight text-slate-900">FCS</span>
                        </a>
                    </div>
                    
                    {{ $slot }}
                </div>
                
                <div class="mt-8 text-sm text-slate-500">
                    &copy; {{ date('Y') }} FCS App. All rights reserved.
                </div>
            </div>

            <!-- Right Side - Image -->
            <div class="hidden md:flex md:flex-1 relative bg-slate-900">
                <!-- Using an overlay to make it look premium -->
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-slate-900/20 z-10"></div>
                <!-- Assuming img/background.png exists -->
                <img src="{{ asset('img/background.png') }}" alt="Factory Background" class="absolute inset-0 w-full h-full object-cover opacity-80" onerror="this.src='https://images.unsplash.com/photo-1565626423450-48135ab22da0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80'">
                
                <div class="absolute bottom-12 left-12 z-20 max-w-lg">
                    <h2 class="text-3xl font-bold text-white mb-4">Industrial Grade Production Management</h2>
                    <p class="text-slate-300 text-lg">Sistem terintegrasi untuk manajemen antrian mesin dan Surat Perintah Kerja yang reliabel.</p>
                </div>
            </div>

        </div>
    </body>
</html>
