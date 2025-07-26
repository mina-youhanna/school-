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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'full_name_en')) {
                $table->string('full_name_en')->nullable()->after('full_name');
            }
            if (!Schema::hasColumn('users', 'promotion_rank')) {
                $table->string('promotion_rank')->nullable();
            }
            if (!Schema::hasColumn('users', 'promotion_date')) {
                $table->date('promotion_date')->nullable();
            }
            if (!Schema::hasColumn('users', 'promotion_by')) {
                $table->string('promotion_by')->nullable();
            }
            if (!Schema::hasColumn('users', 'last_degree')) {
                $table->string('last_degree')->nullable();
            }
            if (!Schema::hasColumn('users', 'job')) {
                $table->string('job')->nullable();
            }
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable();
            }
            if (!Schema::hasColumn('users', 'whatsapp')) {
                $table->string('whatsapp')->nullable();
            }
            if (!Schema::hasColumn('users', 'relative_phone')) {
                $table->string('relative_phone')->nullable();
            }
            if (!Schema::hasColumn('users', 'address')) {
                $table->text('address')->nullable();
            }
            if (!Schema::hasColumn('users', 'confession_father')) {
                $table->string('confession_father')->nullable();
            }
            if (!Schema::hasColumn('users', 'is_deacon')) {
                $table->boolean('is_deacon')->default(false);
            }
            if (!Schema::hasColumn('users', 'ordination_date')) {
                $table->date('ordination_date')->nullable();
            }
            if (!Schema::hasColumn('users', 'ordination_bishop')) {
                $table->string('ordination_bishop')->nullable();
            }
            if (!Schema::hasColumn('users', 'deacon_rank')) {
                $table->string('deacon_rank')->nullable();
            }
            if (!Schema::hasColumn('users', 'gender')) {
                $table->string('gender')->nullable();
            }
            if (!Schema::hasColumn('users', 'dob')) {
                $table->date('dob')->nullable();
            }
            if (!Schema::hasColumn('users', 'serving_classes')) {
                $table->string('serving_classes')->nullable();
            }
            if (!Schema::hasColumn('users', 'myClass')) {
                $table->string('myClass')->nullable();
            }
            if (!Schema::hasColumn('users', 'profile_image')) {
                $table->string('profile_image')->nullable();
            }
            if (!Schema::hasColumn('users', 'last_profile_update')) {
                $table->timestamp('last_profile_update')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = [
                'full_name_en',
                'promotion_rank',
                'promotion_date',
                'promotion_by',
                'last_degree',
                'job',
                'phone',
                'whatsapp',
                'relative_phone',
                'address',
                'confession_father',
                'is_deacon',
                'ordination_date',
                'ordination_bishop',
                'deacon_rank',
                'gender',
                'dob',
                'serving_classes',
                'myClass',
                'profile_image',
                'last_profile_update'
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
