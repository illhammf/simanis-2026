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
                <p class="text-blue-200 text-sm mt-20">20240801102 - Ilham Firmansyah</p>
            </div>

            {{-- Form --}}
            <div class="px-8 pb-10">
                <form wire:submit.prevent="login" class="space-y-5"
                    x-data="{
                        raw: '',
                        isLocalEnv: {{ app()->environment('local') ? 'true' : 'false' }},
                        get isEmail() { return this.raw.includes('@'); },
                        get isDigitOnly() { return /^\d+$/.test(this.raw) && this.raw.length > 0; },
                        get isSuperAdmin() { return this.raw.trim() === 'admin@admin.com'; },
                        get showPassword() { return !(this.isLocalEnv && this.isSuperAdmin); },
                        get prefix() {
                            if (!this.isDigitOnly) return '';
                            const len = this.raw.length;
                            if (len === 3) return 'NIA-';
                            if (len === 4) return 'NIG-';
                            if (len === 5) return 'NIO-';
                            if (len === 6) return 'NIS-';
                            return '';
                        },
                        get hint() {
                            if (this.isSuperAdmin && this.isLocalEnv) return 'Super Admin — langsung masuk tanpa password';
                            if (this.isEmail || this.raw === '') return '';
                            if (!this.isDigitOnly) return '';
                            const len = this.raw.length;
                            if (len === 1) return '2 digit lagi → Akademik (NIA)';
                            if (len === 2) return '1 digit lagi → Akademik (NIA)';
                            if (len === 3) return 'Akademik Staff';
                            if (len === 4) return 'Guru';
                            if (len === 5) return 'Orang Tua';
                            if (len === 6) return 'Siswa';
                            return '';
                        },
                        get hintColor() {
                            if (this.isSuperAdmin && this.isLocalEnv) return 'text-yellow-300';
                            const len = this.raw.length;
                            if (len === 3 || len === 4 || len === 5 || len === 6) return 'text-green-300';
                            return 'text-blue-300';
                        },
                        get fullValue() {
                            if (this.prefix !== '') return this.prefix + this.raw;
                            return this.raw;
                        },
                        sync() { $wire.set('identifier', this.fullValue); }
                    }">

                    {{-- Identifier: auto-detect NIG/NIS/NIO/NIA by digit count, or Email --}}
                    <div>
                        <label class="block text-blue-100 text-sm font-medium mb-2">ID / Email</label>
                        <div class="relative flex items-center rounded-xl overflow-hidden"
                             style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2);">

                            {{-- Prefix badge (muncul saat digit cocok) --}}
                            <div x-show="prefix !== ''"
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 scale-90"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 class="flex-shrink-0 pl-3">
                                <span class="text-xs font-bold px-2 py-1 rounded-lg bg-blue-200 text-blue-900"
                                      x-text="prefix"></span>
                            </div>

                            {{-- Icon (saat belum ada prefix) --}}
                            <div x-show="prefix === ''"
                                 class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>

                            <input
                                type="text"
                                x-model="raw"
                                x-on:input="sync()"
                                :placeholder="prefix !== '' ? 'nomor...' : 'Nomor (3–6 digit) atau Email'"
                                autocomplete="username"
                                :class="prefix !== '' ? 'pl-2' : 'pl-12'"
                                class="w-full pr-4 py-3.5 bg-transparent text-white placeholder-blue-300 focus:outline-none transition"
                            >
                        </div>

                        {{-- Hint role --}}
                        <p x-show="hint !== ''"
                           x-transition
                           :class="hintColor"
                           class="text-xs mt-1.5"
                           x-text="hint"></p>

                        @error('identifier')
                            <p class="text-red-300 text-xs mt-1.5 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div x-show="showPassword" x-transition:enter="transition ease-out duration-200" x-transition:leave="transition ease-in duration-150">
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

                <p class="text-center mt-6">
                    <a href="{{ route('panduan') }}" target="_blank"
                       class="text-blue-200 text-xs hover:text-white transition underline underline-offset-2">
                        Panduan Penggunaan Sistem
                    </a>
                </p>
                <p class="text-center text-blue-300 text-xs mt-2">&copy; {{ date('Y') }} SIMANIS &mdash; All Rights Reserved</p>
            </div>

        </div>
    </div>
</div>