<?php

namespace Database\Seeders;

use App\Models\Dokter;
use Illuminate\Database\Seeder;

class DokterSeeder extends Seeder
{
    public function run(): void
    {
        Dokter::create([
            'nama' => 'Dr. Budi',
            'spesialis' => 'Penyakit Dalam',
            'no_hp' => '081111111111',
            'email' => 'budi@rs.com',
        ]);

        Dokter::create([
            'nama' => 'Dr. Sinta',
            'spesialis' => 'Anak',
            'no_hp' => '082222222222',
            'email' => 'sinta@rs.com',
        ]);
    }
}