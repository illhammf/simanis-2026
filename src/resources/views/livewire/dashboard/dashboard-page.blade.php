@php
    $roleLabel = str_replace('_', ' ', auth()->user()->getRoleNames()->first() ?? '-');
    $hour      = (int) now()->format('H');
    $greeting  = $hour < 11 ? 'Selamat Pagi' : ($hour < 15 ? 'Selamat Siang' : ($hour < 18 ? 'Selamat Sore' : 'Selamat Malam'));
    $gradients = [
        'blue'   => 'linear-gradient(135deg,#2563eb 0%,#1d4ed8 100%)',
        'amber'  => 'linear-gradient(135deg,#f59e0b 0%,#d97706 100%)',
        'green'  => 'linear-gradient(135deg,#16a34a 0%,#15803d 100%)',
        'purple' => 'linear-gradient(135deg,#9333ea 0%,#7e22ce 100%)',
        'rose'   => 'linear-gradient(135deg,#e11d48 0%,#be123c 100%)',
    ];
    $softBg = [
        'blue'   => '#eff6ff', 'amber' => '#fffbeb',
        'green'  => '#f0fdf4', 'purple' => '#faf5ff', 'rose' => '#fff1f2',
    ];
    $softBorder = [
        'blue'   => '#bfdbfe', 'amber' => '#fde68a',
        'green'  => '#bbf7d0', 'purple' => '#e9d5ff', 'rose' => '#fecdd3',
    ];
    $iconColor = [
        'blue'   => '#2563eb', 'amber' => '#d97706',
        'green'  => '#16a34a', 'purple' => '#9333ea', 'rose' => '#e11d48',
    ];
@endphp

<div class="min-h-screen flex flex-col" style="background:#f1f5fb">

    {{-- ===== NAVBAR ===== --}}
    <header class="sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-gray-200/70 px-6 py-3 flex items-center justify-between"
            style="box-shadow:0 1px 12px rgba(37,99,235,.07)">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                 style="background:linear-gradient(135deg,#2563eb,#1d4ed8);box-shadow:0 4px 12px rgba(37,99,235,.35)">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                </svg>
            </div>
            <div>
                <span class="font-extrabold text-gray-900 text-base tracking-tight">SIMANIS</span>
                <span class="hidden sm:inline text-xs text-gray-400 ml-1">/ Dashboard</span>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <span class="hidden sm:inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold capitalize"
                  style="background:#eff6ff;color:#2563eb;border:1px solid #bfdbfe">
                {{ $roleLabel }}
            </span>
            <div class="flex items-center gap-2">
                <img src="{{ auth()->user()->getFilamentAvatarUrl() }}"
                     class="w-8 h-8 rounded-full object-cover ring-2 ring-blue-200" alt="avatar">
                <span class="hidden sm:block text-sm font-semibold text-gray-700">{{ auth()->user()->name }}</span>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium text-gray-500 hover:bg-red-50 hover:text-red-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </header>

    {{-- ===== HERO BANNER ===== --}}
    <div class="relative overflow-hidden mx-6 mt-6 rounded-3xl px-8 py-10 text-white"
         style="background:linear-gradient(135deg,#1e3a5f 0%,#2563eb 55%,#6d28d9 100%);box-shadow:0 20px 60px rgba(37,99,235,.3)">
        <div class="absolute -top-10 -right-10 w-56 h-56 rounded-full opacity-20"
             style="background:radial-gradient(circle,#fff,transparent)"></div>
        <div class="absolute bottom-0 left-1/3 w-40 h-40 rounded-full opacity-10"
             style="background:radial-gradient(circle,#c4b5fd,transparent)"></div>
        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <p class="text-blue-200 text-sm font-medium mb-1">{{ $greeting }},</p>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">{{ auth()->user()->name }}</h1>
                <p class="text-blue-200 text-sm mt-2 max-w-md">
                    Selamat menggunakan SIMANIS. Pilih panel di bawah untuk mulai bekerja.
                </p>
            </div>
            <div class="flex-shrink-0 hidden sm:block">
                <div class="w-20 h-20 rounded-2xl overflow-hidden ring-4 ring-white/30">
                    <img src="{{ auth()->user()->getFilamentAvatarUrl() }}" class="w-full h-full object-cover" alt="avatar">
                </div>
            </div>
        </div>
    </div>

    {{-- ===== MAIN ===== --}}
    <main class="flex-1 max-w-6xl w-full mx-auto px-6 py-8">

        <h2 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-5">Panel Tersedia</h2>

        @if($this->modules)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach($this->modules as $module)
                    @php $c = $module['color']; @endphp
                    <a href="{{ $module['url'] }}"
                       class="group relative flex flex-col rounded-2xl overflow-hidden transition-all duration-300 hover:-translate-y-1.5 hover:shadow-2xl"
                       style="background:#fff;border:1px solid {{ $softBorder[$c] ?? '#e2e8f0' }};box-shadow:0 2px 12px rgba(0,0,0,.06)">

                        {{-- Colored top strip --}}
                        <div class="h-1.5 w-full" style="background:{{ $gradients[$c] ?? $gradients['blue'] }}"></div>

                        <div class="flex-1 p-6">
                            {{-- Icon --}}
                            <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-5"
                                 style="background:{{ $softBg[$c] ?? '#eff6ff' }};box-shadow:0 0 0 6px {{ ($softBorder[$c] ?? '#bfdbfe') }}40">
                                @switch($module['icon'])
                                    @case('shield-check')
                                        <svg class="w-7 h-7" fill="none" stroke="{{ $iconColor[$c] ?? '#2563eb' }}" stroke-width="1.8" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg>
                                        @break
                                    @case('academic-cap')
                                        <svg class="w-7 h-7" fill="none" stroke="{{ $iconColor[$c] ?? '#2563eb' }}" stroke-width="1.8" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                                        </svg>
                                        @break
                                    @case('book-open')
                                        <svg class="w-7 h-7" fill="none" stroke="{{ $iconColor[$c] ?? '#16a34a' }}" stroke-width="1.8" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                        </svg>
                                        @break
                                    @case('user-group')
                                        <svg class="w-7 h-7" fill="none" stroke="{{ $iconColor[$c] ?? '#9333ea' }}" stroke-width="1.8" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        @break
                                    @case('home')
                                        <svg class="w-7 h-7" fill="none" stroke="{{ $iconColor[$c] ?? '#e11d48' }}" stroke-width="1.8" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                        </svg>
                                        @break
                                    @default
                                        <svg class="w-7 h-7" fill="none" stroke="{{ $iconColor[$c] ?? '#2563eb' }}" stroke-width="1.8" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                        </svg>
                                @endswitch
                            </div>

                            <h3 class="font-bold text-gray-900 text-base mb-1.5">{{ $module['label'] }}</h3>
                            <p class="text-gray-500 text-sm leading-relaxed">{{ $module['description'] }}</p>
                        </div>

                        {{-- Footer action --}}
                        <div class="px-6 pb-5">
                            <div class="flex items-center justify-between pt-4"
                                 style="border-top:1px solid {{ $softBorder[$c] ?? '#e2e8f0' }}">
                                <span class="text-xs font-semibold uppercase tracking-wider"
                                      style="color:{{ $iconColor[$c] ?? '#2563eb' }}">
                                    Buka Panel
                                </span>
                                <div class="w-7 h-7 rounded-full flex items-center justify-center transition-transform duration-200 group-hover:translate-x-1"
                                     style="background:{{ $softBg[$c] ?? '#eff6ff' }}">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="{{ $iconColor[$c] ?? '#2563eb' }}" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-24 text-gray-400">
                <div class="w-20 h-20 rounded-3xl flex items-center justify-center mb-5 bg-gray-100">
                    <svg class="w-10 h-10 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <p class="font-semibold text-gray-600 text-lg">Tidak ada panel tersedia</p>
                <p class="text-sm mt-1">Hubungi administrator untuk mendapatkan akses.</p>
            </div>
        @endif

    </main>

    {{-- ===== FOOTER ===== --}}
    <footer class="text-center text-xs text-gray-400 py-5 border-t border-gray-200 mt-4">
        &copy; {{ date('Y') }} <span class="font-semibold text-gray-500">SIMANIS</span>
        &mdash; Sistem Manajemen Informasi Sekolah
    </footer>

</div>