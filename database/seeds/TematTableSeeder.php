<?php

use Illuminate\Database\Seeder;

class TematTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('temat')->insert([
            'nazwa' => 'Laboratorium 1',
            'opis' => 'Wstęp do programowania w języku PHP',
            'trescAktualna' => 'Lorem ipsum',
            'trescPoprzednia' => 'Lorem ipus'
        ]);
        
        DB::table('temat')->insert([
            'nazwa' => 'Laboratorium 2',
            'opis' => 'Pierwsza strona',
            'trescAktualna' => 'Lorem ipsum2'
        ]);
        
        DB::table('temat')->insert([
            'nazwa' => 'Laboratorium 3',
            'opis' => 'Pasek nawigacji',
            'trescAktualna' => 'Paski nawigacji są bardzo przydatne...'
        ]);
    }
}
