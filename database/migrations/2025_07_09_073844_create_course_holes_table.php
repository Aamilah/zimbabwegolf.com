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
        Schema::create('course_holes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_detail_id')->constrained('course_details')->onDelete('cascade');
            $table->integer('hole_number');
            $table->integer('par');
            $table->integer('yardage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_holes');
    }
};
