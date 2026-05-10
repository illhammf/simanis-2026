@php
    $panelId   = filament()->getCurrentPanel()?->getId() ?? '';
    $panelMeta = [
        'admin'     => ['label' => 'Panel Admin',        'color' => '#2563eb', 'bg' => '#eff6ff', 'border' => '#bfdbfe'],
        'akademik'  => ['label' => 'Panel Akademik',     'color' => '#d97706', 'bg' => '#fffbeb', 'border' => '#fde68a'],
        'guru'      => ['label' => 'Panel Guru',         'color' => '#16a34a', 'bg' => '#f0fdf4', 'border' => '#bbf7d0'],
        'siswa'     => ['label' => 'Panel Siswa',        'color' => '#9333ea', 'bg' => '#faf5ff', 'border' => '#e9d5ff'],
        'orang-tua' => ['label' => 'Panel Orang Tua',   'color' => '#e11d48', 'bg' => '#fff1f2', 'border' => '#fecdd3'],
    ];
    $meta = $panelMeta[$panelId] ?? ['label' => 'Panel', 'color' => '#2563eb', 'bg' => '#eff6ff', 'border' => '#bfdbfe'];
@endphp

<div class="rounded-2xl overflow-hidden"
     style="background:{{ $meta['bg'] }};border:1px solid {{ $meta['border'] }};box-shadow:0 2px 12px rgba(0,0,0,.05)">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 px-6 py-4">

        {{-- Kiri: info panel aktif --}}
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                 style="background:{{ $meta['color'] }}1a;border:1px solid {{ $meta['border'] }}">
                <svg class="w-5 h-5" fill="none" stroke="{{ $meta['color'] }}" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 7a2 2 0 012-2h4a2 2 0 012 2v2a2 2 0 01-2 2H5a2 2 0 01-2-2V7zM3 15a2 2 0 012-2h4a2 2 0 012 2v2a2 2 0 01-2 2H5a2 2 0 01-2-2v-2zM13 7a2 2 0 012-2h4a2 2 0 012 2v10a2 2 0 01-2 2h-4a2 2 0 01-2-2V7z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider" style="color:{{ $meta['color'] }}">
                    Sedang di
                </p>
                <p class="font-bold text-gray-800 text-sm">{{ $meta['label'] }}</p>
            </div>
        </div>

        {{-- Kanan: tombol kembali --}}
        <a href="{{ route('dashboard') }}"
           class="group inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200 hover:shadow-md hover:-translate-y-0.5"
           style="background:{{ $meta['color'] }};color:#fff;box-shadow:0 2px 8px {{ $meta['color'] }}40">
            <svg class="w-4 h-4 transition-transform duration-200 group-hover:-translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Pilihan Modul
        </a>
    </div>
</div>