<?php

use Illuminate\Database\Seeder;

class PowiadomienieTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('powiadomienie')->insert([
            'idUzytkownik' => 15,
            'komunikat' => 'Utworzono temat Laboratorium 1'
        ]);
        
        DB::table('powiadomienie')->insert([
            'idUzytkownik' => 15,
            'komunikat' => 'Utworzono temat Laboratorium 2'
        ]);
        
        DB::table('powiadomienie')->insert([
            'idUzytkownik' => 15,
            'komunikat' => 'Utworzono temat Laboratorium 3'
        ]);
        
        DB::table('powiadomienie')->insert([
            'idUzytkownik' => 15,
            'komunikat' => 'Zedytowano temat Laboratorium 1'
        ]);
        
        DB::table('powiadomienie')->insert([
            'idUzytkownik' => 14,
            'komunikat' => 'Zmieniono hasło!'
        ]);
    }
}
