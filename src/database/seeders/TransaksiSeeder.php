<?php

namespace Database\Seeders;

use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        $produk = Produk::first();
        $pelanggan = Pelanggan::first();

        Transaksi::create([
            'produk_id'          => $produk->id,
            'pelanggan_id'       => $pelanggan->id,
            'tanggal_transaksi'  => now(),
            'jumlah'             => 2,
            'total_harga'        => $produk->harga * 2,
            'status'             => 'diproses',
        ]);
    }
}