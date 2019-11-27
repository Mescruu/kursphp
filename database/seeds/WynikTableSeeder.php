<?php

use Illuminate\Database\Seeder;

class WynikTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('wynik')->insert([
            'id' => 1,
            'idQuiz' => 1,
            'idUzytkownik' => 1,
            'wynik' => 'Ukończyłeś quiz z wynikiem 1/4 (25%). Chcesz podwyższyć wynik? Spróbuj jeszcze raz!'
        ]);
        
        DB::table('wynik')->insert([
            'id' => 2,
            'idQuiz' => 2,
            'idUzytkownik' => 1,
            'wynik' => 'Ukończyłeś quiz z wynikiem 3/4 (75%). Prawie wynik doskonały! Chcesz spróbować jeszcze raz?'
        ]);
        
        DB::table('wynik')->insert([
            'id' => 3,
            'idQuiz' => 3,
            'idUzytkownik' => 1,
            'wynik' => 'Ukończyłeś quiz z wynikiem 4/4 (100%). Gratulacje!'
        ]);
        
        DB::table('wynik')->insert([
            'id' => 4,
            'idQuiz' => 1,
            'idUzytkownik' => 2,
            'wynik' => 'Ukończyłeś quiz z wynikiem 4/4 (100%). Gratulacje!'
        ]);
        
        DB::table('wynik')->insert([
            'id' => 5,
            'idQuiz' => 2,
            'idUzytkownik' => 2,
            'wynik' => 'Ukończyłeś quiz z wynikiem 4/4 (100%). Gratulacje!'
        ]);
        
        DB::table('wynik')->insert([
            'id' => 6,
            'idQuiz' => 3,
            'idUzytkownik' => 2,
            'wynik' => 'Ukończyłeś quiz z wynikiem 2/4 (50%). Jesteś w połowie drogi, chcesz podwyższyć wynik?'
        ]);
        
        DB::table('wynik')->insert([
            'id' => 7,
            'idQuiz' => 4,
            'idUzytkownik' => 2,
            'wynik' => 'Ukończyłeś quiz z wynikiem 3/4 (75%). Prawie wynik doskonały! Chcesz spróbować jeszcze raz?'
        ]);
    }
}
