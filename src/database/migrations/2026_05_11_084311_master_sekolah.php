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
        //
        Schema::create ('tingkat', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 5)->unique();
            $table->string('nama', 50)->unique();
            $table->timestamps();
        });

        Schema::create('jurusan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tingkat_id')->constrained('tingkat')->cascadeOnDelete();
            $table->string('kode', 5)->unique();
            $table->string('nama', 50);
            $table->timestamps();
        });

        // Schema::create('kelas', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('tingkat_id')->constrained('tingkat')->cascadeOnDelete();
        //     $table->foreignId('jurusan_id')->nullable()->constrained('jurusan')->cascadeOnDelete();
        //     $table->string('nama', 20);
        //     $table->integer('kapasitas')->default(30);
        //     $table->boolean('aktif')->default(true);
        //     $table->timestamps();
        // });

        Schema::create('tahun_ajaran', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 20);
            $table->boolean('aktif')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tahun_ajaran');
        Schema::dropIfExists('kelas');
        Schema::dropIfExists('jurusan');
        Schema::dropIfExists('tingkat');
    }
};