<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUzytkownikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uzytkownik', function (Blueprint $table) {
            $table->increments('id');
            $table->string('imie');
            $table->string('nazwisko');
            $table->integer('nrAlbumu')->unique();
            $table->string('email')->unique();
            $table->string('haslo');
            $table->integer('idGrupa');
            $table->string('typ');
            $table->rememberToken();
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
        Schema::dropIfExists('uzytkownik');
    }
}