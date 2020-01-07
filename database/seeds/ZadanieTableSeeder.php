<?php

use Illuminate\Database\Seeder;

class ZadanieTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('zadanie')->insert([
            'id' => 1,
            'idTemat' => 4,
            'nazwa' => 'Utworzenie ankiety',
            'tresc' => 'Utwórz nową stronę ankieta.php (PHP Web Page), w której należy umieścić formularz '.
                    'ankiety jak na rysunku 1. Przyciski typu checkbox wygeneruj za pomocą skryptu PHP '.
                    'korzystając z tablicy: '.
                    '$tech = ["C", "CPP", "Java", "C#", "HTML", "CSS", "XML", "PHP", "JavaScript"]. '.
                    'Wyniki ankiety zapisuj w pliku ankieta.txt. Po zapisie – pokaż stronę z wynikami (liczby '.
                    'głosów oddanych na poszczególne technologie – pojedyncze głosowanie powinno sprawdzać, '.
                    'na które technologie oddano głos i inkrementować w pliku odpowiednie liczniki). Możesz '.
                    'wykorzystać przykład ankiety z wykładu 2. '.
                    'Strona z wynikami powinna pokazać liczby głosów oddanych na każdy z języków po '.
                    'wielokrotnym głosowaniu (np. C-12, CPP–10, …, JavaScript–21).'
        ]);
    }
}
