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
        Schema::create('enhanced_exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('class_id')->constrained('study_classes')->onDelete('cascade');
            $table->string('subject_name'); // اسم المادة
            $table->date('exam_date'); // تاريخ الامتحان
            $table->decimal('score', 5, 2); // الدرجة (يمكن أن تكون أكثر من 100)
            $table->decimal('max_score', 5, 2)->default(100); // الدرجة القصوى
            $table->text('notes')->nullable(); // ملاحظات
            $table->timestamps();

            // فهرس مركب لمنع تكرار السجل لنفس الطالب في نفس المادة في نفس اليوم
            $table->unique(['user_id', 'class_id', 'subject_name', 'exam_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enhanced_exams');
    }
};
