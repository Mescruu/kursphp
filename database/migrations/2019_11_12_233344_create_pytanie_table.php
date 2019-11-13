<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePytanieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pytanie', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idQuiz');
            $table->string('tresc');
            $table->string('odpPoprawna');
            $table->string('odpA');
            $table->string('odpB');
            $table->string('odpC');
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
        Schema::dropIfExists('pytanie');
    }
}
