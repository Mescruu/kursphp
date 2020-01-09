<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TematTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('temat')->insert([
            'id' => 1,
            'nazwa' => 'Laboratorium 1',
            'opis' => 'Środowisko NetBeans, wprowadzenie do PHP.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('temat')->insert([
            'id' => 2,
            'nazwa' => 'Laboratorium 2',
            'opis' => 'Podstawy obsługi formularzy w skryptach PHP.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('temat')->insert([
            'id' => 3,
            'nazwa' => 'Laboratorium 3',
            'opis' => 'Operacje na plikach.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('temat')->insert([
            'id' => 4,
            'nazwa' => 'Laboratorium 4',
            'opis' => 'Walidacja formularza, praca z filtrami.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('temat')->insert([
            'id' => 5,
            'nazwa' => 'Laboratorium 5',
            'opis' => 'Przesyłanie zdjęć na serwer, praca z plikami i katalogami.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
