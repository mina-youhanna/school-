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
        Schema::create('enhanced_attendance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('class_id')->constrained('study_classes')->onDelete('cascade');
            $table->date('date');
            $table->boolean('is_present')->default(false);
            $table->boolean('mass')->default(false); // القداس
            $table->boolean('tasbeha')->default(false); // التسبحة
            $table->boolean('class_attendance')->default(false); // الفصل
            $table->boolean('church_education')->default(false); // التربية الكنسية
            $table->text('notes')->nullable();
            $table->timestamps();

            // فهرس مركب لمنع تكرار السجل لنفس الطالب في نفس اليوم
            $table->unique(['user_id', 'class_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enhanced_attendance');
    }
};
