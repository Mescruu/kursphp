<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UzytkownikTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('uzytkownik')->insert([
            'id' => 1,
            'imie' => 'Bartosz',
            'nazwisko' => 'Wijatkowski',
            'nrAlbumu' => 86441,
            'email' => 'bartek.chom@gmail.com',
            'haslo' => bcrypt('123456'),
            'idGrupa' => 1,
            'typ' => 'student',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('uzytkownik')->insert([
            'id' => 2,
            'imie' => 'Albert',
            'nazwisko' => 'Woś',
            'nrAlbumu' => 86444,
            'email' => 'mescruu@gmail.com',
            'haslo' => bcrypt('123456'),
            'idGrupa' => 1,
            'typ' => 'student',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('uzytkownik')->insert([
            'id' => 3,
            'imie' => 'Maciej',
            'nazwisko' => 'Domagała',
            'nrAlbumu' => 86371,
            'email' => 'domagalam@gmail.com',
            'haslo' => bcrypt('123456'),
            'idGrupa' => 1,
            'typ' => 'student',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('uzytkownik')->insert([
            'id' => 4,
            'imie' => 'Mirosław',
            'nazwisko' => 'Kadziejkowski',
            'nrAlbumu' => 86669,
            'email' => 'kadzieja97@gmail.com',
            'haslo' => bcrypt('123456'),
            'idGrupa' => 1,
            'typ' => 'student',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('uzytkownik')->insert([
            'id' => 5,
            'imie' => 'Dawid',
            'nazwisko' => 'Pasieka',
            'nrAlbumu' => 86449,
            'email' => 'pasieka.d@gmail.com',
            'haslo' => bcrypt('123456'),
            'idGrupa' => 1,
            'typ' => 'student',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('uzytkownik')->insert([
            'id' => 6,
            'imie' => 'Paweł',
            'nazwisko' => 'Chleb',
            'nrAlbumu' => 86471,
            'email' => 'pawel.pieczywo@gmail.com',
            'haslo' => bcrypt('123456'),
            'idGrupa' => 2,
            'typ' => 'student',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('uzytkownik')->insert([
            'id' => 7,
            'imie' => 'Rafał',
            'nazwisko' => 'Faja',
            'nrAlbumu' => 86401,
            'email' => 'fajar@gmail.com',
            'haslo' => bcrypt('123456'),
            'idGrupa' => 2,
            'typ' => 'student',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('uzytkownik')->insert([
            'id' => 8,
            'imie' => 'Agnieszka',
            'nazwisko' => 'Kula',
            'nrAlbumu' => 86402,
            'email' => 'kulaa@gmail.com',
            'haslo' => bcrypt('123456'),
            'idGrupa' => 2,
            'typ' => 'student',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('uzytkownik')->insert([
            'id' => 9,
            'imie' => 'Mikołaj',
            'nazwisko' => 'Szaleniec',
            'nrAlbumu' => 86123,
            'email' => 'crazy.mike@gmail.com',
            'haslo' => bcrypt('123456'),
            'idGrupa' => 2,
            'typ' => 'student',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('uzytkownik')->insert([
            'id' => 10,
            'imie' => 'Iwona',
            'nazwisko' => 'Ulewa',
            'nrAlbumu' => 86442,
            'email' => 'raiwona@gmail.com',
            'haslo' => bcrypt('123456'),
            'idGrupa' => 3,
            'typ' => 'student',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('uzytkownik')->insert([
            'id' => 11,
            'imie' => 'Paulina',
            'nazwisko' => 'Ptak',
            'nrAlbumu' => 86456,
            'email' => 'ptakulina@gmail.com',
            'haslo' => bcrypt('123456'),
            'idGrupa' => 3,
            'typ' => 'student',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('uzytkownik')->insert([
            'id' => 12,
            'imie' => 'Maciej',
            'nazwisko' => 'Denny',
            'nrAlbumu' => 86789,
            'email' => 'denny.m@gmail.com',
            'haslo' => bcrypt('123456'),
            'idGrupa' => 3,
            'typ' => 'student',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('uzytkownik')->insert([
            'id' => 13,
            'imie' => 'Dawid',
            'nazwisko' => 'Nowak',
            'nrAlbumu' => 86192,
            'email' => 'd.nowak@gmail.com',
            'haslo' => bcrypt('123456'),
            'idGrupa' => 3,
            'typ' => 'student',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('uzytkownik')->insert([
            'id' => 14,
            'imie' => 'Beata',
            'nazwisko' => 'Nóż',
            'nrAlbumu' => 86764,
            'email' => 'anozwidelec@gmail.com',
            'haslo' => bcrypt('123456'),
            'idGrupa' => 3,
            'typ' => 'student',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('uzytkownik')->insert([
            'id' => 15,
            'imie' => 'Beata',
            'nazwisko' => 'Pańczyk',
            'email' => 'b.panczyk@pollub.pl',
            'haslo' => bcrypt('123456'),
            'typ' => 'nauczyciel',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('uzytkownik')->insert([
            'id' => 16,
            'imie' => 'Mariusz',
            'nazwisko' => 'Dzieńkowski',
            'email' => 'm.dzienkowski@pollub.pl',
            'haslo' => bcrypt('123456'),
            'typ' => 'nauczyciel',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        
        DB::table('uzytkownik')->insert([
            'id' => 17,
            'imie' => 'Tomasz',
            'nazwisko' => 'Szuster',
            'email' => 't.szuster@pollub.pl',
            'haslo' => bcrypt('123456'),
            'typ' => 'nauczyciel',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
