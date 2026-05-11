<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        Mahasiswa::create([
            'nama' => 'Ilham Firmansyah',
            'nim' => '2024080110',
            'jurusan' => 'Teknik Informatika',
            'alamat' => 'Tangerang',
            'no_hp' => '081234567890',
        ]);

        Mahasiswa::create([
            'nama' => 'Zahwa Auliya',
            'nim' => '2024080111',
            'jurusan' => 'Sistem Informasi',
            'alamat' => 'Jakarta',
            'no_hp' => '089876543210',
        ]);
    }
}