<x-campus-layout>
    <x-slot name="title">Dashboard - CampusVoice</x-slot>
    <x-slot name="headerTitle">Dashboard Mahasiswa</x-slot>
    <x-slot name="headerSubtitle">Ringkasan aktivitas aspirasi dan pengaduan kampus.</x-slot>

    <div class="space-y-6 max-w-7xl mx-auto">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <div class="bg-white rounded-2xl p-5 shadow-lg border border-red-50 flex items-center justify-between">
                <div>
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Laporan</div>
                    <div class="text-2xl font-extrabold text-gray-900 mt-1">
                        {{ Auth::user()?->reports()->count() ?? 0 }}
                    </div>
                </div>
                <div class="w-12 h-12 rounded-xl bg-red-50 text-[#C5222A] flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 shadow-lg border border-amber-50 flex items-center justify-between">
                <div>
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Menunggu</div>
                    <div class="text-2xl font-extrabold text-amber-600 mt-1">
                        {{ Auth::user()?->reports()->where('status', 'pending')->count() ?? 0 }}
                    </div>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 shadow-lg border border-blue-50 flex items-center justify-between">
                <div>
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Diproses</div>
                    <div class="text-2xl font-extrabold text-blue-600 mt-1">
                        {{ Auth::user()?->reports()->where('status', 'in_progress')->count() ?? 0 }}
                    </div>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5 shadow-lg border border-emerald-50 flex items-center justify-between">
                <div>
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Selesai</div>
                    <div class="text-2xl font-extrabold text-emerald-600 mt-1">
                        {{ Auth::user()?->reports()->where('status', 'resolved')->count() ?? 0 }}
                    </div>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Call to Action Banner -->
        <div class="bg-white rounded-[28px] p-8 shadow-xl flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="max-w-xl">
                <h3 class="text-xl font-bold text-gray-900">Punya aspirasi atau keluhan kampus?</h3>
                <p class="text-sm text-gray-500 mt-1">
                    Sampaikan suara Anda secara mudah, cepat, dan terpercaya. Pihak kampus siap mendengarkan demi kemajuan bersama.
                </p>
            </div>
            <a href="{{ route('reports.create') }}" 
               class="px-6 py-3 rounded-xl bg-[#C5222A] hover:bg-[#A81B22] text-white text-sm font-semibold transition shadow-md whitespace-nowrap">
                Buat Pengaduan Sekarang
            </a>
        </div>
    </div>
</x-campus-layout>
