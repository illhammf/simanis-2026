<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mata_pelajarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kode', 20)->unique();
            $table->enum('jenjang', ['SMP', 'SMA', 'Semua'])->default('Semua')->comment('Jenjang berlaku: SMP / SMA / Semua');
            $table->foreignId('stream_id')->nullable()->constrained('streams')->nullOnDelete()->comment('Null = berlaku semua stream');
            $table->integer('kkm')->default(75)->comment('Kriteria Ketuntasan Minimal');
            $table->integer('jam_per_minggu')->default(2)->comment('Jumlah jam pelajaran per minggu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mata_pelajarans');
    }
};