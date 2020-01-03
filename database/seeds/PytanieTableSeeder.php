<?php

use Illuminate\Database\Seeder;

class PytanieTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('pytanie')->insert([
            'id' => 1,
            'idQuiz' => 1,
            'tresc' => 'Co to jest PHP?',
            'odpPoprawna' => 'PHP ("PHP: Hypertext Preprocesor") jest to
język skryptowy działający po stronie serwera',
            'odpA' => 'PHP ("PHP: Hypertext Postprocesor") jest to
język skryptowy działający po stronie serwera',
            'odpB' => 'PHP ("PHP: Hypertext Preprocesor") jest to
język skryptowy działający po stronie klienta',
            'odpC' => 'PHP ("PHP: Hypertext Preprocesor") jest to
język kodowania działający po stronie klienta'
        ]);
        
        DB::table('pytanie')->insert([
            'id' => 2,
            'idQuiz' => 1,
            'tresc' => 'Które kody stanu żądania HTTP są prawidłowe?',
            'odpPoprawna' => '– Informacyjny: 1xx
– Powodzenie: 2xx
– Przekierowanie: 3xx
– Błąd klienta: 4xx
– Błąd serwera: 5xx',
            'odpA' => '– Przekierowanie: 1xx
– Błąd klienta: 2xx
– Błąd serwera: 3xx
– Informacyjny: 4xx
– Powodzenie: 5xx',
            'odpB' => '– Powodzenie: 1xx
– Błąd klienta: 2xx
– Błąd serwera: 3xx
– Informacyjny: 4xx
– Przekierowanie: 5xx',
            'odpC' => '– Błąd serwera: 1xx
– Informacyjny: 2xx
– Powodzenie: 3xx
– Przekierowanie: 4xx
– Błąd klienta: 5xx'
        ]);
        
        DB::table('pytanie')->insert([
            'id' => 3,
            'idQuiz' => 1,
            'tresc' => 'Która funkcja umożliwia zmianę ciągu na małe litery?',
            'odpPoprawna' => 'strtolower()',
            'odpA' => 'strtoupper()',
            'odpB' => 'ucfirst()',
            'odpC' => 'ucwords()'
        ]);
        
        DB::table('pytanie')->insert([
            'id' => 4,
            'idQuiz' => 1,
            'tresc' => 'Która funkcja umożliwia usunięcie ukośników w ciągu pobranym z bazy danych?',
            'odpPoprawna' => 'stripslashes()',
            'odpA' => 'strip_tags()',
            'odpB' => 'addslashes()',
            'odpC' => 'rmslashes()'
        ]);

        DB::table('pytanie')->insert([
            'id' => 5,
            'idQuiz' => 1,
            'tresc' => 'Który operator logiczny, nie występuje w php?',
            'odpPoprawna' => 'nor',
            'odpA' => 'xor',
            'odpB' => 'or',
            'odpC' => '&&'
        ]);
        
        DB::table('pytanie')->insert([
            'id' => 6,
            'idQuiz' => 1,
            'tresc' => 'Która nazwa zmiennej jest nieprawidłowa?',
            'odpPoprawna' => '1nazwazmiennej',
            'odpA' => 'nazwa_zmiennej1',
            'odpB' => 'NazwaZmiennej1',
            'odpC' => 'nazwazmiennej'
        ]);
        
        DB::table('pytanie')->insert([
            'id' => 7,
            'idQuiz' => 1,
            'tresc' => 'Który sposób komentowania w php jest nieprawidłowy?',
            'odpPoprawna' => '{ komentarz }',
            'odpA' => '//komentarz',
            'odpB' => '/* komentarz  */',
            'odpC' => '# komentarz'
        ]);
        

        
        DB::table('pytanie')->insert([
            'id' => 8,
            'idQuiz' => 1,
            'tresc' => 'Który sposób wyświetlania zmiennej jest nieprawidłowy?',
            'odpPoprawna' => 'showVar $foo;',
            'odpA' => 'printf("%s\n",  $foo);',
            'odpB' => 'echo $foo;',
            'odpC' => 'print $foo;'
        ]);
        
    }
}
