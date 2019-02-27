<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Complaints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('userid');
            $table->string('xcord')->nullable();
            $table->string('ycord')->nullable();
            $table->string('zeitpunkt')->nullable();
            $table->string('parkplatz')->nullable();
            $table->string('grund')->nullable();
            $table->string('tarif')->nullable();
            $table->string('telefon')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('complaints');
    }
}
