<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ortus', function (Blueprint $table) {
            // Relasi ke akun user
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete()->after('id');
            // NIO — Nomor Induk Orang Tua (kode internal sekolah)
            $table->string('nio')->nullable()->unique()->after('user_id');
            // Relasi ke siswa
            $table->foreignId('student_id')->nullable()->constrained('students')->nullOnDelete()->after('nio');
            // email → contact (bukan login), tetap ada
        });
    }

    public function down(): void
    {
        Schema::table('ortus', function (Blueprint $table) {
            $table->dropForeign(['user_id', 'student_id']);
            $table->dropColumn(['user_id', 'nio', 'student_id']);
        });
    }
};