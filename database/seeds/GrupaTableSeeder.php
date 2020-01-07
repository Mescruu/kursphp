<?php

use Illuminate\Database\Seeder;

class GrupaTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('grupa')->insert([
            'id' => 1,
            'nazwa' => 'IIST lab 1',
            'idNauczyciel'=> 15
        ]);
        
        DB::table('grupa')->insert([
            'id' => 2,
            'nazwa' => 'IIST lab 2',
            'idNauczyciel'=> 16
        ]);
        
        DB::table('grupa')->insert([
            'id' => 3,
            'nazwa' => 'IIST lab 3',
            'idNauczyciel'=> 17
        ]);
    }
}
