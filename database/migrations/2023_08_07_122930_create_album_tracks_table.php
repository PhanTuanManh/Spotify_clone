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
        //
        Schema::create('track_album', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('track_id')->unsigned();
            $table->integer('album_id')->unsigned();
            $table->timestamps();


            $table->foreign('track_id')->references('Track_id')->on('tracks')->onDelete('cascade');
            $table->foreign('album_id')->references('Album_id')->on('albums')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('track_album');
    }
};
