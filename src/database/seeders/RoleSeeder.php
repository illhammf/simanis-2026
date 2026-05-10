<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'super_admin']);
        Role::firstOrCreate(['name' => 'akademik']);
        Role::firstOrCreate(['name' => 'guru']);
        Role::firstOrCreate(['name' => 'wali_kelas']);
        Role::firstOrCreate(['name' => 'siswa']);
        Role::firstOrCreate(['name' => 'orang_tua']);
    }
}