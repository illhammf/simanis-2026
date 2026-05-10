<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->comment('Contoh: 7A, 10 Vokasi 1');
            $table->enum('jenjang', ['SMP', 'SMA']);
            $table->enum('tingkat', ['7', '8', '9', '10', '11', '12']);
            $table->foreignId('stream_id')->nullable()->constrained('streams')->nullOnDelete()->comment('Null untuk kelas SMP');
            $table->foreignId('tahun_ajaran_id')->constrained('tahun_ajarans')->cascadeOnDelete();
            $table->foreignId('wali_kelas_id')->nullable()->constrained('teachers')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};