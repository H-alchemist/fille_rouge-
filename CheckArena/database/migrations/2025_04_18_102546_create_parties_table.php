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
        Schema::create('parties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('whitePlayer');
            $table->unsignedBigInteger('blackPlayer');
            $table->unsignedBigInteger('winner')->nullable();
            $table->unsignedBigInteger('loser')->nullable();
            $table->string('partieStatus');
            $table->string('timeControl');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parties');
    }
};
