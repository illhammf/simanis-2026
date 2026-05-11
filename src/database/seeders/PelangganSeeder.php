<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use Illuminate\Database\Seeder;

class PelangganSeeder extends Seeder
{
    public function run(): void
    {
        Pelanggan::create([
            'nama'    => 'Ilham Firmansyah',
            'email'   => 'ilham@gmail.com',
            'no_hp'   => '081234567890',
            'alamat'  => 'Tangerang',
        ]);

        Pelanggan::create([
            'nama'    => 'Ahmad Fauzi',
            'email'   => 'fauzi@gmail.com',
            'no_hp'   => '089876543210',
            'alamat'  => 'Jakarta',
        ]);
    }
}