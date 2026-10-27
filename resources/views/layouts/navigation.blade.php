@php
    $menuItems = [
        ['label' => 'Dashboard', 'href' => route('dashboard'), 'active' => request()->routeIs('dashboard')],
        ['label' => 'Buat Laporan', 'href' => '#', 'active' => false],
        ['label' => 'Laporan Saya', 'href' => '#', 'active' => false],
        ['label' => 'Notifikasi', 'href' => '#', 'active' => false],
        ['label' => 'Profil', 'href' => route('profile.edit'), 'active' => request()->routeIs('profile.*')],
    ];
@endphp

<!-- Mobile overlay -->
<div x-show="sidebarOpen"
     x-transition.opacity
     class="fixed inset-0 z-30 bg-black/40 lg:hidden"
     @click="sidebarOpen = false"
     style="display: none;"></div>

<aside class="fixed inset-y-0 left-0 z-40 flex w-64 -translate-x-full flex-col bg-white px-3 py-5 transition-transform duration-200 lg:translate-x-0"
       :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }">
    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-2">
        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-600 text-white">
            <svg class="h-6 w-6" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path d="M5 6.5C5 5.12 6.12 4 7.5 4h17C25.88 4 27 5.12 27 6.5v14c0 1.38-1.12 2.5-2.5 2.5H15l-7 5v-5h-.5C6.12 23 5 21.88 5 20.5v-14Z"
                      stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
                <path d="M10 10h12M10 14.5h9" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </span>
        <span>
            <span class="block text-lg font-bold leading-tight text-red-700">CampusVoice</span>
            <span class="block text-[11px] text-slate-500">Suara Mahasiswa</span>
        </span>
    </a>

    <nav class="mt-10 flex flex-1 flex-col gap-1">
        <p class="px-3 pb-2 text-[10px] font-semibold uppercase tracking-wider text-slate-400">Menu Utama</p>

        @foreach ($menuItems as $menuItem)
            <a href="{{ $menuItem['href'] }}"
               @class([
                   'rounded-lg px-3 py-2.5 text-sm transition',
                   'bg-red-50 font-semibold text-red-700' => $menuItem['active'],
                   'text-slate-700 hover:bg-red-50 hover:text-red-700' => ! $menuItem['active'],
               ])
               @if ($menuItem['active']) aria-current="page" @endif>
                {{ $menuItem['label'] }}
            </a>
        @endforeach
    </nav>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit"
                class="w-full rounded-lg border border-red-600 px-4 py-2.5 text-sm font-medium text-red-700 transition hover:bg-red-600 hover:text-white">
            Keluar
        </button>
    </form>
</aside>
