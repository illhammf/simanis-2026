<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();

            // relasi ke tabel produks
            $table->foreignId('produk_id')
                ->constrained('produks')
                ->cascadeOnDelete();

            // relasi ke tabel pelanggans
            $table->foreignId('pelanggan_id')
                ->constrained('pelanggans')
                ->cascadeOnDelete();

            $table->date('tanggal_transaksi');

            $table->integer('jumlah');

            // total harga transaksi
            $table->integer('total_harga');

            $table->enum('status', [
                'diproses',
                'selesai',
                'dibatalkan'
            ])->default('diproses');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};