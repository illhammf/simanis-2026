<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Penggunaan — SIMANIS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* ── Base ── */
        body { font-family: 'Inter', system-ui, sans-serif; }

        /* ── Sidebar ── */
        #sidebar { scrollbar-width: thin; scrollbar-color: rgba(255,255,255,.2) transparent; }
        #sidebar::-webkit-scrollbar { width: 4px; }
        #sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,.2); border-radius: 4px; }

        .sidebar-link {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 14px; border-radius: 10px;
            font-size: .825rem; font-weight: 500;
            color: rgba(255,255,255,.7);
            transition: background .15s, color .15s;
            cursor: pointer; text-decoration: none;
        }
        .sidebar-link:hover { background: rgba(255,255,255,.12); color: #fff; }
        .sidebar-link.active { background: rgba(255,255,255,.18); color: #fff; font-weight: 700; }
        .sidebar-link .dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }

        /* ── Section card ── */
        .section-card {
            background: #fff; border-radius: 20px;
            box-shadow: 0 2px 16px rgba(0,0,0,.07), 0 0 0 1px rgba(0,0,0,.04);
            overflow: hidden;
        }
        .section-header {
            padding: 24px 28px 20px;
            border-bottom: 1px solid #f1f5f9;
            display: flex; align-items: flex-start; gap: 16px;
        }
        .section-icon {
            width: 48px; height: 48px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .section-body { padding: 24px 28px; }

        /* ── Feature card ── */
        .feat { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 16px 18px; }
        .feat:hover { border-color: #cbd5e1; background: #f1f5f9; }
        .feat-title { font-size: .88rem; font-weight: 700; color: #1e293b; margin-bottom: 5px; }
        .feat-desc  { font-size: .82rem; color: #64748b; line-height: 1.55; }

        /* ── Step badge ── */
        .step-badge {
            width: 26px; height: 26px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: .72rem; font-weight: 800; flex-shrink: 0;
        }

        /* ── Table ── */
        .db-table { display: flex; align-items: flex-start; gap: 10px; padding: 10px 14px;
                    background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; }
        .db-table:hover { background: #eff6ff; border-color: #bfdbfe; }
        .db-pill { font-size: .72rem; font-family: monospace; font-weight: 700;
                   background: #eff6ff; color: #1d4ed8; padding: 3px 8px;
                   border-radius: 6px; flex-shrink: 0; margin-top: 1px; }

        /* ── Badge ── */
        .role-badge { display: inline-flex; align-items: center; padding: 3px 10px;
                      border-radius: 99px; font-size: .72rem; font-weight: 700; color: #fff; }



        /* ── Tip box ── */
        .tip { background: #eff6ff; border-left: 3px solid #3b82f6; border-radius: 8px;
               padding: 12px 16px; font-size: .81rem; color: #1e40af; }
        .tip strong { color: #1d4ed8; }

        /* ── URL tag ── */
        .url-tag { font-size: .7rem; font-family: monospace; font-weight: 600;
                   background: rgba(255,255,255,.15); color: rgba(255,255,255,.9);
                   padding: 2px 8px; border-radius: 6px; }
    </style>
</head>
<body class="min-h-screen" style="background: #f1f5f9">

{{-- ══════════════ LAYOUT ══════════════ --}}
<div class="max-w-[1380px] mx-auto px-4 py-8 flex gap-7">

    {{-- ── SIDEBAR ── --}}
    <aside id="sidebar"
           class="hidden lg:flex flex-col gap-1 w-64 flex-shrink-0 sticky top-6 h-[calc(100vh-3rem)] overflow-y-auto pb-6 rounded-2xl px-3 py-4"
           style="background: linear-gradient(180deg,#1e3a8a 0%,#0f2044 100%); box-shadow: 0 4px 24px rgba(15,32,68,.25)">

        <p class="text-xs font-bold uppercase tracking-widest px-2 mb-1" style="color:rgba(255,255,255,.4)">Daftar Isi</p>

        <a href="#pengantar" class="sidebar-link">
            <span class="dot" style="background:#6366f1"></span> Pengantar
        </a>
        <a href="#login" class="sidebar-link">
            <span class="dot" style="background:#8b5cf6"></span> Format Login
        </a>
        <p class="text-xs font-bold uppercase tracking-widest px-2 mt-3 mb-1" style="color:rgba(255,255,255,.4)">Panel</p>
        <a href="#admin" class="sidebar-link">
            <span class="dot" style="background:#7c3aed"></span> Admin
        </a>
        <a href="#akademik" class="sidebar-link">
            <span class="dot" style="background:#4f46e5"></span> Akademik
        </a>
        <a href="#guru" class="sidebar-link">
            <span class="dot" style="background:#2563eb"></span> Guru
        </a>
        <a href="#siswa" class="sidebar-link">
            <span class="dot" style="background:#16a34a"></span> Siswa
        </a>
        <a href="#ortu" class="sidebar-link">
            <span class="dot" style="background:#0891b2"></span> Orang Tua
        </a>
        <p class="text-xs font-bold uppercase tracking-widest px-2 mt-3 mb-1" style="color:rgba(255,255,255,.4)">Referensi</p>
        <a href="#database" class="sidebar-link">
            <span class="dot" style="background:#f59e0b"></span> Database
        </a>
        <a href="#alur" class="sidebar-link">
            <span class="dot" style="background:#ef4444"></span> Alur Sistem
        </a>
    </aside>

    {{-- ── MAIN CONTENT ── --}}
    <main class="flex-1 min-w-0 space-y-8">

        {{-- ══ PENGANTAR ══ --}}
        <section id="pengantar">
            <div class="section-card" style="background: linear-gradient(135deg,#1e3a8a,#1d4ed8)">
                <div class="px-8 py-10">
                    <div class="max-w-2xl">
                        <div class="inline-flex items-center gap-2 bg-white/15 text-white text-xs font-semibold px-3 py-1.5 rounded-full mb-4">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                            </svg>
                            Dokumentasi Resmi
                        </div>
                        <h1 class="text-3xl font-extrabold text-white leading-tight mb-3">
                            Panduan Penggunaan<br>SIMANIS
                        </h1>
                        <p class="text-blue-200 leading-relaxed text-sm">
                            <strong class="text-white">SIMANIS</strong> (Sistem Manajemen Informasi Sekolah) adalah aplikasi berbasis web
                            yang menyediakan panel terpisah untuk setiap peran — Admin, Akademik, Guru, Siswa, dan Orang Tua.
                            <br>Dokumen ini menjelaskan fitur-fitur yang tersedia di setiap panel secara lengkap.
                            <br>Dibuatnya Sistem ini sebagai contoh implementasi dari Mata Kuliah Pemrograman Web 2026
                        </p>
                        <div class="flex flex-wrap gap-3 mt-6">
                            @foreach([
                                ['label'=>'/admin','color'=>'bg-purple-500/80'],
                                ['label'=>'/adm','color'=>'bg-indigo-500/80'],
                                ['label'=>'/guru','color'=>'bg-blue-500/80'],
                                ['label'=>'/siswa','color'=>'bg-green-600/80'],
                                ['label'=>'/ortu','color'=>'bg-teal-600/80'],
                            ] as $p)
                            <span class="inline-flex items-center gap-1.5 {{ $p['color'] }} text-white text-xs font-mono font-bold px-3 py-1.5 rounded-lg">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                                {{ $p['label'] }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ══ FORMAT LOGIN ══ --}}
        <section id="login">
            <div class="section-card">
                <div class="section-header">
                    <div class="section-icon" style="background:#f3f0ff">
                        <svg class="w-5 h-5" style="color:#7c3aed" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-800">Format Login</h2>
                        <p class="text-slate-500 text-sm mt-0.5">
                            Sistem mendeteksi peran secara otomatis berdasarkan format ID yang dimasukkan — tidak perlu pilih role secara manual.
                        </p>
                    </div>
                </div>
                <div class="section-body space-y-5">

                    <div class="tip">
                        <strong>Cara kerja:</strong> <br>Saat Anda mengetik di kolom ID/Email, sistem langsung menampilkan
                        petunjuk peran secara real-time. Jika format berupa angka, awalan NIA/NIG/NIO/NIS
                        otomatis ditambahkan berdasarkan jumlah digit.
                    </div>

                    <div class="overflow-x-auto rounded-xl border border-slate-200">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-200">
                                    <th class="text-left px-5 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wide">Peran</th>
                                    <th class="text-left px-5 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wide">Format ID</th>
                                    <th class="text-left px-5 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wide">Contoh</th>
                                    <th class="text-left px-5 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wide">Panel</th>
                                    <th class="text-left px-5 py-3 font-semibold text-slate-600 text-xs uppercase tracking-wide">Password Default</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach([
                                    ['role'=>'Super Admin','format'=>'Email','contoh'=>'admin@admin.com','panel'=>'/admin','pw'=>'(set saat install)','dot'=>'bg-purple-500'],
                                    ['role'=>'Akademik Staff','format'=>'3 digit angka','contoh'=>'001 → NIA-001','panel'=>'/adm','pw'=>'NIA-001','dot'=>'bg-indigo-500'],
                                    ['role'=>'Guru','format'=>'4 digit angka','contoh'=>'0001 → NIG-0001','panel'=>'/guru','pw'=>'NIG-0001','dot'=>'bg-blue-500'],
                                    ['role'=>'Orang Tua','format'=>'5 digit angka','contoh'=>'00001 → NIO-00001','panel'=>'/ortu','pw'=>'NIO-00001','dot'=>'bg-teal-500'],
                                    ['role'=>'Siswa','format'=>'6 digit angka','contoh'=>'000001 → NIS-000001','panel'=>'/siswa','pw'=>'NIS-000001','dot'=>'bg-green-500'],
                                ] as $row)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="px-5 py-3.5">
                                        <span class="inline-flex items-center gap-1.5">
                                            <span class="w-2 h-2 rounded-full {{ $row['dot'] }}"></span>
                                            <span class="font-semibold text-slate-700">{{ $row['role'] }}</span>
                                        </span>
                                    </td>
                                    <td class="px-5 py-3.5 text-slate-600">{{ $row['format'] }}</td>
                                    <td class="px-5 py-3.5">
                                        <code class="text-xs bg-slate-100 text-slate-700 px-2 py-1 rounded-md font-mono">{{ $row['contoh'] }}</code>
                                    </td>
                                    <td class="px-5 py-3.5">
                                        <code class="text-xs bg-blue-50 text-blue-700 px-2 py-1 rounded-md font-mono">{{ $row['panel'] }}</code>
                                    </td>
                                    <td class="px-5 py-3.5 text-slate-500 text-xs">{{ $row['pw'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="tip" style="background:#fefce8; border-color:#eab308; color:#713f12">
                        <strong style="color:#92400e">Tips:</strong>
                        Jika ID yang dimasukkan adalah <code class="font-mono text-xs bg-yellow-100 px-1 rounded">admin@admin.com</code>
                        di lingkungan <em>local/development</em>, tombol login langsung aktif tanpa perlu isi password.
                    </div>
                </div>
            </div>
        </section>

        {{-- ══ PANEL SECTIONS ══ --}}
        @php
        $panels = [
            [
                'id'      => 'admin',
                'title'   => 'Panel Admin',
                'sub'     => 'Super Admin',
                'url'     => '/admin',
                'dot'     => '#7c3aed',
                'icon_bg' => '#f3f0ff',
                'icon_c'  => '#7c3aed',
                'icon_path' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                'desc'    => 'Panel Super Admin memiliki akses penuh ke seluruh sistem, termasuk konfigurasi hak akses, manajemen pengguna lintas peran, dan audit aktivitas.',
                'tip'     => 'Panel ini hanya dapat diakses oleh Super Admin. Jangan bagikan kredensial akun ini ke siapapun.',
                'tip_type'=> 'warning',
                'features' => [
                    [
                        'name' => 'Manajemen Pengguna',
                        'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z',
                        'desc' => 'Buat, edit, nonaktifkan, atau hapus akun pengguna. Setiap pengguna memiliki tepat satu role. Pengguna dapat dihubungkan ke data siswa, guru, atau orang tua.',
                        'badge' => ['Buat Akun','Edit','Hapus','Nonaktifkan'],
                    ],
                    [
                        'name' => 'Roles & Permissions (Shield)',
                        'icon' => 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z',
                        'desc' => 'Kelola role (Super Admin, Akademik, Guru, Siswa, Orang Tua) dan izin akses per resource Filament. Setiap resource dapat diatur: view, create, update, delete, per role.',
                        'badge' => ['Role Management','Permission Matrix'],
                    ],
                    [
                        'name' => 'Impersonate (Login Sebagai Pengguna Lain)',
                        'icon' => 'M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z',
                        'desc' => 'Fitur khusus untuk troubleshooting: admin dapat login sebagai pengguna lain (siswa, guru, dll) tanpa mengetahui password mereka. Banner impersonate selalu terlihat saat mode ini aktif.',
                        'badge' => ['Impersonate','Keluar Impersonate'],
                    ],
                    [
                        'name' => 'Activity Log',
                        'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
                        'desc' => 'Audit trail lengkap semua perubahan data di seluruh sistem: siapa yang mengubah, data apa, kapan, dan apa isinya sebelum/sesudah perubahan.',
                        'badge' => ['Created','Updated','Deleted'],
                    ],
                ],
            ],
            [
                'id'      => 'akademik',
                'title'   => 'Panel Akademik',
                'sub'     => 'Staf Tata Usaha / Akademik',
                'url'     => '/adm',
                'dot'     => '#4f46e5',
                'icon_bg' => '#eef2ff',
                'icon_c'  => '#4f46e5',
                'icon_path' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
                'desc'    => 'Panel untuk staf tata usaha/akademik. Mengelola seluruh data master sekolah, struktur kelas, peserta didik, tenaga pengajar, dan kalender akademik.',
                'tip'     => 'Urutan pengisian data yang disarankan: Kurikulum → Mata Pelajaran → Tahun Ajaran → Ruangan → Kelas → Guru → Siswa → Jadwal Pelajaran.',
                'tip_type'=> 'info',
                'features' => [
                    [
                        'name' => 'Tahun Ajaran',
                        'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
                        'desc' => 'Kelola tahun ajaran (misal: 2025/2026 Semester 1). Tandai satu tahun ajaran sebagai "aktif". Data kelas otomatis terhubung ke tahun ajaran yang dipilih.',
                        'badge' => ['Aktif/Non-Aktif'],
                    ],
                    [
                        'name' => 'Kurikulum',
                        'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                        'desc' => 'Daftar kurikulum yang dipakai sekolah (K-13, Merdeka Belajar, dll). Kurikulum menjadi referensi saat membuat mata pelajaran.',
                        'badge' => [],
                    ],
                    [
                        'name' => 'Mata Pelajaran',
                        'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01',
                        'desc' => 'Master daftar mata pelajaran. Setiap mapel dikaitkan dengan kurikulum tertentu. Mapel ini digunakan saat menyusun jadwal pelajaran kelas.',
                        'badge' => [],
                    ],
                    [
                        'name' => 'Kelas & Jadwal Pelajaran',
                        'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10',
                        'desc' => 'Buat kelas (7A, 8B, 12AK1, dll) beserta tahun ajaran dan wali kelas yang ditugaskan. Di dalam detail kelas terdapat dua tab:<br>
                                  <strong>• Tab Siswa</strong> — kelola daftar siswa di kelas tersebut.<br>
                                  <strong>• Tab Jadwal Pelajaran</strong> — buat jadwal per hari, jam ke-, mata pelajaran, guru, dan ruangan.',
                        'badge' => ['Tab Siswa','Tab Jadwal'],
                    ],
                    [
                        'name' => 'Data Siswa',
                        'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
                        'desc' => 'Kelola data lengkap siswa: nama, NIS (6 digit), NISN, tempat/tanggal lahir, jenis kelamin, kelas, dan akun login. Halaman detail menampilkan informasi lengkap beserta relasi kelas.',
                        'badge' => ['View','Create','Edit','Delete'],
                    ],
                    [
                        'name' => 'Data Guru',
                        'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                        'desc' => 'Kelola data guru: nama, NIG (4 digit), mata pelajaran yang diajarkan, dan akun login. Guru yang ditunjuk sebagai wali kelas akan muncul di pilihan saat membuat kelas.',
                        'badge' => ['View','Create','Edit','Delete'],
                    ],
                    [
                        'name' => 'Data Orang Tua',
                        'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
                        'desc' => 'Data orang tua/wali siswa. Setiap akun orang tua dihubungkan ke satu data siswa (anaknya), sehingga panel orang tua otomatis menampilkan informasi anak yang benar.',
                        'badge' => ['View','Create','Edit','Delete'],
                    ],
                    [
                        'name' => 'Ruangan',
                        'icon' => 'M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z',
                        'desc' => 'Daftar 22 ruangan tersedia (pre-seeded): RK-7A/7B, RK-8A/8B, RK-9A/9B, RK-10AK/VK/WR, RK-11AK/VK/WR, RK-12AK/VK/WR, LAB-IPA, LAB-KOM1, LAB-KOM2, LAB-BHS, AULA, PERP, LAP. Dapat ditambah sesuai kebutuhan.',
                        'badge' => ['22 Ruangan Default'],
                    ],
                    [
                        'name' => 'Hari Libur + Import API',
                        'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
                        'desc' => 'Kelola hari libur dengan tiga jenis: <strong>Nasional</strong> (dari pemerintah), <strong>Lokal/Daerah</strong>, dan <strong>Kegiatan Sekolah</strong>.
                                  <br><br>
                                  Tombol <strong>"Import dari API"</strong> di halaman list secara otomatis mengambil data hari libur nasional Indonesia dari <em>date.nager.at</em> — pilih tahun, sistem menyimpan tanggal yang belum ada (tidak duplikat).',
                        'badge' => ['Nasional','Lokal','Sekolah','Import API'],
                    ],
                ],
            ],
            [
                'id'      => 'guru',
                'title'   => 'Panel Guru',
                'sub'     => 'Tenaga Pengajar',
                'url'     => '/guru',
                'dot'     => '#2563eb',
                'icon_bg' => '#eff6ff',
                'icon_c'  => '#2563eb',
                'icon_path' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                'desc'    => 'Panel guru menyediakan semua alat yang diperlukan guru untuk mengelola kegiatan belajar-mengajar: jadwal, perangkat ajar, penilaian, absensi, dan komunikasi dengan siswa.',
                'tip'     => 'Semua data di panel ini difilter otomatis berdasarkan akun guru yang login — guru hanya dapat melihat dan mengelola data kelasnya sendiri.',
                'tip_type'=> 'info',
                'features' => [
                    [
                        'name' => 'Jadwal Mengajar',
                        'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
                        'desc' => 'Menampilkan semua jadwal mengajar guru yang sedang login. Data bersifat read-only (hanya bisa dilihat). Tabel diurutkan berdasarkan hari (Senin-Sabtu) dan jam pelajaran.',
                        'badge' => ['Read-only'],
                    ],
                    [
                        'name' => 'Modul Ajar',
                        'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253',
                        'desc' => 'Buat Modul Ajar / RPP melalui <strong>wizard 4 langkah</strong>:<br>
                                  <strong>1. Identitas</strong> — judul, jadwal pelajaran yang diacu, fase, alokasi waktu.<br>
                                  <strong>2. Tujuan & Konteks</strong> — tujuan pembelajaran, kompetensi awal, profil pelajar Pancasila, media/sarana.<br>
                                  <strong>3. Kegiatan & Asesmen</strong> — pendahuluan, kegiatan inti, penutup, asesmen.<br>
                                  <strong>4. Sumber & Berkas</strong> — referensi, file lampiran (PDF, DOCX, dll).',
                        'badge' => ['Wizard 4 Langkah','Upload File'],
                    ],
                    [
                        'name' => 'Tugas (sub-tabel Modul Ajar)',
                        'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2',
                        'desc' => 'Setiap modul ajar memiliki tab Tugas. Tugas dapat berupa: <strong>PR, Ulangan Harian (UH), Kuis, Proyek, Presentasi, Praktikum, UTS, UAS</strong>. Lengkap dengan deadline, nilai maksimal, dan opsional file soal.',
                        'badge' => ['PR','UH','UTS','UAS','Proyek','Kuis'],
                    ],
                    [
                        'name' => 'Input Nilai',
                        'icon' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
                        'desc' => 'Input nilai siswa secara individual. Form bersifat <strong>reaktif bertingkat</strong>:<br>
                                  → Pilih jadwal pelajaran → daftar tugas terfilter otomatis → pilih tugas → daftar siswa muncul sesuai kelas.<br>
                                  Nilai berkisar 0–100 dengan step 0.25. Badge warna: hijau (≥85) / kuning (≥70) / merah (<70).',
                        'badge' => ['Reaktif','0–100'],
                    ],
                    [
                        'name' => 'Input Absensi',
                        'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01',
                        'desc' => 'Rekam kehadiran siswa per jadwal pelajaran dan tanggal. Status: <strong>Hadir / Izin / Sakit / Alpha</strong>. Form autofill tanggal hari ini. Tabel diurutkan terbaru di atas.',
                        'badge' => ['Hadir','Izin','Sakit','Alpha'],
                    ],
                    [
                        'name' => 'Konsultasi Siswa',
                        'icon' => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z',
                        'desc' => 'Terima dan balas pesan konsultasi dari siswa di kelas yang Anda ampu sebagai <strong>wali kelas</strong>.<br>
                                  • Aksi <strong>Tandai Dibaca</strong> — ubah status dari "Menunggu" ke "Dibaca".<br>
                                  • Aksi <strong>Balas</strong> — buka modal, tulis balasan, submit. Status otomatis berubah ke "Dibalas".<br>
                                  • <strong>Badge angka</strong> di menu navigasi menampilkan jumlah pesan yang belum dibaca.',
                        'badge' => ['Menunggu','Dibaca','Dibalas','Badge Notif'],
                    ],
                ],
            ],
            [
                'id'      => 'siswa',
                'title'   => 'Panel Siswa',
                'sub'     => 'Peserta Didik',
                'url'     => '/siswa',
                'dot'     => '#16a34a',
                'icon_bg' => '#f0fdf4',
                'icon_c'  => '#16a34a',
                'icon_path' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
                'desc'    => 'Portal pribadi siswa untuk memantau jadwal, nilai akademik, rekap absensi, daftar tugas yang harus dikerjakan, dan berkomunikasi langsung dengan wali kelas.',
                'tip'     => 'Semua data tampil otomatis sesuai kelas siswa yang login. Siswa tidak dapat mengubah data apapun kecuali mengirim konsultasi.',
                'tip_type'=> 'info',
                'features' => [
                    [
                        'name' => 'Jadwal Pelajaran',
                        'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
                        'desc' => 'Tampilkan jadwal pelajaran kelas sendiri. Diurutkan berdasarkan hari (Senin–Sabtu) lalu jam pelajaran. Menampilkan: mata pelajaran, guru pengampu, ruangan, jam mulai & selesai.',
                        'badge' => ['Read-only'],
                    ],
                    [
                        'name' => 'Nilai',
                        'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                        'desc' => 'Rekap nilai semua tugas dan penilaian. Nilai ditampilkan dengan badge berwarna berdasarkan perolehan:<br>
                                  <strong class="text-green-700">● ≥85</strong> — Sangat Baik (hijau)<br>
                                  <strong class="text-yellow-700">● ≥70</strong> — Baik (kuning)<br>
                                  <strong class="text-red-700">● &lt;70</strong> — Perlu Perbaikan (merah)',
                        'badge' => ['≥85 Hijau','≥70 Kuning','<70 Merah'],
                    ],
                    [
                        'name' => 'Absensi',
                        'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01',
                        'desc' => 'Riwayat kehadiran lengkap dengan tanggal, mata pelajaran, dan status. Dapat difilter berdasarkan bulan dan status (Hadir/Izin/Sakit/Alpha).',
                        'badge' => ['Hadir','Izin','Sakit','Alpha'],
                    ],
                    [
                        'name' => 'Tugas',
                        'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                        'desc' => 'Daftar semua tugas dari seluruh mata pelajaran yang diajarkan di kelas siswa. Tugas diurutkan berdasarkan deadline terdekat. Tugas yang sudah melewati deadline ditandai dengan badge merah.',
                        'badge' => ['Urut Deadline','Merah = Terlambat'],
                    ],
                    [
                        'name' => 'Konsultasi Wali Kelas',
                        'icon' => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z',
                        'desc' => 'Kirim pesan / pertanyaan kepada wali kelas. Isi judul dan pesan, lalu submit. Wali kelas akan menerima notifikasi. Setelah dibalas, tombol <strong>"Lihat Balasan"</strong> muncul di tabel untuk membaca jawaban wali kelas.',
                        'badge' => ['Kirim Pesan','Lihat Balasan'],
                    ],
                    [
                        'name' => 'Learning Pathway',
                        'icon' => 'M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7',
                        'desc' => 'Tampilkan jalur belajar (<em>learning pathway</em>) pribadi berdasarkan stream yang ditetapkan (Akademik / Vokasi / Wirausaha). Timeline 6 semester menampilkan: judul milestone, kompetensi akademik, target karakter, dan tips. Milestone saat ini diberi highlight biru; milestone selesai ditandai centang hijau.',
                        'badge' => ['Timeline 6 Semester','Read-only'],
                    ],
                ],
            ],
            [
                'id'      => 'ortu',
                'title'   => 'Panel Orang Tua',
                'sub'     => 'Wali Murid',
                'url'     => '/ortu',
                'dot'     => '#0891b2',
                'icon_bg' => '#ecfeff',
                'icon_c'  => '#0891b2',
                'icon_path' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
                'desc'    => 'Portal orang tua/wali murid untuk memantau perkembangan akademik dan kehadiran anak secara real-time.',
                'tip'     => 'Akun orang tua hanya dapat melihat data anak yang terhubung saat pendaftaran — tidak dapat melihat data siswa lain.',
                'tip_type'=> 'info',
                'features' => [
                    [
                        'name' => 'Jadwal Anak',
                        'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
                        'desc' => 'Lihat jadwal pelajaran anak, identik dengan yang terlihat oleh siswa sendiri. Berguna untuk memantau hari/jam pelajaran anak di sekolah.',
                        'badge' => ['Read-only'],
                    ],
                    [
                        'name' => 'Nilai Anak',
                        'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                        'desc' => 'Pantau nilai akademik anak per mata pelajaran dan tugas. Warna badge nilai sama dengan yang terlihat oleh siswa.',
                        'badge' => ['Read-only'],
                    ],
                    [
                        'name' => 'Absensi Anak',
                        'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01',
                        'desc' => 'Rekap kehadiran anak di sekolah. Dapat difilter berdasarkan status (Hadir/Izin/Sakit/Alpha). Membantu orang tua memantau kedisiplinan anak.',
                        'badge' => ['Hadir','Izin','Sakit','Alpha'],
                    ],
                    [
                        'name' => 'Konsultasi Anak',
                        'icon' => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z',
                        'desc' => 'Pantau pesan konsultasi yang dikirim anak ke wali kelas beserta balasan dari wali kelas. Tombol "Detail" menampilkan isi pesan dan balasan secara lengkap. Orang tua tidak dapat mengirim pesan sendiri.',
                        'badge' => ['Read-only','Lihat Detail'],
                    ],
                    [
                        'name' => 'Learning Pathway Anak',
                        'icon' => 'M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7',
                        'desc' => 'Lihat jalur belajar anak secara visual — identik dengan yang dilihat siswa namun dengan framing untuk orang tua. Tips di semester aktif ditampilkan sebagai saran cara mendukung anak di rumah. Membantu orang tua memahami target kompetensi dan karakter yang harus dicapai anak tiap semester.',
                        'badge' => ['Read-only','Tips Dukungan'],
                    ],
                ],
            ],
        ];
        @endphp

        @foreach($panels as $panel)
        <section id="{{ $panel['id'] }}">
            <div class="section-card">

                {{-- Header panel --}}
                <div class="section-header" style="background: linear-gradient(135deg,{{ $panel['icon_bg'] }}80,#fff)">
                    <div class="section-icon" style="background:{{ $panel['icon_bg'] }}">
                        <svg class="w-5 h-5" style="color:{{ $panel['icon_c'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $panel['icon_path'] }}"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-2">
                            <h2 class="text-xl font-bold text-slate-800">{{ $panel['title'] }}</h2>
                            <span class="text-xs text-slate-500 bg-slate-100 px-2.5 py-1 rounded-full font-medium">{{ $panel['sub'] }}</span>
                            <code class="text-xs font-mono font-bold px-2.5 py-1 rounded-lg text-white"
                                  style="background:{{ $panel['dot'] }}">{{ $panel['url'] }}</code>
                        </div>
                        <p class="text-slate-500 text-sm mt-1.5 leading-relaxed">{{ $panel['desc'] }}</p>
                    </div>
                </div>

                <div class="section-body space-y-5">

                    {{-- Tip --}}
                    @if($panel['tip_type'] === 'warning')
                    <div class="tip" style="background:#fff7ed; border-color:#f97316; color:#7c2d12">
                        <strong style="color:#c2410c">⚠ Perhatian:</strong> {{ $panel['tip'] }}
                    </div>
                    @else
                    <div class="tip">
                        <strong>💡 Info:</strong> {{ $panel['tip'] }}
                    </div>
                    @endif

                    {{-- Feature grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($panel['features'] as $i => $feat)
                        <div class="feat">
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5"
                                     style="background:{{ $panel['icon_bg'] }}">
                                    <svg class="w-4 h-4" style="color:{{ $panel['icon_c'] }}"
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $feat['icon'] }}"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-start justify-between gap-2 flex-wrap">
                                        <p class="feat-title">{{ $feat['name'] }}</p>
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($feat['badge'] as $b)
                                            <span class="text-xs font-semibold px-1.5 py-0.5 rounded-md text-white"
                                                  style="background:{{ $panel['dot'] }}; opacity:.85">{{ $b }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <p class="feat-desc mt-1">{!! $feat['desc'] !!}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </section>
        @endforeach

        {{-- ══ DATABASE ══ --}}
        <section id="database">
            <div class="section-card">
                <div class="section-header">
                    <div class="section-icon" style="background:#fefce8">
                        <svg class="w-5 h-5" style="color:#ca8a04" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582 4-8 4m16 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-800">Struktur Database</h2>
                        <p class="text-slate-500 text-sm mt-0.5">16 tabel utama yang membentuk sistem SIMANIS.</p>
                    </div>
                </div>
                <div class="section-body">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                        @foreach([
                            ['t'=>'users','g'=>'Autentikasi','d'=>'Akun login semua pengguna (semua peran)','c'=>'#7c3aed'],
                            ['t'=>'students','g'=>'Pengguna','d'=>'Data siswa: NIS (6 digit), kelas, user_id','c'=>'#16a34a'],
                            ['t'=>'teachers','g'=>'Pengguna','d'=>'Data guru: NIG (4 digit), user_id','c'=>'#2563eb'],
                            ['t'=>'ortus','g'=>'Pengguna','d'=>'Data orang tua: NIO (5 digit), student_id, user_id','c'=>'#0891b2'],
                            ['t'=>'tahun_ajarans','g'=>'Akademik','d'=>'Tahun ajaran aktif/non-aktif','c'=>'#4f46e5'],
                            ['t'=>'kurikulums','g'=>'Akademik','d'=>'Kurikulum (K-13, Merdeka, dll)','c'=>'#4f46e5'],
                            ['t'=>'mata_pelajarans','g'=>'Akademik','d'=>'Master mata pelajaran per kurikulum','c'=>'#4f46e5'],
                            ['t'=>'kelas','g'=>'Akademik','d'=>'Kelas per tahun ajaran & wali kelas','c'=>'#4f46e5'],
                            ['t'=>'ruangans','g'=>'Akademik','d'=>'22 ruangan (kelas & lab)','c'=>'#4f46e5'],
                            ['t'=>'jadwal_pelajarans','g'=>'Akademik','d'=>'Jadwal per kelas, hari, jam, guru, ruang','c'=>'#4f46e5'],
                            ['t'=>'modul_ajars','g'=>'Pembelajaran','d'=>'Modul Ajar / RPP per guru & jadwal','c'=>'#2563eb'],
                            ['t'=>'tugas','g'=>'Pembelajaran','d'=>'Tugas / penilaian dari modul ajar','c'=>'#2563eb'],
                            ['t'=>'nilais','g'=>'Evaluasi','d'=>'Nilai siswa per tugas, jadwal, guru','c'=>'#dc2626'],
                            ['t'=>'absensis','g'=>'Evaluasi','d'=>'Absensi siswa per jadwal & tanggal','c'=>'#dc2626'],
                            ['t'=>'konsultasis','g'=>'Komunikasi','d'=>'Pesan konsultasi siswa ↔ wali kelas','c'=>'#059669'],
                            ['t'=>'hari_liburs','g'=>'Kalender','d'=>'Hari libur nasional / lokal / sekolah','c'=>'#ca8a04'],
                        ] as $t)
                        <div class="db-table">
                            <div>
                                <div class="db-pill" style="background:{{ $t['c'] }}1a; color:{{ $t['c'] }}">{{ $t['t'] }}</div>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-wide mb-0.5">{{ $t['g'] }}</p>
                                <p class="text-slate-600 text-xs">{{ $t['d'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- ══ ALUR SISTEM ══ --}}
        <section id="alur">
            <div class="section-card">
                <div class="section-header">
                    <div class="section-icon" style="background:#fff1f2">
                        <svg class="w-5 h-5" style="color:#e11d48" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-800">Alur Penggunaan Sistem</h2>
                        <p class="text-slate-500 text-sm mt-0.5">Urutan langkah yang disarankan saat pertama kali menggunakan SIMANIS.</p>
                    </div>
                </div>
                <div class="section-body">
                    <div class="space-y-3">
                        @foreach([
                            ['n'=>'1','title'=>'Setup Awal (Admin)','steps'=>['Buat akun pengguna untuk staf akademik','Atur role & permissions via Shield','Uji akses dengan Impersonate'],'c'=>'#7c3aed','bg'=>'#f3f0ff'],
                            ['n'=>'2','title'=>'Data Master (Akademik)','steps'=>['Buat Kurikulum & Mata Pelajaran','Buat Tahun Ajaran aktif','Input data Ruangan (atau gunakan 22 ruangan default)','Daftarkan data Guru & Siswa + buat akun login'],'c'=>'#4f46e5','bg'=>'#eef2ff'],
                            ['n'=>'3','title'=>'Struktur Kelas & Jadwal (Akademik)','steps'=>['Buat Kelas dan tunjuk Wali Kelas','Tambahkan Siswa ke kelas via tab Siswa','Buat Jadwal Pelajaran via tab Jadwal di masing-masing kelas','Import / tambahkan Hari Libur'],'c'=>'#2563eb','bg'=>'#eff6ff'],
                            ['n'=>'4','title'=>'Kegiatan Mengajar (Guru)','steps'=>['Login ke panel Guru (/guru)','Cek jadwal mengajar di menu Jadwal Mengajar','Buat Modul Ajar untuk setiap mata pelajaran','Tambahkan Tugas di dalam Modul Ajar','Input Nilai & Absensi siswa setelah KBM'],'c'=>'#059669','bg'=>'#f0fdf4'],
                            ['n'=>'5','title'=>'Pantau & Komunikasi (Siswa & Orang Tua)','steps'=>['Siswa login ke /siswa untuk cek jadwal, nilai, absensi, tugas','Siswa kirim konsultasi ke wali kelas jika ada pertanyaan','Guru membalas konsultasi dari panel Guru','Orang tua login ke /ortu untuk pantau semua perkembangan anak'],'c'=>'#0891b2','bg'=>'#ecfeff'],
                        ] as $step)
                        <div class="rounded-xl border p-5 space-y-3"
                             style="background:{{ $step['bg'] }}80; border-color:{{ $step['c'] }}30">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-white font-bold text-sm flex-shrink-0"
                                     style="background:{{ $step['c'] }}">{{ $step['n'] }}</div>
                                <h3 class="font-bold text-slate-800">{{ $step['title'] }}</h3>
                            </div>
                            <ul class="space-y-1.5 pl-11">
                                @foreach($step['steps'] as $s)
                                <li class="flex items-start gap-2 text-sm text-slate-600">
                                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0" style="color:{{ $step['c'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    {{ $s }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- Footer --}}
        <footer class="text-center pb-6">
            <p class="text-slate-500 text-sm">&copy; {{ date('Y') }} SIMANIS &mdash; Sistem Manajemen Informasi Sekolah</p>
            <p class="text-slate-500 text-sm">All Rights Reserved &mdash; Privacy Policy &mdash; by Ilham Firmansyah </p>
        </footer>

    </main>
</div>

{{-- Active sidebar highlight on scroll --}}
<script>
    const links = document.querySelectorAll('.sidebar-link');
    const sections = document.querySelectorAll('section[id]');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                links.forEach(l => l.classList.remove('active'));
                const active = document.querySelector('.sidebar-link[href="#' + entry.target.id + '"]');
                if (active) active.classList.add('active');
            }
        });
    }, { rootMargin: '-20% 0px -70% 0px' });

    sections.forEach(s => observer.observe(s));
</script>

</body>
</html>
