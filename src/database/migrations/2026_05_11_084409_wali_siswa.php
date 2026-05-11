<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wali_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_wali');
            $table->string('hubungan_wali');
            $table->string('nik_wali', 16)->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->string('pendidikan_wali')->nullable();
            $table->decimal('penghasilan_wali', 15, 2)->nullable();
            $table->string('no_hp_wali', 20)->nullable();
            $table->text('alamat_wali')->nullable();
            $table->timestamps();
        });

        Schema::table('students', function (Blueprint $table) {
            $table->foreignId('wali_id')
                ->nullable()
                ->constrained('wali_siswa')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropConstrainedForeignId('wali_id');
        });

        Schema::dropIfExists('wali_siswa');
    }
};