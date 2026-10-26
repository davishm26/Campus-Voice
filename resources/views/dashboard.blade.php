<x-app-layout>
    <x-slot name="title">Dashboard</x-slot>
    <x-slot name="subtitle">Selamat datang kembali di CampusVoice</x-slot>

    <div class="flex flex-col gap-7 pt-6">
        <!-- Call to action -->
        <section class="flex flex-col gap-4 rounded-lg bg-red-600 px-5 py-6 text-white shadow-sm sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-lg font-bold">Sampaikan Pengaduan atau Aspirasi</h2>
                <p class="mt-1 text-xs text-red-50">
                    Punya keluhan, masalah, atau aspirasi untuk kampus? Sampaikan melalui CampusVoice.
                </p>
            </div>
            <a href="#"
               class="inline-flex shrink-0 items-center justify-center rounded-md bg-white px-4 py-2.5 text-xs font-semibold text-red-700 shadow-sm transition hover:bg-red-50">
                + Buat Laporan
            </a>
        </section>

        <!-- Statistics -->
        <section class="grid grid-cols-1 gap-6 sm:grid-cols-3 lg:gap-14">
            @foreach ([
                'Total Laporan' => $totalReports,
                'Laporan Diproses' => $inProgressReports,
                'Laporan Selesai' => $completedReports,
            ] as $label => $count)
                <div class="min-h-[7rem] rounded-lg bg-white px-4 py-4 shadow-sm">
                    <p class="text-xs text-slate-500">{{ $label }}</p>
                    <p class="mt-1 text-2xl font-bold text-red-700">{{ $count }}</p>
                </div>
            @endforeach
        </section>

        <!-- Latest reports -->
        <section class="rounded-lg bg-white px-5 py-5 shadow-sm">
            <div class="flex items-center justify-between gap-4">
                <h2 class="text-base font-semibold text-slate-900">Laporan Terbaru</h2>
                <a href="#" class="text-xs font-medium text-red-600 hover:text-red-800">Lihat Semua &rarr;</a>
            </div>

            <div class="mt-5 overflow-x-auto">
                <table class="w-full min-w-[640px] text-left text-xs">
                    <thead>
                        <tr class="border-b border-slate-100 text-[10px] uppercase tracking-wide text-slate-500">
                            <th class="px-2 py-3 font-medium">Nomor Tiket</th>
                            <th class="px-2 py-3 font-medium">Judul Laporan</th>
                            <th class="px-2 py-3 font-medium">Tanggal</th>
                            <th class="px-2 py-3 font-medium">Status</th>
                            <th class="px-2 py-3 text-center font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($latestReports as $report)
                            <tr>
                                <td class="px-2 py-4 font-semibold text-red-700">{{ $report->ticket_number }}</td>
                                <td class="px-2 py-4 text-slate-700">{{ $report->title }}</td>
                                <td class="px-2 py-4 text-slate-700">{{ $report->created_at->locale('id')->translatedFormat('d M Y') }}</td>
                                <td class="px-2 py-4">
                                    <span class="inline-flex rounded-full px-2.5 py-1 text-[10px] font-semibold {{ $report->status->badgeClasses() }}">
                                        {{ $report->status->label() }}
                                    </span>
                                </td>
                                <td class="px-2 py-4 text-center">
                                    <a href="#" class="font-semibold text-red-700 hover:text-red-900">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-2 py-8 text-center text-slate-500">
                                    Belum ada laporan. Mulai sampaikan pengaduan atau aspirasi Anda.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</x-app-layout>
