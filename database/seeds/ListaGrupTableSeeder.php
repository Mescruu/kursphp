<?php

use Illuminate\Database\Seeder;

class ListaGrupTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('listaGrup')->insert([
            'id' => 1,
            'idGrupa' => 1,
            'idTemat' => 1
        ]);
        
        DB::table('listaGrup')->insert([
            'id' => 2,
            'idGrupa' => 1,
            'idTemat' => 2
        ]);
        
        DB::table('listaGrup')->insert([
            'id' => 3,
            'idGrupa' => 1,
            'idTemat' => 3
        ]);
        
        DB::table('listaGrup')->insert([
            'id' => 4,
            'idGrupa' => 2,
            'idTemat' => 1
        ]);
        
        DB::table('listaGrup')->insert([
            'id' => 5,
            'idGrupa' => 2,
            'idTemat' => 2
        ]);
        
        DB::table('listaGrup')->insert([
            'id' => 6,
            'idGrupa' => 2,
            'idTemat' => 3
        ]);
        
        DB::table('listaGrup')->insert([
            'id' => 7,
            'idGrupa' => 3,
            'idTemat' => 1
        ]);
        
        DB::table('listaGrup')->insert([
            'id' => 8,
            'idGrupa' => 3,
            'idTemat' => 2
        ]);
    }
}
