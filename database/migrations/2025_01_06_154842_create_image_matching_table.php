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
        Schema::create('image_matching', function (Blueprint $table) {
            $table->id();
            $table->string('image'); // Path to the image
            $table->string('category'); // The category the image should belong to (Recycle, Hazardous, Re-use)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_matching');
    }
};
