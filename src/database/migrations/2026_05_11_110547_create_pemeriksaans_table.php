<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pemeriksaans', function (Blueprint $table) {
            $table->id();
                
            $table->foreignId('pasien_id')
            ->constrained('pasiens')
            ->cascadeOnDelete();

            $table->foreignId('dokter_id')
            ->constrained('dokters')
            ->cascadeOnDelete();

            $table->date('tanggal_periksa');
            $table->text('keluhan');
            $table->enum('status', ['menunggu', 'diperiksa', 'selesai'])->default('menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaans');
    }
};
