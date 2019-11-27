<?php

use Illuminate\Database\Seeder;

class ZadanieTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('zadanie')->insert([
            'id' => 1,
            'idTemat' => 1,
            'nazwa' => 'Utwórz podstawową stronę',
            'tresc' => 'Utwórz plik PHP, w którym zamieścisz.... etc'
        ]);
        
        DB::table('zadanie')->insert([
            'id' => 2,
            'idTemat' => 2,
            'nazwa' => 'Galeria',
            'tresc' => 'Utwórz plik PHP, w którym umieścisz 9 stron z bazy danych...'
        ]);
        
        DB::table('zadanie')->insert([
            'id' => 3,
            'idTemat' => 2,
            'nazwa' => 'Hiperłącza',
            'tresc' => 'Utwórz kilka stron php, które połączysz hiperłączami...'
        ]);
    }
}
