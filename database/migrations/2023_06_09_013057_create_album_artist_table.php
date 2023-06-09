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
        Schema::create('album_artist', function (Blueprint $table) {
            $table->integer('album_id')->unsigned();
            $table->integer('artist_id')->unsigned();
            $table->timestamps();

            $table->foreign('album_id')->references('Album_id')->on('albums')->onDelete('cascade');
            $table->foreign('artist_id')->references('Artist_id')->on('artists')->onDelete('cascade');

            $table->primary(['album_id', 'artist_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('album_artist');
    }
};
