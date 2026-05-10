<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel Hari Libur
        Schema::create('hari_liburs', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->unique();
            $table->string('nama', 150);
            $table->enum('jenis', ['nasional', 'lokal', 'sekolah'])->default('nasional');
            $table->string('keterangan', 255)->nullable();
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
        });

        // Tabel Konsultasi
        Schema::create('konsultasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')
                  ->constrained('students')->cascadeOnDelete();
            $table->foreignId('teacher_id')
                  ->constrained('teachers')->cascadeOnDelete();
            $table->string('judul', 200);
            $table->text('pesan');
            $table->text('balasan')->nullable();
            $table->enum('status', ['pending', 'dibaca', 'dibalas'])->default('pending');
            $table->timestamp('dibalas_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konsultasis');
        Schema::dropIfExists('hari_liburs');
    }
};