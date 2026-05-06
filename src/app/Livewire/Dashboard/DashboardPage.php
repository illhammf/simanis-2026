<?php

namespace App\Livewire\Dashboard;

use App\Support\PanelResolver;
use Livewire\Component;

class DashboardPage extends Component
{
    /**
     * Modules available per role.
     * Each entry: ['label', 'description', 'icon', 'url', 'color']
     */
    protected static array $modules = [
        'super_admin' => [
            [
                'label'       => 'Panel Admin',
                'description' => 'Kelola data pengguna, hak akses, dan konfigurasi sistem.',
                'icon'        => 'shield-check',
                'url'         => '/admin',
                'color'       => 'blue',
            ],
            [
                'label'       => 'Panel Akademik',
                'description' => 'Kelola data akademik, jadwal, dan kurikulum.',
                'icon'        => 'academic-cap',
                'url'         => '/adm',
                'color'       => 'amber',
            ],
            [
                'label'       => 'Panel Guru',
                'description' => 'Kelola nilai, absensi, dan materi pembelajaran.',
                'icon'        => 'book-open',
                'url'         => '/guru',
                'color'       => 'green',
            ],
            [
                'label'       => 'Panel Siswa',
                'description' => 'Lihat jadwal, nilai, dan informasi akademik siswa.',
                'icon'        => 'user-group',
                'url'         => '/siswa',
                'color'       => 'purple',
            ],
            [
                'label'       => 'Panel Orang Tua',
                'description' => 'Pantau perkembangan dan informasi anak.',
                'icon'        => 'home',
                'url'         => '/ortu',
                'color'       => 'rose',
            ],
        ],
        'akademik' => [
            [
                'label'       => 'Panel Akademik',
                'description' => 'Kelola data akademik, jadwal, dan kurikulum.',
                'icon'        => 'academic-cap',
                'url'         => '/adm',
                'color'       => 'amber',
            ],
        ],
        'guru' => [
            [
                'label'       => 'Kelas Saya',
                'description' => 'Lihat daftar kelas yang Anda ampu.',
                'icon'        => 'book-open',
                'url'         => '/guru',
                'color'       => 'green',
            ],
        ],
        'siswa' => [
            [
                'label'       => 'Akademik Saya',
                'description' => 'Lihat jadwal, nilai, dan absensi Anda.',
                'icon'        => 'clipboard-document-list',
                'url'         => '/siswa',
                'color'       => 'purple',
            ],
        ],
        'orang_tua' => [
            [
                'label'       => 'Perkembangan Anak',
                'description' => 'Pantau nilai, absensi, dan informasi anak Anda.',
                'icon'        => 'home',
                'url'         => '/ortu',
                'color'       => 'rose',
            ],
        ],
    ];

    public function mount(): void
    {
        if (! auth()->check()) {
            redirect()->route('login');
        }
    }

    public function getModulesProperty(): array
    {
        $role = auth()->user()->getRoleNames()->first() ?? '';

        return static::$modules[$role] ?? [];
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard-page')
            ->layout('layouts.dashboard');
    }
}