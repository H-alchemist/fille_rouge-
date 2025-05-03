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
        Schema::create('endgame_tactics_moves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tactic_id')->constrained('endgame_tactics')->onDelete('cascade');
            $table->string('from_position'); // e.g. '6,4'
            $table->string('to_position');   // e.g. '4,4'
            $table->integer('piece_number'); // piece using same encoding as before
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('endgame_tactics_moves');
    }
};
