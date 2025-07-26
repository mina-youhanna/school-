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
        Schema::create('katamars_readings', function (Blueprint $table) {
            $table->id();
            $table->date('gregorian_date'); // التاريخ الميلادي
            $table->string('coptic_date');  // التاريخ القبطي (مثلاً: 10 أبيب)
            $table->longText('vesper_prayer')->nullable();
            $table->longText('morning_prayer')->nullable();
            $table->longText('polis')->nullable();
            $table->longText('apraksees')->nullable();
            $table->longText('kathilycon')->nullable();
            $table->longText('gospel')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('katamars_readings');
    }
};
