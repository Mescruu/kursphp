<?php

use Illuminate\Database\Seeder;

class GrupaTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('grupa')->insert([
            'nazwa' => 'IIST5.1'
        ]);
        
        DB::table('grupa')->insert([
            'nazwa' => 'IIST5.2'
        ]);
        
        DB::table('grupa')->insert([
            'nazwa' => 'IIST5.3'
        ]);
    }
}
