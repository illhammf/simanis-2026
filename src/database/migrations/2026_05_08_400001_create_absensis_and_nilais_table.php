<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel Absensi
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')
                  ->constrained('students')->cascadeOnDelete();
            $table->foreignId('jadwal_pelajaran_id')
                  ->constrained('jadwal_pelajarans')->cascadeOnDelete();
            $table->date('tanggal');
            $table->enum('status', ['hadir', 'izin', 'sakit', 'alpha'])->default('hadir');
            $table->string('keterangan', 255)->nullable();
            $table->timestamps();

            $table->unique(['student_id', 'jadwal_pelajaran_id', 'tanggal'], 'absensi_unique');
        });

        // Tabel Nilai
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')
                  ->constrained('students')->cascadeOnDelete();
            $table->foreignId('tugas_id')
                  ->constrained('tugas')->cascadeOnDelete();
            $table->foreignId('jadwal_pelajaran_id')
                  ->constrained('jadwal_pelajarans')->cascadeOnDelete();
            $table->foreignId('teacher_id')
                  ->constrained('teachers')->cascadeOnDelete();
            $table->decimal('nilai', 5, 2)->nullable()->comment('0–100');
            $table->string('keterangan', 255)->nullable();
            $table->timestamps();

            $table->unique(['student_id', 'tugas_id'], 'nilai_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilais');
        Schema::dropIfExists('absensis');
    }
};