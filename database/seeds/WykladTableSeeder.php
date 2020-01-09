<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class WykladTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wyklad')->insert([
            'id' => 1,
            'idTemat' => 1,
            'tytul' => 'Wyklad 1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('wyklad')->insert([
            'id' => 2,
            'idTemat' => 2,
            'tytul' => 'Wyklad 2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('wyklad')->insert([
            'id' => 3,
            'idTemat' => 3,
            'tytul' => 'Wyklad 3',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('wyklad')->insert([
            'id' => 4,
            'idTemat' => 4,
            'tytul' => 'Wyklad 4',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('wyklad')->insert([
            'id' => 5,
            'idTemat' => 5,
            'tytul' => 'Wyklad 5',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
