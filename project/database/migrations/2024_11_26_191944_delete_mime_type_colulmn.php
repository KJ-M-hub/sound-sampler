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
            if (Schema::hasColumn('sounds', 'mime_type')) {
                $table->dropColumn('mime_type'); // 既存のカラムを削除
            }
            $table->string('mime_type')->nullable(); // MIMEタイプ用にstring型を使用
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sounds', function (Blueprint $table) {
            $table->dropColumn('mime_type');
        });
    }
};
