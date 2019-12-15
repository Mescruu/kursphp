<?php

use Illuminate\Database\Seeder;

class QuizTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('quiz')->insert([
            'id' => 1,
            'idTemat' => 1,
            'typ' => 'quiz',
            'waga' => 1
        ]);
        
        DB::table('quiz')->insert([
            'id' => 2,
            'idTemat' => 2,
            'typ' => 'quiz',
            'waga' => 1
        ]);
        
        DB::table('quiz')->insert([
            'id' => 3,
            'idTemat' => 2,
            'typ' => 'quiz',
            'waga' => 1
        ]);
        
        DB::table('quiz')->insert([
            'id' => 4,
            'idTemat' => 3,
            'typ' => 'quiz',
            'waga' => 1
        ]);
    }
}
