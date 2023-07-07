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
        Schema::create('album_song', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('song_id')->unsigned();
            $table->integer('album_id')->unsigned();
            $table->timestamps();


            $table->foreign('song_id')->references('Song_id')->on('songs')->onDelete('cascade');
            $table->foreign('album_id')->references('Album_id')->on('albums')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('album_song');
    }
};
