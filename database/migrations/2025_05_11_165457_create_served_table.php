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
        Schema::create('served', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('whatsapp');
            $table->string('relative_phone');
            $table->string('address');
            $table->string('confession_father');
            $table->date('dob');
            $table->unsignedTinyInteger('age');
            $table->enum('gender', ['ذكر', 'أنثى']);
            $table->string('my_class');
            $table->boolean('is_deacon')->default(false);
            $table->date('ordination_date')->nullable();
            $table->string('ordination_bishop')->nullable();
            $table->string('deacon_rank')->nullable();
            $table->string('code')->unique();
            $table->string('profile_image')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('served');
    }
};
