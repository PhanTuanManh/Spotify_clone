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
        Schema::create('likes', function (Blueprint $table) {
            $table->integer('User_id')->unsigned();
            $table->integer('Song_id')->unsigned();
            $table->primary(['User_id', 'Song_id']);
            $table->foreign('User_id')->references('User_id')->on('users')->onDelete('cascade');
            $table->foreign('Song_id')->references('Song_id')->on('songs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
