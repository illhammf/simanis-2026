<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('capaian_pembelajarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kurikulum_id')->constrained('kurikulums')->cascadeOnDelete();
            $table->foreignId('mata_pelajaran_id')->constrained('mata_pelajarans')->cascadeOnDelete();
            $table->string('elemen')->nullable()->comment('Elemen CP, e.g. Bilangan, Aljabar, Geometri');
            $table->longText('deskripsi_cp');
            $table->string('kode_cp')->nullable()->comment('e.g. CP.MAT.D.1');
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('capaian_pembelajarans');
    }
};