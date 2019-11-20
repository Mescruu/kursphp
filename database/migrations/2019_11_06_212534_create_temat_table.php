<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTematTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temat', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nazwa');
            $table->string('opis')->nullable();
            $table->string('trescAktualna')->nullable();
            $table->string('trescPoprzednia')->nullable();

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
        Schema::dropIfExists('temat');
    }
}
