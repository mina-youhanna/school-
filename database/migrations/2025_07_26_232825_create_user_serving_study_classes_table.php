<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * اسم الجدول
     */
    protected $tableName = 'user_serving_study_classes';

    /**
     * تشغيل الهجرة - إنشاء جدول العلاقة بين المستخدمين والفصول الدراسية
     */
    public function up(): void
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            // المفتاح الأساسي
            $table->id();
            
            // المفاتيح الأجنبية
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade')
                  ->comment('معرف المستخدم');
                  
            $table->foreignId('class_id')
                  ->constrained('study_classes')
                  ->onDelete('cascade')
                  ->comment('معرف الفصل الدراسي');
            
            // الطوابع الزمنية
            $table->timestamps();
            
            // منع تكرار العلاقة - لا يمكن للمستخدم أن يخدم في نفس الفصل مرتين
            $table->unique(['user_id', 'class_id'], 'user_class_unique');
            
            // إضافة فهارس لتحسين الأداء
            $table->index('user_id', 'idx_user_serving_user_id');
            $table->index('class_id', 'idx_user_serving_class_id');
        });
    }

    /**
     * التراجع عن الهجرة - حذف الجدول
     */
    public function down(): void
    {
        Schema::dropIfExists($this->tableName);
    }
};
