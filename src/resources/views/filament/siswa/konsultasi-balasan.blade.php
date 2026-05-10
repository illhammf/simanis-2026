<div class="space-y-4 p-2">
    <div>
        <p class="text-sm font-semibold text-gray-500 dark:text-gray-400">Pesan Kamu</p>
        <div class="mt-1 rounded-lg bg-gray-100 dark:bg-gray-800 p-4 text-sm">
            {{ $konsultasi->pesan }}
        </div>
    </div>

    <div>
        <p class="text-sm font-semibold text-gray-500 dark:text-gray-400">Balasan Wali Kelas</p>
        <div class="mt-1 rounded-lg bg-primary-50 dark:bg-primary-900/20 border border-primary-200 dark:border-primary-700 p-4 text-sm">
            {{ $konsultasi->balasan }}
        </div>
        <p class="mt-1 text-xs text-gray-400">
            Dibalas pada {{ $konsultasi->dibalas_at?->format('d/m/Y H:i') ?? '-' }}
            oleh {{ $konsultasi->teacher->name ?? '-' }}
        </p>
    </div>
</div>