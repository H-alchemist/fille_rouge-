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
        Schema::create('moves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partie_id'); 
            $table->string('fromPosition');
            $table->string('toPosition');
            $table->integer('pieceNumber');
            $table->dateTime('timestamp');
            $table->timestamps();
    
            $table->foreign('partie_id')->references('id')->on('parties')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moves');
    }
};
