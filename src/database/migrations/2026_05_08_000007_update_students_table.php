<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Rename nisn → nis (Nomor Induk Siswa — tingkat sekolah)
            $table->renameColumn('nisn', 'nis');
            // Relasi ke akun user
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete()->after('id');
            // Relasi ke kelas (gantikan field kelas string)
            $table->foreignId('kelas_id')->nullable()->constrained('kelas')->nullOnDelete()->after('user_id');
            // Data tambahan
            $table->date('tanggal_lahir')->nullable()->after('kelas_id');
            $table->string('alamat')->nullable()->after('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable()->after('alamat');
            $table->foreignId('stream_id')->nullable()->constrained('streams')->nullOnDelete()->after('jenis_kelamin');
            // Hapus kolom kelas lama (diganti kelas_id FK)
            $table->dropColumn('kelas');
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('kelas')->default('');
            $table->dropForeign(['user_id', 'kelas_id', 'stream_id']);
            $table->dropColumn(['user_id', 'kelas_id', 'tanggal_lahir', 'alamat', 'jenis_kelamin', 'stream_id']);
            $table->renameColumn('nis', 'nisn');
        });
    }
};