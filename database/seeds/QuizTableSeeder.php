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
            'mnoznik' => 1
        ]);
    }
}
