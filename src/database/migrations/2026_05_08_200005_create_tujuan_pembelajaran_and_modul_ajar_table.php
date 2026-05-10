<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tujuan_pembelajarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alur_tujuan_pembelajaran_id')->constrained('alur_tujuan_pembelajarans')->cascadeOnDelete();
            $table->string('kode_tp')->nullable()->comment('e.g. TP.MAT.D.1.1.1');
            $table->text('deskripsi');
            $table->text('indikator')->nullable()->comment('Indikator pencapaian, pisahkan dengan baris baru');
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        Schema::create('modul_ajars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tujuan_pembelajaran_id')->nullable()->constrained('tujuan_pembelajarans')->nullOnDelete();
            $table->foreignId('kurikulum_id')->constrained('kurikulums')->cascadeOnDelete();
            $table->foreignId('mata_pelajaran_id')->constrained('mata_pelajarans')->cascadeOnDelete();
            $table->string('judul');
            $table->enum('kelas', ['7', '8', '9', '10', '11', '12']);
            $table->enum('semester', ['1', '2']);
            $table->integer('alokasi_waktu')->default(2)->comment('Jumlah JP');
            $table->text('tujuan')->nullable()->comment('Tujuan pembelajaran modul ini');
            $table->text('pemahaman_bermakna')->nullable();
            $table->text('pertanyaan_pemantik')->nullable();
            $table->longText('kegiatan_pembelajaran')->nullable()->comment('Pendahuluan / Inti / Penutup');
            $table->text('asesmen')->nullable()->comment('Asesmen diagnostik, formatif, sumatif');
            $table->text('sumber_belajar')->nullable();
            $table->string('file_modul')->nullable()->comment('Upload file PDF/DOCX');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modul_ajars');
        Schema::dropIfExists('tujuan_pembelajarans');
    }
};