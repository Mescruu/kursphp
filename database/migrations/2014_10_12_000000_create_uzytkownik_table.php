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
            $table->string('nazwisko')->nullable();
            $table->integer('nrAlbumu')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('haslo');
            $table->integer('idGrupa')->nullable();
            $table->string('typ')->nullable();
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