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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('nisn', 10)->unique()->nullable();
            $table->string('nis', 15)->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password');

            //relation
            $table->foreignId('tingkat_id')->constrained('tingkat');
            $table->foreignId('jurusan_id')->nullable()->constrained('jurusan')->nullOnDelete();
            $table->foreignId('kelas_id')->nullable()->constrained('kelas')->nullOnDelete();
            $table->foreignId('tahun_ajaran_id')->nullable()->constrained('tahun_ajaran');

            //dynamic Schema
            $table->enum('status_siswa', ['aktif', 'nonaktif', 'lulus', 'drop'])->default('aktif');
            $table->decimal('nilai_rapor', 4, 2)->nullable();
            $table->string('prestasi');
            $table->date('tanggal_lulus')->nullable();
            $table->text('alasan_drop')->nullable();
            $table->date('tanggal_drop')->nullable();
            $table->enum('jalur_masuk', ['reguler', 'mutasi', 'prestasi'])->default('reguler');
            $table->string('asal_sekolah')->nullable();
            $table->string('surat_mutasi')->nullable();
            $table->decimal('nilai_prestasi', 5, 2)->nullable();
            $table->string('jenis_prestasi')->nullable();
            $table->boolean('is_yatim_piatu')->default(false);

            //upload
            $table->string('foto')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
