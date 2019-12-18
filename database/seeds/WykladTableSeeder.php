<?php

use Illuminate\Database\Seeder;

class PunktyTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('wyklad')->insert([
            'id' => 1,
            'idTemat' => 1,
            'tytul' => 'Wykład 1',
        ]);
    }
}
