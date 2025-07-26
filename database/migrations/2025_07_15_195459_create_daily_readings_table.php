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
        Schema::create('daily_readings', function (Blueprint $table) {
            $table->id();
            $table->date('reading_date')->index();
            $table->string('coptic_date')->nullable();
            $table->string('type')->nullable();            // عشية، باكر، قداس...
            $table->string('section_title')->nullable();   // عنوان القسم (مثلاً: المزمور والإنجيل)
            $table->string('reading_title')->nullable();   // عنوان القراءة (مثلاً: متى 5:1-12)
            $table->string('book_translation')->nullable();// اسم السفر (مزامير، مرقس...)
            $table->string('ref')->nullable();             // المرجع (5:1-12)
            $table->text('content')->nullable();           // نص القراءة (كل الآيات أو نص السنكسار)
            $table->text('introduction')->nullable();      // مقدمة القراءة
            $table->text('conclusion')->nullable();        // خاتمة القراءة
            $table->text('html')->nullable();              // نص HTML (لو سنكسار أو غيره)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_readings');
    }
};
