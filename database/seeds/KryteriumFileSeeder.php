<?php

use Illuminate\Database\Seeder;

class KryteriumFileSeeder extends Seeder
{
    public function run()
    {
        Storage::disk('kryterium')->put('3.txt', '50');
        Storage::disk('kryterium')->put('4.txt', '75');
        Storage::disk('kryterium')->put('5.txt', '100');
    }
}
