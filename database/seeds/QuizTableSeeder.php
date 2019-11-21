<?php

use Illuminate\Database\Seeder;

class QuizTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('quiz')->insert([
            'idTemat' => 1,
            'typ' => 'quiz',
        ]);
        
        DB::table('quiz')->insert([
            'idTemat' => 2,
            'typ' => 'quiz',
        ]);
        
        DB::table('quiz')->insert([
            'idTemat' => 2,
            'typ' => 'quiz',
        ]);
        
        DB::table('quiz')->insert([
            'idTemat' => 3,
            'typ' => 'quiz',
        ]);
    }
}
