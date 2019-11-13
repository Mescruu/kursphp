<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePunktyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('punkty', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idStudent');
            $table->integer('idNauczyciel');
            $table->integer('ilosc');
            $table->string('komentarz');
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
        Schema::dropIfExists('punkty');
    }
}
