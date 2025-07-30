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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('password_plain')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('relative_phone')->nullable();
            $table->text('address')->nullable();
            $table->string('confession_father')->nullable();
            $table->date('dob')->nullable();
            $table->enum('gender', ['ذكر', 'أنثى'])->nullable();
            $table->enum('role', ['admin', 'خادم', 'مخدوم'])->default('مخدوم');
            $table->boolean('is_main_servant')->default(false);
            $table->json('serving_classes')->nullable();
            $table->string('my_class')->nullable();
            $table->boolean('is_deacon')->default(false);
            $table->date('ordination_date')->nullable();
            $table->string('ordination_bishop')->nullable();
            $table->string('deacon_rank')->nullable();
            $table->string('code')->unique()->nullable();
            $table->string('profile_image')->nullable();
            $table->integer('score')->default(0);
            $table->boolean('is_admin')->default(false);
            $table->string('full_name_en')->nullable();
            $table->string('promotion_rank')->nullable();
            $table->date('promotion_date')->nullable();
            $table->string('promotion_by')->nullable();
            $table->string('last_degree')->nullable();
            $table->string('job')->nullable();
            $table->string('national_id', 14)->nullable()->unique();
            $table->string('username')->unique()->nullable();
            $table->timestamp('last_profile_update')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
