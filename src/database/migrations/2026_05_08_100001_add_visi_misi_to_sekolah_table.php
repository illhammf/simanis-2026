<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sekolah', function (Blueprint $table) {
            $table->text('visi')->nullable()->after('logo');
            $table->text('misi')->nullable()->after('visi');
            $table->text('tujuan')->nullable()->after('misi');
            $table->text('sasaran')->nullable()->after('tujuan');
        });
    }

    public function down(): void
    {
        Schema::table('sekolah', function (Blueprint $table) {
            $table->dropColumn(['visi', 'misi', 'tujuan', 'sasaran']);
        });
    }
};