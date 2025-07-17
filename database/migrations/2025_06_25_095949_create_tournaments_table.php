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
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('tournament_title');
            $table->string('presenter');
            $table->foreignId('course_detail_id')->constrained('course_details')->onDelete('cascade');            
            $table->string('location_code')->nullable();
            $table->date('start_date');
            $table->date('end_date');           
            $table->date('entries_close');
            $table->integer('rounds');
            $table->string('ladies_champ_handicap')->nullable();
            $table->decimal('ladies_champ_fee', 8, 2)->nullable();
            $table->string('ladies_net_handicap')->nullable();
            $table->decimal('ladies_net_fee', 8, 2)->nullable();
            $table->string('men_champ_handicap')->nullable();
            $table->decimal('men_champ_fee', 8, 2)->nullable();
            $table->string('men_net_handicap')->nullable();
            $table->decimal('men_net_fee', 8, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournaments');
    }
};
