<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SIAP Panakkukang') }} - Sistem Antrian & Pelayanan</title>

        <!-- Google Fonts: Plus Jakarta Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50 text-slate-800 min-h-screen flex flex-col justify-between selection:bg-orange-500 selection:text-white">
        <div class="flex-1 flex flex-col">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white/80 backdrop-blur-sm border-b border-slate-200/80 shadow-xs">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1">
                {{ $slot }}
            </main>
        </div>

        <!-- Footer -->
        <footer class="w-full py-4 border-t border-slate-200 bg-white text-center text-xs text-slate-500 mt-auto">
            <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-2">
                <p>&copy; {{ date('Y') }} Kantor Kecamatan Panakkukang, Kota Makassar. SIAP System v2.0</p>
                <div class="flex items-center gap-3 text-slate-400 font-medium">
                    <a href="{{ route('public.display') }}" target="_blank" class="hover:text-orange-600 transition">Monitor Antrean</a>
                    <span>•</span>
                    <a href="{{ route('profile.edit') }}" class="hover:text-orange-600 transition">Pengaturan Akun</a>
                </div>
            </div>
        </footer>
    </body>
</html>
