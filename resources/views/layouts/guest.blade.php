<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PT CCM') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-row bg-gray-100 grid grid-cols-2">
        <!-- <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100"> -->
        <!-- <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
        </div> -->
        <div class="basis-2/5">
            <div class="w-full sm:max-w-md mt-40 ml-8 px-6 py-6 bg-white shadow-md overflow-hidden sm:rounded-lg">
               
                {{ $slot }}
                
            </div>
        </div>
        <!-- Membuat flex -->
        <div class="basis-3/5">
            <img src="{{ asset('img/background.png') }}" width="700px" class="object-center" >
        </div>
        </div>
    </body>
</html>
