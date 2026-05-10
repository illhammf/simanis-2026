<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kurikulums', function (Blueprint $table) {
            $table->id();
            $table->string('nama');                                          // e.g. "Kurikulum Merdeka"
            $table->enum('jenjang', ['SMP', 'SMA']);
            $table->enum('fase', ['D', 'E', 'F']);                          // D=SMP, E=SMA X, F=SMA XI-XII
            $table->year('tahun_mulai')->nullable();
            $table->text('deskripsi')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kurikulums');
    }
};