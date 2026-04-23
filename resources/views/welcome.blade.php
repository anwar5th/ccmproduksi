<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FCS - Sistem Manajemen</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-slate-900 bg-slate-50 min-h-screen flex flex-col">
    <!-- Main Content / Hero -->
    <main class="flex-grow flex items-center justify-center relative overflow-hidden">
        <!-- Background Pattern -->
        <x-application-ccm class="block h-10 w-auto fill-current text-slate-800" />
        <div class="absolute inset-0 bg-[url('https://laravel.com/assets/img/welcome/background.svg')] bg-center bg-no-repeat opacity-5"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 tracking-tight mb-6">
                Manajemen Produksi <span class="text-emerald-600">Pabrik Kayu</span>
            </h1>
            <p class="mt-4 max-w-2xl text-lg md:text-xl text-slate-600 mx-auto mb-10 leading-relaxed">
                Sistem terintegrasi untuk mengelola Surat Perintah Kerja (SPK), memantau antrian mesin, dan memastikan proses produksi berjalan efisien.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @auth
                    <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center px-8 py-3.5 border border-transparent rounded-lg shadow-sm text-base font-bold text-white bg-emerald-600 hover:bg-emerald-700 transition-colors">
                        Buka Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-3.5 border border-transparent rounded-lg shadow-sm text-base font-bold text-white bg-emerald-600 hover:bg-emerald-700 transition-colors">
                        Masuk Sistem
                    </a>
                @endauth
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="text-sm text-slate-500">
                &copy; {{ date('Y') }} FCS App. All rights reserved.
            </div>
            <!-- <div class="text-sm text-slate-500 font-medium">
                Devisi IT Syaiful Anwar
            </div> -->
        </div>
    </footer>

</body>
</html>
