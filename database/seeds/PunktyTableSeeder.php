<?php

use Illuminate\Database\Seeder;

class PunktyTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('punkty')->insert([
            'id' => 1,
            'idStudent' => 1,
            'idNauczyciel' => 15,
            'ilosc' => 5,
            'komentarz' => 'Aktywność na zajęciach'
        ]);
        
        DB::table('punkty')->insert([
            'id' => 2,
            'idStudent' => 1,
            'idNauczyciel' => 15,
            'ilosc' => -5,
            'komentarz' => 'Pomyłka'
        ]);
        
        DB::table('punkty')->insert([
            'id' => 3,
            'idStudent' => 1,
            'idNauczyciel' => 16,
            'ilosc' => 1,
            'komentarz' => 'Aktywność na zajęciach'
        ]);
        
        DB::table('punkty')->insert([
            'id' => 4,
            'idStudent' => 2,
            'idNauczyciel' => 15,
            'ilosc' => 3,
            'komentarz' => 'Aktywność na zajęciach'
        ]);
        
        DB::table('punkty')->insert([
            'id' => 5,
            'idStudent' => 2,
            'idNauczyciel' => 16,
            'ilosc' => 5,
            'komentarz' => 'Aktywność na zajęciach'
        ]);
        
        DB::table('punkty')->insert([
            'id' => 6,
            'idStudent' => 1,
            'idNauczyciel' => 15,
            'ilosc' => 40,
            'komentarz' => 'Kolokwium I'
        ]);
    }
}
