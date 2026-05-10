<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $sadmin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            ['name' => 'Super Admin', 'password' => Hash::make('password')]
        );
        $sadmin->assignRole('super_admin');

        // username = NIA (3 digit)
        $akademik = User::updateOrCreate(
            ['email' => 'adm@admin.com'],
            ['name' => 'Staff Akademik', 'username' => 'NIA-001', 'password' => Hash::make('password')]
        );
        $akademik->assignRole('akademik');

        // username = NIG (4 digit)
        $guru = User::updateOrCreate(
            ['email' => 'guru@admin.com'],
            ['name' => 'Budi Santoso', 'username' => 'NIG-0001', 'password' => Hash::make('password')]
        );
        $guru->assignRole('guru');

        // username = NIG (4 digit)
        $waliKelas = User::updateOrCreate(
            ['email' => 'walikelas@admin.com'],
            ['name' => 'Siti Rahayu', 'username' => 'NIG-0002', 'password' => Hash::make('password')]
        );
        $waliKelas->assignRole('wali_kelas');

        // username = NIS (6 digit)
        $siswa = User::updateOrCreate(
            ['email' => 'siswa@admin.com'],
            ['name' => 'Ilham Firmansyah', 'username' => 'NIS-000001', 'password' => Hash::make('password')]
        );
        $siswa->assignRole('siswa');

        // username = NIO (5 digit)
        $ortu = User::updateOrCreate(
            ['email' => 'ortu@admin.com'],
            ['name' => 'Hendra Wijaya', 'username' => 'NIO-00001', 'password' => Hash::make('password')]
        );
        $ortu->assignRole('orang_tua');
    }
}
