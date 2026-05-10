<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alur_tujuan_pembelajarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('capaian_pembelajaran_id')->constrained('capaian_pembelajarans')->cascadeOnDelete();
            $table->string('kode_atp')->nullable()->comment('e.g. ATP.MAT.D.1.1');
            $table->text('deskripsi');
            $table->enum('kelas', ['7', '8', '9', '10', '11', '12']);
            $table->enum('semester', ['1', '2']);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alur_tujuan_pembelajarans');
    }
};