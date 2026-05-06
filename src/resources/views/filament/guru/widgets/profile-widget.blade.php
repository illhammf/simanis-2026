<x-filament::section>
    <div class="flex items-center gap-4">

        {{-- Avatar --}}
        <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center text-xl font-bold">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>

        {{-- Info --}}
        <div>
            <h2 class="text-lg font-bold">
                {{ auth()->user()->name }}
            </h2>

            <p class="text-sm text-gray-500">
                {{ auth()->user()->email }}
            </p>

            <span class="inline-block mt-1 text-xs bg-primary-100 text-primary-600 px-2 py-1 rounded">
                {{ strtoupper(str_replace('_', ' ', auth()->user()->role)) }}
            </span>
        </div>

    </div>
</x-filament::section>