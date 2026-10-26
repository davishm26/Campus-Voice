<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'CampusVoice - Suara Mahasiswa' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased h-full bg-[#8E171B] text-gray-800" x-data="{ mobileMenuOpen: false }">
        <div class="min-h-screen flex flex-col md:flex-row">
            <!-- Mobile Top Bar -->
            <div class="md:hidden bg-white border-b border-gray-200 px-4 py-3 flex items-center justify-between shadow-sm">
                <a href="{{ route('reports.create') }}" class="flex items-center gap-3">
                    <div class="w-9 h-9 text-[#B91C1C] flex items-center justify-center">
                        <svg class="w-8 h-8" viewBox="0 0 36 36" fill="currentColor">
                            <path d="M18 4C10.268 4 4 10.268 4 18c0 3.09 1 5.95 2.7 8.28L5 32l5.96-1.58C13.19 31.42 15.51 32 18 32c7.732 0 14-6.268 14-14S25.732 4 18 4zm0 24c-2.09 0-4.04-.54-5.74-1.48l-.41-.23-4.14 1.1 1.11-4.04-.25-.43C7.57 21.17 7 19.14 7 17c0-6.065 4.935-11 11-11s11 4.935 11 11-4.935 11-11 11z"/>
                            <path d="M12.5 14a1.5 1.5 0 000 3c1.5 0 2.5 1 2.5 2.5a1.5 1.5 0 103 0c0-3.03-2.47-5.5-5.5-5.5z"/>
                            <path d="M12.5 10a1.5 1.5 0 000 3c3.72 0 6.5 2.78 6.5 6.5a1.5 1.5 0 103 0c0-5.38-4.12-9.5-9.5-9.5z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="font-extrabold text-[#991B1B] text-lg leading-tight">CampusVoice</div>
                        <div class="text-[11px] text-gray-400 font-medium leading-none">Suara Mahasiswa</div>
                    </div>
                </a>

                <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-lg text-gray-600 hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" style="display:none;"/>
                    </svg>
                </button>
            </div>

            <!-- Left Sidebar -->
            <aside 
                :class="mobileMenuOpen ? 'block' : 'hidden md:flex'"
                class="w-full md:w-64 lg:w-72 bg-white flex-shrink-0 flex flex-col justify-between p-6 md:min-h-screen border-r border-gray-100 transition-all z-20">
                
                <div>
                    <!-- Logo Header -->
                    <a href="{{ route('reports.create') }}" class="flex items-center gap-3 mb-10 px-2 group">
                        <div class="w-10 h-10 text-[#C5222A] flex-shrink-0">
                            <!-- Custom Sound Wave / Megaphone Campus Logo -->
                            <svg viewBox="0 0 44 44" fill="none" class="w-10 h-10">
                                <circle cx="22" cy="22" r="20" fill="#FEE2E2" fill-opacity="0.5"/>
                                <path d="M14 17C14 15.3431 15.3431 14 17 14H18.5C19.8807 14 21 15.1193 21 16.5V27.5C21 28.8807 19.8807 30 18.5 30H17C15.3431 30 14 28.6569 14 27V17Z" fill="#C5222A"/>
                                <path d="M21 18L27.5 13.5C28.5 12.8 30 13.5 30 14.8V29.2C30 30.5 28.5 31.2 27.5 30.5L21 26V18Z" fill="#C5222A"/>
                                <path d="M32 18C33.2 19.2 34 20.8 34 22C34 23.2 33.2 24.8 32 26" stroke="#C5222A" stroke-width="2.5" stroke-linecap="round"/>
                                <path d="M35 15C37 17 38 19.5 38 22C38 24.5 37 27 35 29" stroke="#C5222A" stroke-width="2.5" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div>
                            <div class="font-bold text-[#A81B22] text-xl tracking-tight leading-tight">CampusVoice</div>
                            <div class="text-xs text-gray-500 font-medium">Suara Mahasiswa</div>
                        </div>
                    </a>

                    <!-- Navigation -->
                    <div>
                        <div class="text-[11px] font-bold tracking-wider text-gray-400 uppercase px-4 mb-3">
                            Menu Utama
                        </div>
                        <nav class="space-y-1">
                            <!-- Dashboard -->
                            <a href="{{ route('dashboard') }}" 
                               class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'bg-[#FEE2E2]/70 text-[#C5222A] font-semibold' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                Dashboard
                            </a>

                            <!-- Buat Laporan -->
                            <a href="{{ route('reports.create') }}" 
                               class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition {{ request()->routeIs('reports.create') ? 'bg-[#FEE2E2]/70 text-[#C5222A] font-semibold' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                Buat Laporan
                            </a>

                            <!-- Laporan Saya -->
                            <a href="{{ route('reports.index') }}" 
                               class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition {{ request()->routeIs('reports.index', 'reports.show') ? 'bg-[#FEE2E2]/70 text-[#C5222A] font-semibold' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                Laporan Saya
                            </a>

                            <!-- Notifikasi -->
                            <a href="{{ route('notifications.index') }}" 
                               class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition {{ request()->routeIs('notifications.index') ? 'bg-[#FEE2E2]/70 text-[#C5222A] font-semibold' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                Notifikasi
                            </a>

                            <!-- Profil -->
                            <a href="{{ route('profile.edit') }}" 
                               class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition {{ request()->routeIs('profile.edit') ? 'bg-[#FEE2E2]/70 text-[#C5222A] font-semibold' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                                Profil
                            </a>
                        </nav>
                    </div>
                </div>

                <!-- Bottom Logout Button -->
                <div class="pt-6">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="w-full py-2.5 px-4 rounded-xl border border-gray-300 text-gray-700 text-sm font-medium hover:bg-gray-50 hover:text-gray-900 transition flex items-center justify-center">
                            Keluar
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Content Area with Deep Crimson Background -->
            <main class="flex-1 bg-[#8E171B] min-h-screen p-5 sm:p-8 lg:p-10 flex flex-col">
                <!-- Top Header Bar -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-white tracking-tight">
                            {{ $headerTitle ?? 'Buat Pengaduan / Aspirasi' }}
                        </h1>
                        <p class="text-white/80 text-sm sm:text-base mt-1">
                            {{ $headerSubtitle ?? 'Sampaikan keluhan, masalah, atau aspirasi kepada pihak kampus.' }}
                        </p>
                    </div>

                    <!-- User Pill Badge -->
                    <div class="self-start sm:self-auto bg-white rounded-2xl px-4 py-2.5 shadow-md flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-[#8E171B] text-white font-bold flex items-center justify-center text-sm shadow-inner flex-shrink-0">
                            {{ Auth::user()?->initials ?? 'MV' }}
                        </div>
                        <div class="text-left pr-1">
                            <div class="font-bold text-gray-900 text-sm leading-tight">
                                {{ Auth::user()?->name ?? 'Max Verstappen' }}
                            </div>
                            <div class="text-xs text-gray-500 font-normal leading-tight mt-0.5">
                                Mahasiswa
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Area -->
                <div class="flex-1">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
