<?php

use Illuminate\Database\Seeder;

class ListaGrupTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('listaGrup')->insert([
            'idGrupa' => 1,
            'idTemat' => 1
        ]);
        
        DB::table('listaGrup')->insert([
            'idGrupa' => 1,
            'idTemat' => 2
        ]);
        
        DB::table('listaGrup')->insert([
            'idGrupa' => 1,
            'idTemat' => 3
        ]);
        
        DB::table('listaGrup')->insert([
            'idGrupa' => 2,
            'idTemat' => 1
        ]);
        
        DB::table('listaGrup')->insert([
            'idGrupa' => 2,
            'idTemat' => 2
        ]);
        
        DB::table('listaGrup')->insert([
            'idGrupa' => 2,
            'idTemat' => 3
        ]);
        
        DB::table('listaGrup')->insert([
            'idGrupa' => 3,
            'idTemat' => 1
        ]);
        
        DB::table('listaGrup')->insert([
            'idGrupa' => 3,
            'idTemat' => 2
        ]);
    }
}
