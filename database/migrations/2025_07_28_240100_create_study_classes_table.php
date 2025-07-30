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
        Schema::create('study_classes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('stage');
            $table->string('schedule');
            $table->string('place');
            $table->string('main_servant_email');
            $table->text('assistant_servants_emails')->nullable();
            $table->string('saint_image')->nullable();
            $table->enum('gender', ['ذكر', 'أنثى', 'مختلط']);
            $table->integer('students_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('study_classes');
    }
};
