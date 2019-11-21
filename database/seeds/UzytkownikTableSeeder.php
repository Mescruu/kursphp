<?php

use Illuminate\Database\Seeder;

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
            'imie' => 'Bartosz',
            'nazwisko' => 'Wijatkowski',
            'nrAlbumu' => 86441,
            'email' => 'bartek.chom@gmail.com',
            'haslo' => bcrypt('123456'),
            'idGrupa' => 1,
            'typ' => 'student'
        ]);
        
        DB::table('uzytkownik')->insert([
            'imie' => 'Albert',
            'nazwisko' => 'Woś',
            'nrAlbumu' => 86444,
            'email' => 'mescruu@gmail.com',
            'haslo' => bcrypt('123456'),
            'idGrupa' => 1,
            'typ' => 'student'
        ]);
        
        DB::table('uzytkownik')->insert([
            'imie' => 'Kasia',
            'nazwisko' => 'Mitrus',
            'nrAlbumu' => 86370,
            'email' => 'mitruskasia@gmail.com',
            'haslo' => bcrypt('123456'),
            'idGrupa' => 1,
            'typ' => 'student'
        ]);
        
        DB::table('uzytkownik')->insert([
            'imie' => 'Mirosław',
            'nazwisko' => 'Kadziejkowski',
            'nrAlbumu' => 86669,
            'email' => 'kadzieja97@gmail.com',
            'haslo' => bcrypt('123456'),
            'idGrupa' => 1,
            'typ' => 'student'
        ]);
        
        DB::table('uzytkownik')->insert([
            'imie' => 'Dawid',
            'nazwisko' => 'Pasieka',
            'nrAlbumu' => 86449,
            'email' => 'fizykajestglupia@gmail.com',
            'haslo' => bcrypt('123456'),
            'idGrupa' => 1,
            'typ' => 'student'
        ]);
        
        DB::table('uzytkownik')->insert([
            'imie' => 'Paweł',
            'nazwisko' => 'Chleb',
            'nrAlbumu' => 86471,
            'email' => 'pawel.pieczywo@gmail.com',
            'haslo' => bcrypt('123456'),
            'idGrupa' => 2,
            'typ' => 'student'
        ]);
        
        DB::table('uzytkownik')->insert([
            'imie' => 'Rafał',
            'nazwisko' => 'Faja',
            'nrAlbumu' => 86401,
            'email' => 'fajar@gmail.com',
            'haslo' => bcrypt('123456'),
            'idGrupa' => 2,
            'typ' => 'student'
        ]);
        
        DB::table('uzytkownik')->insert([
            'imie' => 'Agnieszka',
            'nazwisko' => 'Kula',
            'nrAlbumu' => 86402,
            'email' => 'kuladajefula@gmail.com',
            'haslo' => bcrypt('123456'),
            'idGrupa' => 2,
            'typ' => 'student'
        ]);
        
        DB::table('uzytkownik')->insert([
            'imie' => 'Mikołaj',
            'nazwisko' => 'Szaleniec',
            'nrAlbumu' => 86123,
            'email' => 'crazy.mike@gmail.com',
            'haslo' => bcrypt('123456'),
            'idGrupa' => 2,
            'typ' => 'student'
        ]);
        
        DB::table('uzytkownik')->insert([
            'imie' => 'Iwona',
            'nazwisko' => 'Ulewa',
            'nrAlbumu' => 86442,
            'email' => 'raiwona@gmail.com',
            'haslo' => bcrypt('123456'),
            'idGrupa' => 3,
            'typ' => 'student'
        ]);
        
        DB::table('uzytkownik')->insert([
            'imie' => 'Paulina',
            'nazwisko' => 'Ptak',
            'nrAlbumu' => 86456,
            'email' => 'ptakulina@gmail.com',
            'haslo' => bcrypt('123456'),
            'idGrupa' => 3,
            'typ' => 'student'
        ]);
        
        DB::table('uzytkownik')->insert([
            'imie' => 'Maciej',
            'nazwisko' => 'Denny',
            'nrAlbumu' => 86789,
            'email' => 'denny.m@gmail.com',
            'haslo' => bcrypt('123456'),
            'idGrupa' => 3,
            'typ' => 'student'
        ]);
        
        DB::table('uzytkownik')->insert([
            'imie' => 'Dawid',
            'nazwisko' => 'Podsiadło',
            'nrAlbumu' => 86192,
            'email' => 'gumowaryba@gmail.com',
            'haslo' => bcrypt('123456'),
            'idGrupa' => 3,
            'typ' => 'student'
        ]);
        
        DB::table('uzytkownik')->insert([
            'imie' => 'Beata',
            'nazwisko' => 'Nóż',
            'nrAlbumu' => 86764,
            'email' => 'anozwidelec@gmail.com',
            'haslo' => bcrypt('123456'),
            'idGrupa' => 3,
            'typ' => 'student'
        ]);
        
        DB::table('uzytkownik')->insert([
            'imie' => 'Beata',
            'nazwisko' => 'Pańczyk',
            'email' => 'b.panczyk@pollub.pl',
            'haslo' => bcrypt('123456'),
            'typ' => 'nauczyciel'
        ]);
        
        DB::table('uzytkownik')->insert([
            'imie' => 'Mariusz',
            'nazwisko' => 'Dzieńkowski',
            'email' => 'm.dzienkowski@pollub.pl',
            'haslo' => bcrypt('123456'),
            'typ' => 'nauczyciel'
        ]);
        
        DB::table('uzytkownik')->insert([
            'imie' => 'Tomasz',
            'nazwisko' => 'Szuster',
            'email' => 't.szuster@pollub.pl',
            'haslo' => bcrypt('123456'),
            'typ' => 'nauczyciel'
        ]);
    }
}
