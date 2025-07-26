<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('national_id', 14)->nullable()->unique();
        });

        // تحديث السجلات الموجودة إذا كان هناك بيانات في جدول آخر
        DB::table('users')->whereNull('national_id')->update([
            'national_id' => DB::raw('id') // يمكنك تغيير هذا حسب احتياجاتك
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('national_id');
        });
    }
};
