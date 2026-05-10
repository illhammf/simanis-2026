<x-filament-panels::page>
    <div class="mb-4 text-sm text-gray-500 dark:text-gray-400 flex items-center gap-2">
        <x-filament::icon icon="heroicon-o-lock-closed" class="w-4 h-4" />
        Data profil sekolah hanya dapat diubah oleh Administrator.
    </div>

    {{ $this->form }}
</x-filament-panels::page>