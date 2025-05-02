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
        Schema::create('opening_moves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('opening_id')->constrained()->onDelete('cascade');
            $table->string('from_position', 2); 
            $table->string('to_position', 2);  
            $table->integer('piece_number'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opening_moves');
    }
};
