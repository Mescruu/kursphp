<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
        UzytkownikTableSeeder::class,
        GrupaTableSeeder::class,
        ListaGrupTableSeeder::class,
        PowiadomienieListaGrupTableSeeder::class,
        PunktyListaGrupTableSeeder::class,
        PytanieListaGrupTableSeeder::class,
        QuizListaGrupTableSeeder::class,
        RozwiazanieListaGrupTableSeeder::class,
        TematListaGrupTableSeeder::class,
        WynikListaGrupTableSeeder::class,
        ZadanieListaGrupTableSeeder::class
    ]);
    }
}
