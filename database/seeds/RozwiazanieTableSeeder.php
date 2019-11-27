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
            'sciezka' => 'r1',
            'informacje' => 'Zadanie: Utwórz podstawową stronę'
        ]);
        
        DB::table('rozwiazanie')->insert([
            'id' => 2,
            'idZadanie' => 2,
            'idUzytkownik' => 1,
            'sciezka' => 'r2',
            'informacje' => 'Zadanie: Galeria'
        ]);
        
        DB::table('rozwiazanie')->insert([
            'id' => 3,
            'idZadanie' => 1,
            'idUzytkownik' => 2,
            'sciezka' => 'r3',
            'informacje' => 'Zadanie: Utwórz podstawową stronę'
        ]);
        
        DB::table('rozwiazanie')->insert([
            'id' => 4,
            'idZadanie' => 2,
            'idUzytkownik' => 2,
            'sciezka' => 'r4',
            'informacje' => 'Zadanie: Galeria'
        ]);
        
        DB::table('rozwiazanie')->insert([
            'id' => 5,
            'idZadanie' => 3,
            'idUzytkownik' => 2,
            'sciezka' => 'r4',
            'informacje' => 'Zadanie: Utwórz kilka stron php, które połączysz hiperłączami...'
        ]);
    }
}
