<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stream_milestones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stream_id')->constrained('streams')->cascadeOnDelete();
            $table->tinyInteger('semester'); // 1–6
            $table->string('judul', 200);
            $table->text('deskripsi')->nullable();
            $table->text('kompetensi_akademik')->nullable(); // newline-separated list
            $table->text('target_karakter')->nullable();     // newline-separated list
            $table->text('tips')->nullable();
            $table->boolean('is_aktif')->default(true);
            $table->timestamps();

            $table->unique(['stream_id', 'semester']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stream_milestones');
    }
};