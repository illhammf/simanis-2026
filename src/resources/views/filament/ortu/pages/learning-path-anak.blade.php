<x-filament-panels::page>
    <div class="space-y-6">

        {{-- Header --}}
        @if ($student && $student->stream)
            <div class="rounded-2xl p-6 text-white"
                 style="background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 60%, #3b82f6 100%);">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <p class="text-blue-200 text-sm font-medium uppercase tracking-wider mb-1">Learning Pathway Anak</p>
                        <h1 class="text-2xl font-bold">{{ $student->stream->nama }}</h1>
                        <p class="text-blue-100 text-sm mt-1">
                            {{ $student->nama ?? $student->user?->name }} &bull; Kelas {{ $student->kelas?->nama ?? '-' }}
                        </p>
                        @if ($student->stream->deskripsi)
                            <p class="text-blue-100/80 mt-1 text-xs">{{ $student->stream->deskripsi }}</p>
                        @endif
                    </div>
                    <div class="text-right shrink-0">
                        <p class="text-blue-200 text-xs uppercase tracking-wider">Progress</p>
                        <p class="text-3xl font-bold">{{ $currentSem }}<span class="text-lg font-normal text-blue-200">/6</span></p>
                        <p class="text-blue-200 text-xs mt-1">Semester saat ini</p>
                    </div>
                </div>

                {{-- Progress bar --}}
                <div class="mt-4">
                    <div class="flex justify-between text-xs text-blue-200 mb-1">
                        <span>Tahun 1</span><span>Tahun 2</span><span>Tahun 3</span>
                    </div>
                    <div class="w-full bg-blue-900/50 rounded-full h-2.5 overflow-hidden">
                        <div class="h-2.5 rounded-full bg-gradient-to-r from-green-400 to-blue-300 transition-all duration-700"
                             style="width: {{ round(($currentSem / 6) * 100) }}%"></div>
                    </div>
                    <div class="flex justify-between text-xs text-blue-200 mt-1">
                        @for ($s = 1; $s <= 6; $s++)
                            <span class="{{ $s <= $currentSem ? 'text-white font-semibold' : '' }}">S{{ $s }}</span>
                        @endfor
                    </div>
                </div>
            </div>
        @else
            <div class="rounded-2xl p-6 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-center">
                <x-heroicon-o-map class="w-12 h-12 mx-auto text-gray-400 mb-3" />
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Stream belum ditetapkan</h2>
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">
                    Hubungi wali kelas atau admin untuk menetapkan Learning Pathway anak Anda.
                </p>
            </div>
        @endif

        {{-- Info orang tua --}}
        @if ($student && $student->stream && $student->stream->milestones->isNotEmpty())
            <div class="rounded-xl border border-amber-200 bg-amber-50 dark:bg-amber-950/30 dark:border-amber-800 p-4 flex gap-3">
                <x-heroicon-s-information-circle class="w-5 h-5 text-amber-600 dark:text-amber-400 shrink-0 mt-0.5" />
                <p class="text-sm text-amber-700 dark:text-amber-300">
                    Halaman ini menampilkan jalur belajar anak Anda. Gunakan informasi kompetensi dan target karakter tiap semester sebagai bahan diskusi bersama anak di rumah.
                </p>
            </div>
        @endif

        {{-- Timeline --}}
        @if ($student && $student->stream && $student->stream->milestones->isNotEmpty())
            <div class="grid grid-cols-1 gap-5">
                @foreach ($student->stream->milestones->where('is_aktif', true) as $milestone)
                    @php
                        $sem       = $milestone->semester;
                        $isDone    = $sem < $currentSem;
                        $isCurrent = $sem === $currentSem;
                        $isFuture  = $sem > $currentSem;
                        $yearLabel = match (true) {
                            $sem <= 2 => 'Tahun 1',
                            $sem <= 4 => 'Tahun 2',
                            default   => 'Tahun 3',
                        };
                    @endphp

                    <div class="relative flex gap-5 group">
                        {{-- Connector line --}}
                        @unless ($loop->last)
                            <div class="absolute left-[1.625rem] top-14 bottom-0 w-0.5
                                {{ $isDone ? 'bg-green-400' : ($isCurrent ? 'bg-blue-400' : 'bg-gray-200 dark:bg-gray-700') }}">
                            </div>
                        @endunless

                        {{-- Icon circle --}}
                        <div class="shrink-0 w-[3.25rem] flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm shadow-md z-10
                                {{ $isDone    ? 'bg-green-500 text-white' :
                                   ($isCurrent ? 'bg-blue-600 text-white ring-4 ring-blue-300 dark:ring-blue-900' :
                                                 'bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400') }}">
                                @if ($isDone)
                                    <x-heroicon-s-check class="w-5 h-5" />
                                @else
                                    {{ $sem }}
                                @endif
                            </div>
                        </div>

                        {{-- Card --}}
                        <div class="flex-1 rounded-xl border p-5 mb-1 transition-all duration-200
                            {{ $isDone    ? 'bg-green-50 dark:bg-green-950/30 border-green-200 dark:border-green-800' :
                               ($isCurrent ? 'bg-white dark:bg-gray-900 border-blue-400 shadow-lg ring-1 ring-blue-300 dark:ring-blue-700' :
                                             'bg-gray-50 dark:bg-gray-800/50 border-gray-200 dark:border-gray-700 opacity-80') }}">

                            {{-- Card header --}}
                            <div class="flex flex-wrap items-start justify-between gap-2 mb-3">
                                <div>
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <span class="text-xs font-medium uppercase tracking-wider
                                            {{ $isDone ? 'text-green-600 dark:text-green-400' :
                                               ($isCurrent ? 'text-blue-600 dark:text-blue-400' : 'text-gray-400') }}">
                                            {{ $yearLabel }} &bull; Semester {{ $sem }}
                                        </span>
                                        @if ($isCurrent)
                                            <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300">
                                                ● Sekarang
                                            </span>
                                        @elseif ($isDone)
                                            <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300">
                                                ✓ Selesai
                                            </span>
                                        @else
                                            <span class="px-2 py-0.5 rounded-full text-xs bg-gray-100 text-gray-400 dark:bg-gray-700 dark:text-gray-500">
                                                Mendatang
                                            </span>
                                        @endif
                                    </div>
                                    <h3 class="text-base font-semibold mt-1
                                        {{ $isFuture ? 'text-gray-400 dark:text-gray-500' : 'text-gray-800 dark:text-gray-100' }}">
                                        {{ $milestone->judul }}
                                    </h3>
                                </div>
                            </div>

                            @if ($milestone->deskripsi)
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 leading-relaxed">
                                    {{ $milestone->deskripsi }}
                                </p>
                            @endif

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                {{-- Kompetensi Akademik --}}
                                @if ($milestone->kompetensi_list)
                                    <div>
                                        <h4 class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2 flex items-center gap-1">
                                            <x-heroicon-s-academic-cap class="w-3.5 h-3.5" /> Kompetensi Akademik
                                        </h4>
                                        <ul class="space-y-1">
                                            @foreach ($milestone->kompetensi_list as $item)
                                                <li class="flex items-start gap-2 text-sm
                                                    {{ $isFuture ? 'text-gray-400 dark:text-gray-600' : 'text-gray-700 dark:text-gray-300' }}">
                                                    <span class="mt-1.5 w-1.5 h-1.5 rounded-full shrink-0
                                                        {{ $isDone ? 'bg-green-500' : ($isCurrent ? 'bg-blue-500' : 'bg-gray-300') }}">
                                                    </span>
                                                    {{ $item }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                {{-- Target Karakter --}}
                                @if ($milestone->target_list)
                                    <div>
                                        <h4 class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2 flex items-center gap-1">
                                            <x-heroicon-s-sparkles class="w-3.5 h-3.5" /> Target Karakter
                                        </h4>
                                        <ul class="space-y-1">
                                            @foreach ($milestone->target_list as $item)
                                                <li class="flex items-start gap-2 text-sm
                                                    {{ $isFuture ? 'text-gray-400 dark:text-gray-600' : 'text-gray-700 dark:text-gray-300' }}">
                                                    <span class="mt-1.5 w-1.5 h-1.5 rounded-full shrink-0
                                                        {{ $isDone ? 'bg-green-500' : ($isCurrent ? 'bg-blue-500' : 'bg-gray-300') }}">
                                                    </span>
                                                    {{ $item }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            {{-- Tips untuk orang tua di semester aktif --}}
                            @if ($isCurrent && $milestone->tips)
                                <div class="mt-4 p-3 rounded-lg bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-800">
                                    <p class="text-xs font-semibold text-amber-700 dark:text-amber-300 uppercase tracking-wider mb-1">
                                        💡 Cara Mendukung Anak di Semester Ini
                                    </p>
                                    <p class="text-sm text-amber-700 dark:text-amber-300 leading-relaxed">
                                        {{ $milestone->tips }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</x-filament-panels::page>