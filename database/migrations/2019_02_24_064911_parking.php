<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Parking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parking', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('userid');
            $table->string('xcord')->nullable();
            $table->string('ycord')->nullable();
            $table->string('parkplatz')->nullable();
            $table->string('strab')->nullable();
            $table->string('haus')->nullable();
            $table->string('plz')->nullable();
            $table->string('ort')->nullable();
            $table->string('image')->nullable();
            $table->string('image_enc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parking');
    }
}
