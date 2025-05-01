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
            $table->unsignedBigInteger('white_player');
            $table->unsignedBigInteger('black_player');
            $table->unsignedBigInteger('winner')->nullable();
            $table->unsignedBigInteger('loser')->nullable();
            $table->string('partie_status');
            $table->string('time_control');
            $table->timestamps();



            $table->foreign('white_player')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('black_player')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('winner')->references('id')->on('users')->onDelete('set null');
            $table->foreign('loser')->references('id')->on('users')->onDelete('set null');


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
