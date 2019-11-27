<?php

use Illuminate\Database\Seeder;

class PytanieTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('pytanie')->insert([
            'id' => 1,
            'idQuiz' => 1,
            'tresc' => 'Q1Tresc1',
            'odpPoprawna' => '1odpPoprawna',
            'odpA' => '1odpA1',
            'odpB' => '1odpB1',
            'odpC' => '1odpC1'
        ]);
        
        DB::table('pytanie')->insert([
            'id' => 2,
            'idQuiz' => 1,
            'tresc' => 'Q1Tresc2',
            'odpPoprawna' => '1odpPoprawna2',
            'odpA' => '1odpA2',
            'odpB' => '1odpB2',
            'odpC' => '1odpC2'
        ]);
        
        DB::table('pytanie')->insert([
            'id' => 3,
            'idQuiz' => 1,
            'tresc' => 'Q1Tresc3',
            'odpPoprawna' => '1odpPoprawna3',
            'odpA' => '1odpA3',
            'odpB' => '1odpB3',
            'odpC' => '1odpC3'
        ]);
        
        DB::table('pytanie')->insert([
            'id' => 4,
            'idQuiz' => 1,
            'tresc' => 'Q1Tresc4',
            'odpPoprawna' => '1odpPoprawna4',
            'odpA' => '1odpA4',
            'odpB' => '1odpB4',
            'odpC' => '1odpC4'
        ]);
        
        DB::table('pytanie')->insert([
            'id' => 5,
            'idQuiz' => 2,
            'tresc' => 'Q2Tresc1',
            'odpPoprawna' => '2odpPoprawna1',
            'odpA' => '2odpA1',
            'odpB' => '2odpB1',
            'odpC' => '2odpC1'
        ]);
        
        DB::table('pytanie')->insert([
            'id' => 6,
            'idQuiz' => 2,
            'tresc' => 'Q2Tresc2',
            'odpPoprawna' => '2odpPoprawna2',
            'odpA' => '2odpA2',
            'odpB' => '2odpB2',
            'odpC' => '2odpC2'
        ]);
        
        DB::table('pytanie')->insert([
            'id' => 7,
            'idQuiz' => 2,
            'tresc' => 'Q2Tresc3',
            'odpPoprawna' => '2odpPoprawna3',
            'odpA' => '2odpA3',
            'odpB' => '2odpB3',
            'odpC' => '2odpC3'
        ]);
        
        DB::table('pytanie')->insert([
            'id' => 8,
            'idQuiz' => 2,
            'tresc' => 'Q2Tresc4',
            'odpPoprawna' => '2odpPoprawna4',
            'odpA' => '2odpA4',
            'odpB' => '2odpB4',
            'odpC' => '2odpC4'
        ]);
        
        DB::table('pytanie')->insert([
            'id' => 9,
            'idQuiz' => 2,
            'tresc' => 'Q2Tresc5',
            'odpPoprawna' => '2odpPoprawna5',
            'odpA' => '2odpA5',
            'odpB' => '2odpB5',
            'odpC' => '2odpC5'
        ]);
        
        DB::table('pytanie')->insert([
            'id' => 10,
            'idQuiz' => 3,
            'tresc' => 'Q3Tresc1',
            'odpPoprawna' => '3odpPoprawna1',
            'odpA' => '3odpA1',
            'odpB' => '3odpB1',
            'odpC' => '3odpC1'
        ]);
        
        DB::table('pytanie')->insert([
            'id' => 11,
            'idQuiz' => 3,
            'tresc' => 'Q3Tresc2',
            'odpPoprawna' => '3odpPoprawna2',
            'odpA' => '3odpA2',
            'odpB' => '3odpB2',
            'odpC' => '3odpC2'
        ]);
        
        DB::table('pytanie')->insert([
            'id' => 12,
            'idQuiz' => 3,
            'tresc' => 'Q3Tresc3',
            'odpPoprawna' => '3odpPoprawna3',
            'odpA' => '3odpA3',
            'odpB' => '3odpB3',
            'odpC' => '3odpC3'
        ]);
        
        DB::table('pytanie')->insert([
            'id' => 13,
            'idQuiz' => 4,
            'tresc' => 'Q4Tresc1',
            'odpPoprawna' => '4odpPoprawna1',
            'odpA' => '4odpA1',
            'odpB' => '4odpB1',
            'odpC' => '4odpC1'
        ]);
        
        DB::table('pytanie')->insert([
            'id' => 14,
            'idQuiz' => 4,
            'tresc' => 'Q4Tresc2',
            'odpPoprawna' => '4odpPoprawna2',
            'odpA' => '4odpA2',
            'odpB' => '4odpB2',
            'odpC' => '4odpC2'
        ]);
        
        DB::table('pytanie')->insert([
            'id' => 15,
            'idQuiz' => 4,
            'tresc' => 'Q4Tresc3',
            'odpPoprawna' => '4odpPoprawna3',
            'odpA' => '4odpA3',
            'odpB' => '4odpB3',
            'odpC' => '4odpC3'
        ]);
        
        DB::table('pytanie')->insert([
            'id' => 16,
            'idQuiz' => 4,
            'tresc' => 'Q4Tresc4',
            'odpPoprawna' => '4odpPoprawna4',
            'odpA' => '4odpA4',
            'odpB' => '4odpB4',
            'odpC' => '4odpC4'
        ]);
    }
}
