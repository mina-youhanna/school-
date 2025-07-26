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
        Schema::create('sunday_classes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('saint_image');
            $table->string('stage');
            $table->string('schedule');
            $table->string('place');
            $table->json('servants');
            $table->integer('registered_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sunday_classes');
    }
};
