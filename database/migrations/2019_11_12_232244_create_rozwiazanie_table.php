<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRozwiazanieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rozwiazanie', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idZadanie');
            $table->integer('idUzytkownik');
            $table->string('sciezka');
            $table->string('informacje');
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
        Schema::dropIfExists('rozwiazanie');
    }
}
