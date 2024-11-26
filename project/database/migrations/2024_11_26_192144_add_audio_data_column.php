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
        Schema::table('sounds', function (Blueprint $table) {
            $table->binary('audio_data')->nullable(); // blobの代わりにbinaryを使用
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sounds', function (Blueprint $table) {
            $table->dropColumn('audio_data');
        });
    }
};
