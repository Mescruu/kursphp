<?php

use Illuminate\Database\Seeder;

class RozwiazanieTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('rozwiazanie')->insert([
            'id' => 1,
            'idZadanie' => 1,
            'idUzytkownik' => 1,
            'oceniono' => 'nie',
            'informacje' => 'Zadanie: Utwórz podstawową stronę'
        ]);
        
        DB::table('rozwiazanie')->insert([
            'id' => 2,
            'idZadanie' => 2,
            'idUzytkownik' => 1,
            'oceniono' => 'nie',
            'informacje' => 'Zadanie: Galeria'
        ]);
        
        DB::table('rozwiazanie')->insert([
            'id' => 3,
            'idZadanie' => 1,
            'idUzytkownik' => 2,
            'oceniono' => 'nie',
            'informacje' => 'Zadanie: Utwórz podstawową stronę'
        ]);
        
        DB::table('rozwiazanie')->insert([
            'id' => 4,
            'idZadanie' => 2,
            'idUzytkownik' => 2,
            'oceniono' => 'nie',
            'informacje' => 'Zadanie: Galeria'
        ]);
        
        DB::table('rozwiazanie')->insert([
            'id' => 5,
            'idZadanie' => 3,
            'idUzytkownik' => 2,
            'oceniono' => 'nie',
            'informacje' => 'Zadanie: Utwórz kilka stron php, które połączysz hiperłączami...'
        ]);
    }
}
