<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoverImageToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //z czym pracyjemy, i co ma się stać
        Schema::table('posts', function ($table){
            $table->string('cover_image');  //dodanie kolumny stringów z nazwami obrazków
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function ($table){
            $table->dropColumn('cover_image');  //dodanie kolumny stringów z nazwami obrazków
        });
    }
}
