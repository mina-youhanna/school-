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
        Schema::create('hymns', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('image_url')->nullable();
            $table->text('breadcrumb')->nullable(); // يمكنك تخزينها كنص JSON أو نص عادي
            $table->longText('arabic')->nullable();
            $table->longText('coptic')->nullable();
            $table->longText('coptic_ar')->nullable();
            $table->string('source')->nullable();
            $table->string('url')->nullable();
            $table->string('audio_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->longText('notation_text')->nullable();
            $table->string('notation_image_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hymns');
    }
};
