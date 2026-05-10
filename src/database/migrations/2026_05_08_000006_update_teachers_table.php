<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            // Rename nip → nig (Nomor Induk Guru — kode internal sekolah)
            $table->renameColumn('nip', 'nig');
            // Relasi ke akun user (untuk plotting user)
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete()->after('id');
            // Data tambahan
            $table->string('phone')->nullable()->after('nig');
            $table->string('alamat')->nullable()->after('phone');
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable()->after('alamat');
        });
    }

    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'phone', 'alamat', 'jenis_kelamin']);
            $table->renameColumn('nig', 'nip');
        });
    }
};