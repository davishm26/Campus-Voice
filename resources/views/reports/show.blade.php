<x-campus-layout>
    <x-slot name="title">{{ $report->title }} - CampusVoice</x-slot>
    <x-slot name="headerTitle">Detail Laporan</x-slot>
    <x-slot name="headerSubtitle">Informasi lengkap terkait laporan pengaduan/aspirasi.</x-slot>

    <div class="bg-white rounded-[28px] p-6 sm:p-10 shadow-2xl max-w-5xl mx-auto space-y-6">
        <div class="flex items-center justify-between border-b border-gray-100 pb-5">
            <a href="{{ route('reports.index') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-gray-500 hover:text-gray-900 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Laporan Saya
            </a>

            @php
                $badgeClasses = match($report->status) {
                    'pending' => 'bg-amber-50 text-amber-700 border-amber-200',
                    'in_progress' => 'bg-blue-50 text-blue-700 border-blue-200',
                    'resolved' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                    'rejected' => 'bg-rose-50 text-rose-700 border-rose-200',
                    default => 'bg-gray-50 text-gray-700 border-gray-200',
                };
            @endphp
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border {{ $badgeClasses }}">
                {{ $report->status_label }}
            </span>
        </div>

        <div>
            <div class="inline-block text-xs font-bold uppercase tracking-wider text-[#C5222A] bg-red-50 px-3 py-1 rounded-lg mb-2">
                {{ $report->category }}
            </div>
            <h1 class="text-2xl font-bold text-gray-900">{{ $report->title }}</h1>
            <div class="flex items-center gap-4 text-xs text-gray-400 mt-2">
                <span>Dikirim: {{ $report->created_at->format('d M Y, H:i') }}</span>
                <span>•</span>
                <span>Pelapor: {{ $report->reporter_name }}</span>
                @if ($report->location)
                    <span>•</span>
                    <span>Lokasi: {{ $report->location }}</span>
                @endif
            </div>
        </div>

        <div class="border-t border-b border-gray-100 py-6">
            <h3 class="text-sm font-bold text-gray-800 mb-2">Deskripsi</h3>
            <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-line">{{ $report->description }}</p>
        </div>

        @if ($report->attachment_path)
            <div class="pt-2">
                <h3 class="text-sm font-bold text-gray-800 mb-3">Bukti Pendukung</h3>
                @php
                    $isImage = in_array(strtolower(pathinfo($report->attachment_path, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp']);
                @endphp

                @if ($isImage)
                    <div class="rounded-2xl overflow-hidden border border-gray-200 max-w-lg shadow-sm">
                        <img src="{{ asset('storage/' . $report->attachment_path) }}" alt="Bukti Pendukung" class="w-full h-auto object-cover max-h-96">
                    </div>
                @endif

                <div class="mt-3">
                    <a href="{{ asset('storage/' . $report->attachment_path) }}" target="_blank" download
                       class="inline-flex items-center gap-2 text-xs font-semibold px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-800 transition">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Unduh Berkas ({{ $report->attachment_original_name ?: 'Dokumen' }})
                    </a>
                </div>
            </div>
        @endif

        @if ($report->admin_response)
            <div class="mt-6 p-5 rounded-2xl bg-blue-50/70 border border-blue-200">
                <div class="flex items-center gap-2 text-blue-900 font-bold text-sm mb-1">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                    </svg>
                    Tanggapan Pihak Kampus
                </div>
                <p class="text-xs text-blue-800 whitespace-pre-line mt-2">
                    {{ $report->admin_response }}
                </p>
            </div>
        @endif
    </div>
</x-campus-layout>
