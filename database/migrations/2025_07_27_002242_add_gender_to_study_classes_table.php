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
        Schema::table('study_classes', function (Blueprint $table) {
            $table->enum('gender', ['ذكر', 'أنثى', 'مختلط'])->default('ذكر')->after('saint_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('study_classes', function (Blueprint $table) {
            $table->dropColumn('gender');
        });
    }
};
