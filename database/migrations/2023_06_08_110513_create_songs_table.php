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
        Schema::create('songs', function (Blueprint $table) {
            $table->increments('Song_id');
            $table->integer('Genre_id')->unsigned();
            $table->string('Name');
            $table->text('Lyrics');
            $table->string('Song_IMG');
            $table->string('Song_Audio');
            $table->text('Descriptions');
            $table->timestamps();

            $table->foreign('Genre_id')->references('Genre_id')->on('genres')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
