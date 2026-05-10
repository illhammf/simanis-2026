<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('akademik_staffs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('nia')->unique(); // Nomor Induk Akademik
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('jabatan')->nullable(); // mis: Kepala Akademik, Staff Akademik
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('akademik_staffs');
    }
};