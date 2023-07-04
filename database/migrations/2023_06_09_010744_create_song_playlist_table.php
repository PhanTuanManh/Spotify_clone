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
        Schema::create('song_playlist', function (Blueprint $table) {
            $table->integer('song_id')->unsigned();
            $table->integer('playlist_id')->unsigned();
            $table->timestamps();

            $table->foreign('Song_id')->references('Song_id')->on('songs')->onDelete('cascade');
            $table->foreign('playlist_id')->references('Playlist_id')->on('playlists')->onDelete('cascade');

            $table->primary(['song_id', 'playlist_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('song_playlist');
    }
};
