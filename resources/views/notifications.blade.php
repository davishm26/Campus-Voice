<x-campus-layout>
    <x-slot name="title">Notifikasi - CampusVoice</x-slot>
    <x-slot name="headerTitle">Notifikasi</x-slot>
    <x-slot name="headerSubtitle">Pemberitahuan terkini mengenai status laporan dan informasi kampus.</x-slot>

    <div class="bg-white rounded-[28px] p-6 sm:p-10 shadow-2xl max-w-5xl mx-auto">
        <div class="border-b border-gray-100 pb-5 mb-6">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 tracking-tight">Kotak Notifikasi</h2>
            <p class="text-sm text-gray-500 mt-1">
                Semua notifikasi terkait perkembangan laporan Anda.
            </p>
        </div>

        <div class="text-center py-16">
            <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gray-50 text-gray-400 flex items-center justify-center">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
            </div>
            <h3 class="text-base font-bold text-gray-800">Tidak ada notifikasi baru</h3>
            <p class="text-sm text-gray-500 mt-1 max-w-sm mx-auto">
                Anda akan menerima notifikasi setiap ada tanggapan atau update status dari pihak kampus.
            </p>
        </div>
    </div>
</x-campus-layout>
