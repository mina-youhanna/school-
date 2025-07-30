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
        Schema::table('attendance', function (Blueprint $table) {
            $table->boolean('tasbeha')->default(false)->after('is_present');
            $table->boolean('mass')->default(false)->after('tasbeha');
            $table->boolean('class_attendance')->default(false)->after('mass');
            $table->boolean('church_education')->default(false)->after('class_attendance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendance', function (Blueprint $table) {
            $table->dropColumn(['tasbeha', 'mass', 'class_attendance', 'church_education']);
        });
    }
};
