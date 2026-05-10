@php
    $palettes = [
        ['color' => '#6366f1', 'light' => '#eef2ff'],
        ['color' => '#0ea5e9', 'light' => '#e0f2fe'],
        ['color' => '#10b981', 'light' => '#d1fae5'],
        ['color' => '#f97316', 'light' => '#ffedd5'],
        ['color' => '#ec4899', 'light' => '#fce7f3'],
        ['color' => '#3b82f6', 'light' => '#dbeafe'],
        ['color' => '#14b8a6', 'light' => '#ccfbf1'],
        ['color' => '#a855f7', 'light' => '#f3e8ff'],
    ];
@endphp

<x-filament-widgets::widget id="overlook-widget" @class(['hidden' => ! $data])>
    <x-filament::grid
        :default="$grid['default'] ?? 2"
        :sm="$grid['sm'] ?? 2"
        :md="$grid['md'] ?? 4"
        :lg="$grid['lg'] ?? 4"
        :xl="$grid['xl'] ?? 4"
        class="gap-4"
    >
        @foreach ($data as $i => $resource)
            @php $p = $palettes[$i % count($palettes)]; @endphp
            <x-filament::grid.column>
                <a
                    href="{{ $resource['url'] }}"
                    class="group flex flex-col rounded-2xl overflow-hidden bg-white dark:bg-gray-800 transition-all duration-200 hover:-translate-y-1 hover:shadow-xl focus:outline-none"
                    style="box-shadow: 0 2px 12px rgba(0,0,0,0.07); border: 1px solid rgba(0,0,0,0.06);"
                    @if ($this->shouldShowTooltips($resource['raw_count']))
                        x-data x-tooltip="'{{ $resource['raw_count'] }}'"
                    @endif
                >
                    <div style="height: 4px; background: {{ $p['color'] }};"></div>

                    <div style="padding: 1.25rem; display: flex; flex-direction: column; gap: 0.875rem;">
                        @if ($resource['icon'])
                            <div style="width:2.75rem;height:2.75rem;border-radius:0.875rem;background:{{ $p['light'] }};display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <x-filament::icon :icon="$resource['icon']" class="w-5 h-5" style="color: {{ $p['color'] }};" />
                            </div>
                        @endif

                        <div class="text-gray-800 dark:text-white font-black leading-none tracking-tight" style="font-size: 2.25rem;">
                            {{ $resource['count'] }}
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-sm font-semibold text-gray-500 dark:text-gray-400">{{ $resource['name'] }}</span>
                            <svg class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1" style="color: {{ $p['color'] }};" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </div>
                    </div>
                </a>
            </x-filament::grid.column>
        @endforeach
    </x-filament::grid>
</x-filament-widgets::widget>