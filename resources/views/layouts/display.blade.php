<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-screen overflow-hidden">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SIAP Panakkukang') }} - Layar Monitor Antrean</title>

        <!-- Google Fonts: Plus Jakarta Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=JetBrains+Mono:wght@700;800&display=swap" rel="stylesheet">

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            html, body { overflow: hidden !important; overscroll-behavior: none; scrollbar-width: none; -ms-overflow-style: none; }
            html::-webkit-scrollbar, body::-webkit-scrollbar { display: none; }
            /* Lock to viewport — 100dvh fallback for monitors */
            html, body { height: 100vh; height: 100dvh; max-height: 100dvh; }
            @supports (height: 100dvh) {
                html, body { height: 100dvh; }
            }
        </style>
    </head>
    <body class="font-sans antialiased text-slate-800 bg-slate-100 h-screen overflow-hidden flex flex-col" style="height:100vh; height:100dvh; max-height:100dvh;">
        {{ $slot }}
    </body>
</html>
