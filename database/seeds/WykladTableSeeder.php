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
        
        DB::table('wyklad')->insert([
            'id' => 2,
            'idTemat' => 2,
            'tytul' => 'Wyklad 2',
        ]);
        
        DB::table('wyklad')->insert([
            'id' => 3,
            'idTemat' => 3,
            'tytul' => 'Wyklad 3',
        ]);
        
        DB::table('wyklad')->insert([
            'id' => 4,
            'idTemat' => 4,
            'tytul' => 'Wyklad 4',
        ]);
        
        DB::table('wyklad')->insert([
            'id' => 5,
            'idTemat' => 5,
            'tytul' => 'Wyklad 5',
        ]);
    }
}
