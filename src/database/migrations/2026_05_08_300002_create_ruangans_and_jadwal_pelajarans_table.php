<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ruangans', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 20)->unique()->comment('e.g. RK-01, LAB-IPA');
            $table->string('nama');
            $table->enum('jenis', [
                'kelas',
                'lab_ipa',
                'lab_komputer',
                'lab_bahasa',
                'aula',
                'perpustakaan',
                'lapangan',
                'lainnya',
            ])->default('kelas');
            $table->integer('kapasitas')->default(32);
            $table->string('gedung')->nullable()->comment('Gedung / Blok, e.g. Gedung A');
            $table->string('lantai')->nullable()->comment('e.g. Lantai 1, Lantai 2');
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
        });

        Schema::create('jadwal_pelajarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tahun_ajaran_id')->constrained('tahun_ajarans')->cascadeOnDelete();
            $table->foreignId('kelas_id')->constrained('kelas')->cascadeOnDelete();
            $table->foreignId('mata_pelajaran_id')->constrained('mata_pelajarans')->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained('teachers')->cascadeOnDelete();
            $table->foreignId('ruangan_id')->nullable()->constrained('ruangans')->nullOnDelete();
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']);
            $table->tinyInteger('jam_ke')->comment('Jam pelajaran ke berapa (1-10)');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_pelajarans');
        Schema::dropIfExists('ruangans');
    }
};