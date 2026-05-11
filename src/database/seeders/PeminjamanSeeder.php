<?php

namespace Database\Seeders;

use App\Models\Peminjaman;
use Illuminate\Database\Seeder;

class PeminjamanSeeder extends Seeder
{
    public function run(): void
    {
        Peminjaman::create([
            'mahasiswa_id' => 1,
            'buku_id' => 1,
            'tanggal_pinjam' => now(),
            'tanggal_kembali' => null,
            'status' => 'dipinjam',
        ]);

        Peminjaman::create([
            'mahasiswa_id' => 2,
            'buku_id' => 2,
            'tanggal_pinjam' => now(),
            'tanggal_kembali' => now(),
            'status' => 'dikembalikan',
        ]);
    }
}