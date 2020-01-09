<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ListaGrupTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('listaGrup')->insert([
            'id' => 1,
            'idGrupa' => 1,
            'idTemat' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('listaGrup')->insert([
            'id' => 2,
            'idGrupa' => 1,
            'idTemat' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('listaGrup')->insert([
            'id' => 3,
            'idGrupa' => 1,
            'idTemat' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('listaGrup')->insert([
            'id' => 4,
            'idGrupa' => 1,
            'idTemat' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('listaGrup')->insert([
            'id' => 5,
            'idGrupa' => 1,
            'idTemat' => 5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('listaGrup')->insert([
            'id' => 6,
            'idGrupa' => 2,
            'idTemat' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('listaGrup')->insert([
            'id' => 7,
            'idGrupa' => 2,
            'idTemat' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('listaGrup')->insert([
            'id' => 8,
            'idGrupa' => 2,
            'idTemat' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('listaGrup')->insert([
            'id' => 9,
            'idGrupa' => 2,
            'idTemat' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('listaGrup')->insert([
            'id' => 10,
            'idGrupa' => 3,
            'idTemat' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('listaGrup')->insert([
            'id' => 11,
            'idGrupa' => 3,
            'idTemat' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('listaGrup')->insert([
            'id' => 12,
            'idGrupa' => 3,
            'idTemat' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('listaGrup')->insert([
            'id' => 13,
            'idGrupa' => 3,
            'idTemat' => 4,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
