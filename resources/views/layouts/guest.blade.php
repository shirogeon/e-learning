<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Ruang Belajar') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400..700&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="studio-shell flex min-h-screen items-center justify-center px-4 py-10 dark:bg-slate-950">
            <div class="w-full max-w-md">
                <a href="{{ route('home') }}" class="mb-6 flex items-center justify-center gap-2 text-[#104841] dark:text-emerald-300">
                    <span class="h-2.5 w-2.5 rounded-sm bg-[#b77928]"></span>
                    <span class="font-serif-display text-2xl">Ruang Belajar</span>
                </a>
                <div class="studio-card p-6 sm:p-8 dark:border-slate-700 dark:bg-slate-900">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
