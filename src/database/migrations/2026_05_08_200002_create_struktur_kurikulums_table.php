<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('struktur_kurikulums', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kurikulum_id')->constrained('kurikulums')->cascadeOnDelete();
            $table->foreignId('mata_pelajaran_id')->constrained('mata_pelajarans')->cascadeOnDelete();
            $table->enum('kelompok', [
                'Wajib A',
                'Wajib B',
                'Pilihan',
                'Muatan Lokal',
                'Proyek P5',
                'Vokasional',
            ])->default('Wajib A');
            $table->integer('jam_per_minggu')->default(2);
            $table->enum('semester', ['Ganjil', 'Genap', 'Keduanya'])->default('Keduanya');
            $table->string('kelas')->nullable()->comment('e.g. 7,8,9 atau 10,11,12 atau kosong = semua');
            $table->text('keterangan')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('struktur_kurikulums');
    }
};