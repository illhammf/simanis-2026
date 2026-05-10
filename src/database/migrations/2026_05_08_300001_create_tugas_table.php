<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('modul_ajar_id')->constrained('modul_ajars')->cascadeOnDelete();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->enum('tipe', [
                'tugas_harian',
                'pr',
                'kuis',
                'ulangan_harian',
                'pts',
                'pas',
                'proyek',
            ])->default('tugas_harian')->comment('Jenis tugas/penilaian');
            $table->date('tanggal_mulai')->nullable();
            $table->date('deadline')->nullable()->comment('Batas pengumpulan');
            $table->integer('alokasi_waktu')->nullable()->comment('Durasi pengerjaan dalam menit');
            $table->integer('nilai_maksimal')->default(100);
            $table->integer('bobot')->nullable()->comment('Bobot penilaian dalam persen, mis. 30');
            $table->longText('instruksi')->nullable()->comment('Petunjuk pengerjaan');
            $table->string('file_soal')->nullable()->comment('Upload file soal PDF/DOCX');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};