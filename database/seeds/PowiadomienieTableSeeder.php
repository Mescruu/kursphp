<?php

use Illuminate\Database\Seeder;

class PowiadomienieTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('powiadomienie')->insert([
            'id' => 1,
            'idUzytkownik' => 15,
            'komunikat' => 'Utworzono temat Laboratorium 1',
        ]);
        
        DB::table('powiadomienie')->insert([
            'id' => 2,
            'idUzytkownik' => 15,
            'komunikat' => 'Utworzono temat Laboratorium 2',
            'waga' => 'zwykle'
        ]);
        
        DB::table('powiadomienie')->insert([
            'id' => 3,
            'idUzytkownik' => 15,
            'komunikat' => 'Utworzono temat Laboratorium 3',
            'waga' => 'zwykle'
        ]);
        
        DB::table('powiadomienie')->insert([
            'id' => 4,
            'idUzytkownik' => 15,
            'komunikat' => 'Zedytowano temat Laboratorium 1',
            'waga' => 'zwykle'
        ]);
        
        DB::table('powiadomienie')->insert([
            'id' => 5,
            'idUzytkownik' => 14,
            'komunikat' => 'Zmieniono hasło!',
            'waga' => 'zwykle'
        ]);
    }
}
