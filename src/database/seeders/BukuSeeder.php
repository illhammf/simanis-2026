<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        Buku::create([
            'judul' => 'Pemrograman Laravel',
            'penulis' => 'Ilham Firmansyah',
            'penerbit' => 'Informatika',
            'tahun_terbit' => 2025,
            'stok' => 10,
        ]);

        Buku::create([
            'judul' => 'Basis Data MySQL',
            'penulis' => 'Budi Santoso',
            'penerbit' => 'Gramedia',
            'tahun_terbit' => 2023,
            'stok' => 5,
        ]);
    }
}