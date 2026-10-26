<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CampusVoice') }} — {{ isset($title) ? strip_tags($title) : 'Dashboard' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-slate-800" style="font-family: 'Inter', Arial, sans-serif;">
        <div x-data="{ sidebarOpen: false }" class="min-h-screen bg-gradient-to-b from-[#ad151c] via-[#913035] to-[#55565b] lg:pl-64">
            @include('layouts.navigation')

            <div class="flex min-h-screen flex-col gap-8 px-4 py-5 sm:px-8 lg:px-16 lg:py-5">
                <!-- Page Heading -->
                <header class="flex items-center justify-between gap-4 rounded-lg bg-white px-4 py-3 shadow-sm sm:px-3">
                    <div class="flex items-center gap-3">
                        <button type="button"
                                class="inline-flex h-9 w-9 items-center justify-center rounded-md text-slate-500 hover:bg-red-50 hover:text-red-700 lg:hidden"
                                @click="sidebarOpen = true"
                                aria-label="Buka menu">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>

                        <div>
                            <h1 class="text-base font-semibold text-slate-900">{{ $title ?? 'Dashboard' }}</h1>
                            @isset($subtitle)
                                <p class="text-xs text-slate-500">{{ $subtitle }}</p>
                            @endisset
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="hidden text-right sm:block">
                            <p class="text-sm font-semibold text-slate-900">{{ Auth::user()->name }}</p>
                            <p class="text-[11px] font-medium text-slate-600">Mahasiswa</p>
                        </div>
                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-red-100 text-sm font-bold text-red-700">
                            {{ Auth::user()->initials() }}
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="flex-1">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
