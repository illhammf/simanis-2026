<?php

namespace Database\Seeders;

use App\Models\Pasien;
use Illuminate\Database\Seeder;

class PasienSeeder extends Seeder
{
    public function run(): void
    {
        Pasien::create([
            'nama' => 'Ilham Firmansyah',
            'nik' => '3175090909090001',
            'tanggal_lahir' => '2006-09-09',
            'jenis_kelamin' => 'L',
            'alamat' => 'Tangerang',
            'no_hp' => '081234567890',
        ]);

        Pasien::create([
            'nama' => 'Zahwa Auliya',
            'nik' => '3175090909090002',
            'tanggal_lahir' => '2006-01-01',
            'jenis_kelamin' => 'P',
            'alamat' => 'Jakarta',
            'no_hp' => '089876543210',
        ]);
    }
}