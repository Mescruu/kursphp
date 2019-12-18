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
        
        $this->call(UzytkownikTableSeeder::class);
        $this->call(GrupaTableSeeder::class);
        $this->call(ListaGrupTableSeeder::class);
        $this->call(PowiadomienieTableSeeder::class);
        $this->call(PunktyTableSeeder::class);
        $this->call(PytanieTableSeeder::class);
        $this->call(QuizTableSeeder::class);
        $this->call(RozwiazanieTableSeeder::class);
        $this->call(TematTableSeeder::class);
        $this->call(WynikTableSeeder::class);
        $this->call(ZadanieTableSeeder::class);
        $this->call(KryteriumFileSeeder::class);
	$this->call(WykladTableSeeder::class);
    }
}
