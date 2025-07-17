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
        Schema::create('tee_assignments', function (Blueprint $table) {
            $table->id();     
            $table->foreignId('tournament_id')->constrained('tournaments')->onDelete('cascade');
            $table->integer('match_number');       
            $table->time('tee_time');              
            $table->integer('tee_number');  
            $table->integer('round_number');                
            $table->foreignId('tournament_player_id')->constrained('tournament_players')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tee_assignments');
    }
};
