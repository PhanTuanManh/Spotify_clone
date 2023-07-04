<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeLyricColumnToTextInProductTable extends Migration
{
    public function up()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->text('lyric')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->string('lyric')->change();
        });
    }
}
