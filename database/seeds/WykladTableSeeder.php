<?php

use Illuminate\Database\Seeder;

class WykladTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wyklad')->insert([
            'id' => 1,
            'idTemat' => 1,
            'tytul' => 'Wyklad 1',
        ]);
    }
}
