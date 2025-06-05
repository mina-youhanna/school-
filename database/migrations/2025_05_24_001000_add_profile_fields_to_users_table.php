<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('national_id')->unique()->nullable();
            $table->string('full_name_en')->nullable();
            $table->string('promotion_rank')->nullable();
            $table->date('promotion_date')->nullable();
            $table->string('promotion_by')->nullable();
            $table->string('last_degree')->nullable();
            $table->string('job')->nullable();
            $table->boolean('is_graduate')->default(false);
            $table->timestamp('last_profile_update')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'national_id',
                'full_name_en',
                'promotion_rank',
                'promotion_date',
                'promotion_by',
                'last_degree',
                'job',
                'is_graduate',
                'last_profile_update',
            ]);
        });
    }
}; 