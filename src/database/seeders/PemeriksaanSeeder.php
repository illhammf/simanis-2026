<?php

namespace Database\Seeders;

use App\Models\Pemeriksaan;
use Illuminate\Database\Seeder;

class PemeriksaanSeeder extends Seeder
{
    public function run(): void
    {
        Pemeriksaan::create([
            'pasien_id' => 1,
            'dokter_id' => 1,
            'tanggal_periksa' => now(),
            'keluhan' => 'Demam dan batuk',
            'status' => 'diperiksa',
        ]);

        Pemeriksaan::create([
            'pasien_id' => 2,
            'dokter_id' => 2,
            'tanggal_periksa' => now(),
            'keluhan' => 'Sakit kepala',
            'status' => 'menunggu',
        ]);
    }
}