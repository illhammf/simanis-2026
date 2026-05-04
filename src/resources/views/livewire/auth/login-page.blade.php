<div class="min-h-screen flex items-center justify-center relative overflow-hidden"
     style="background: linear-gradient(135deg, #1e3a5f 0%, #2563eb 50%, #1d4ed8 100%)">

    {{-- Decorative blobs --}}
    <div class="absolute top-0 left-0 w-96 h-96 rounded-full opacity-20"
         style="background: radial-gradient(circle, #60a5fa, transparent); transform: translate(-30%, -30%)"></div>
    <div class="absolute bottom-0 right-0 w-80 h-80 rounded-full opacity-20"
         style="background: radial-gradient(circle, #93c5fd, transparent); transform: translate(30%, 30%)"></div>
    <div class="absolute top-1/2 left-1/4 w-64 h-64 rounded-full opacity-10"
         style="background: radial-gradient(circle, #bfdbfe, transparent); transform: translateY(-50%)"></div>

    <div class="relative z-10 w-full max-w-md mx-4">

        {{-- Card --}}
        <div class="rounded-3xl overflow-hidden"
             style="background: rgba(255,255,255,0.1); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.2); box-shadow: 0 25px 50px rgba(0,0,0,0.3)">

            {{-- Header --}}
            <div class="px-8 pt-10 pb-6 text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl mb-4"
                     style="background: rgba(255,255,255,0.2); border: 1px solid rgba(255,255,255,0.3)">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                              d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-white tracking-wide">SIMANIS</h1>
                <p class="text-blue-200 text-sm mt-1">Sistem Manajemen Informasi Sekolah</p>
            </div>

            {{-- Form --}}
            <div class="px-8 pb-10">
                <form wire:submit.prevent="login" class="space-y-5">

                    {{-- Email --}}
                    <div>
                        <label class="block text-blue-100 text-sm font-medium mb-2">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <input
                                type="email"
                                wire:model="email"
                                placeholder="nama@sekolah.sch.id"
                                autocomplete="email"
                                class="w-full pl-12 pr-4 py-3.5 rounded-xl text-white placeholder-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-300 transition"
                                style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2);"
                            >
                        </div>
                        @error('email')
                            <p class="text-red-300 text-xs mt-1.5 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="block text-blue-100 text-sm font-medium mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input
                                type="password"
                                wire:model="password"
                                placeholder="••••••••"
                                autocomplete="current-password"
                                class="w-full pl-12 pr-4 py-3.5 rounded-xl text-white placeholder-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-300 transition"
                                style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2);"
                            >
                        </div>
                        @error('password')
                            <p class="text-red-300 text-xs mt-1.5 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        class="w-full py-3.5 rounded-xl font-semibold text-blue-900 transition-all duration-200 mt-2"
                        style="background: linear-gradient(135deg, #93c5fd, #ffffff); box-shadow: 0 4px 15px rgba(147,197,253,0.4);"
                    >
                        <span wire:loading.remove>Masuk</span>
                        <span wire:loading class="flex items-center justify-center gap-2">
                            <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                            Memproses...
                        </span>
                    </button>

                </form>

                <p class="text-center text-blue-300 text-xs mt-6">&copy; {{ date('Y') }} SIMANIS &mdash; All rights reserved</p>
            </div>

        </div>
    </div>
</div>