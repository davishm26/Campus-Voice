<x-campus-layout>
    <x-slot name="title">Laporan Saya - CampusVoice</x-slot>
    <x-slot name="headerTitle">Laporan Saya</x-slot>
    <x-slot name="headerSubtitle">Pantau status dan tindak lanjut laporan yang telah Anda kirimkan.</x-slot>

    <div class="bg-white rounded-[28px] p-6 sm:p-10 shadow-2xl max-w-7xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-gray-100 pb-5 mb-6">
            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-gray-900 tracking-tight">Daftar Laporan Anda</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Semua laporan dan aspirasi yang telah Anda submit ke pihak kampus.
                </p>
            </div>
            <a href="{{ route('reports.create') }}" 
               class="px-5 py-2.5 rounded-xl bg-[#C5222A] hover:bg-[#A81B22] text-white text-sm font-semibold transition shadow-sm flex items-center gap-2 self-start sm:self-auto">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Buat Laporan Baru
            </a>
        </div>

        @if ($reports->isEmpty())
            <div class="text-center py-16">
                <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-red-50 text-[#C5222A] flex items-center justify-center">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="text-base font-bold text-gray-800">Belum ada laporan</h3>
                <p class="text-sm text-gray-500 mt-1 max-w-sm mx-auto">
                    Anda belum pernah mengirimkan laporan pengaduan atau aspirasi.
                </p>
                <div class="mt-5">
                    <a href="{{ route('reports.create') }}" 
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-[#C5222A] text-white text-sm font-medium hover:bg-[#A81B22] transition">
                        Buat Laporan Pertama
                    </a>
                </div>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                            <th class="py-3 px-4">Judul & Kategori</th>
                            <th class="py-3 px-4">Lokasi</th>
                            <th class="py-3 px-4">Tanggal</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @foreach ($reports as $report)
                            <tr class="hover:bg-gray-50/70 transition">
                                <td class="py-4 px-4">
                                    <div class="font-semibold text-gray-900 leading-tight">
                                        {{ $report->title }}
                                    </div>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="inline-block text-xs text-red-600 font-medium">
                                            {{ $report->category }}
                                        </span>
                                        @if ($report->is_anonymous)
                                            <span class="inline-block text-[10px] bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full font-medium">
                                                Anonim
                                            </span>
                                        @endif
                                        @if ($report->attachment_path)
                                            <span class="inline-flex items-center gap-1 text-[10px] text-gray-500">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                                </svg>
                                                Lampiran
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-gray-600 text-xs">
                                    {{ $report->location ?: '-' }}
                                </td>
                                <td class="py-4 px-4 text-gray-500 text-xs whitespace-nowrap">
                                    {{ $report->created_at->format('d M Y, H:i') }}
                                </td>
                                <td class="py-4 px-4 whitespace-nowrap">
                                    @php
                                        $badgeClasses = match($report->status) {
                                            'pending' => 'bg-amber-50 text-amber-700 border-amber-200',
                                            'in_progress' => 'bg-blue-50 text-blue-700 border-blue-200',
                                            'resolved' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                            'rejected' => 'bg-rose-50 text-rose-700 border-rose-200',
                                            default => 'bg-gray-50 text-gray-700 border-gray-200',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium border {{ $badgeClasses }}">
                                        {{ $report->status_label }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 text-right whitespace-nowrap">
                                    <a href="{{ route('reports.show', $report) }}" 
                                       class="text-xs font-semibold text-[#C5222A] hover:text-[#8E171B] underline">
                                        Lihat Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $reports->links() }}
            </div>
        @endif
    </div>
</x-campus-layout>
