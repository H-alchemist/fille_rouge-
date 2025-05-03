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
        Schema::create('endgame_tactics', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', ['middlegame', 'endgame']); // distinguish between the two
            $table->text('starting_position'); // 2D array as JSON string
            $table->text('commentary')->nullable(); // general idea of tactic/strategy
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('endgame_tactics');
    }
};
