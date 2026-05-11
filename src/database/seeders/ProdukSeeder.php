<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        Produk::create([
            'nama_produk' => 'Laptop Asus',
            'kategori'    => 'Elektronik',
            'harga'       => 8500000,
            'stok'        => 10,
        ]);

        Produk::create([
            'nama_produk' => 'Mouse Logitech',
            'kategori'    => 'Aksesoris',
            'harga'       => 250000,
            'stok'        => 25,
        ]);

        Produk::create([
            'nama_produk' => 'Keyboard Mechanical',
            'kategori'    => 'Aksesoris',
            'harga'       => 750000,
            'stok'        => 15,
        ]);
    }
}