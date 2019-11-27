<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class TematTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('temat')->insert([
            'id' => 1,
            'nazwa' => 'Laboratorium 1',
            'opis' => 'Wstęp do programowania w języku PHP',
        ]);
        Storage::disk('tematy')->put('1/ahtml.txt', '<strong>Lorem ipsum</strong>');
        Storage::disk('tematy')->put('1/abb.txt', '[b]Lorem ipsum[/b]');
        Storage::disk('tematy')->put('1/pbb.txt', '[b]Lorem ipus[/b]');
        
        
        DB::table('temat')->insert([
            'id' => 2,
            'nazwa' => 'Laboratorium 2',
            'opis' => 'Pierwsza strona',
        ]);
        Storage::disk('tematy')->put('2/ahtml.txt', '<em>Lorem ipsum</em>');
        Storage::disk('tematy')->put('2/abb.txt', '[i]Lorem ipsum[/i]');
        Storage::disk('tematy')->put('2/pbb.txt', '');
        
        DB::table('temat')->insert([
            'id' => 3,
            'nazwa' => 'Laboratorium 3',
            'opis' => 'Pasek nawigacji',
        ]);
        Storage::disk('tematy')->put('3/ahtml.txt', 'Paski nawigacji są bardzo <strong>przydatne</strong>');
        Storage::disk('tematy')->put('3/abb.txt', 'Paski nawigacji są bardzo [b]przydatne[/b]');
        Storage::disk('tematy')->put('3/pbb.txt', '');
    }
}
