<?php

use Illuminate\Database\Seeder;

class KryteriumTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('kryterium')->insert([
            'trzy' => 50,
            'cztery' => 75,
            'piec' => 100
        ]);
    }
}
