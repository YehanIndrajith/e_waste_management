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
        Schema::create('quiz_1_results', function (Blueprint $table) {
            $table->id();
            $table->string('username'); // Store the username
            $table->string('level'); // Knowledge level (Beginner, Intermediate, Pro)
            $table->integer('marks'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_1_results');
    }
};
