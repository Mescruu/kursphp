<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToPosts extends Migration
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
            $table->integer('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //z czym pracyjemy, i co ma się stać
        Schema::table('posts', function ($table){
            $table->dropColumn('user_id');
        });
    }
}
