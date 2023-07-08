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
        Schema::create('tracks', function (Blueprint $table) {
            $table->increments('Track_id');
            $table->integer('Album_id')->unsigned();
            $table->string('Name');
            $table->string('Thumbnail');
            $table->timestamps();

            $table->foreign('Album_id')->references('Album_id')->on('albums')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracks');
    }
};
