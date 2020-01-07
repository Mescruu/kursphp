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
            'odpPoprawna' => 'PHP ("PHP: Hypertext Preprocesor") to
język skryptowy działający po stronie serwera.',
            'odpA' => 'PHP ("PHP: Hypertext Postprocesor") to
język skryptowy działający po stronie serwera.',
            'odpB' => 'PHP ("PHP: Hypertext Preprocesor") to
język skryptowy działający po stronie klienta.',
            'odpC' => 'PHP ("PHP: Hypertext Preprocesor") to
język kodowania działający po stronie klienta.'
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
            'tresc' => 'Który operator logiczny nie występuje w php?',
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


        DB::table('pytanie')->insert([
            'id' => 9,
            'idQuiz' => 2,
            'tresc' => 'Który z podanych sposobów zainicjalizowania tablicy asocjacyjnej jest poprawny?',
            'odpPoprawna' => '$ceny=array("Zeszyt"=>2, "Blok"=>8, "Kredki"=>4);',
            'odpA' => '$ceny=array("Zeszyt"=2, "Blok"=8, "Kredki"=4);',
            'odpB' => '$ceny=table($Zeszyt=>2, $Blok=>8, $Kredki=>4);',
            'odpC' => '$ceny=table("Zeszyt"=>2, "Blok"=>8, "Kredki"=>4);'
        ]);


        DB::table('pytanie')->insert([
            'id' => 10,
            'idQuiz' => 2,
            'tresc' => 'Która z podanych funkcji umożliwia sortowanie rosnące wg. wartości elementu w tablicy asocjacyjnej?',
            'odpPoprawna' => 'asort()',
            'odpA' => 'ksort()',
            'odpB' => 'arsort()',
            'odpC' => 'rsort()'
        ]);


        DB::table('pytanie')->insert([
            'id' => 11,
            'idQuiz' => 2,
            'tresc' => 'Który tryb otwarcia pliku umożliwia odczyt oraz zapis?',
            'odpPoprawna' => 'r+',
            'odpA' => 'r',
            'odpB' => 'b',
            'odpC' => 'q+'
        ]);


        DB::table('pytanie')->insert([
            'id' => 12,
            'idQuiz' => 2,
            'tresc' => 'Która funkcja umożliwia sprawdzenie istnienia pliku, bez jego otwierania?',
            'odpPoprawna' => 'file_exists()',
            'odpA' => 'f_exists()',
            'odpB' => 'if_exists()',
            'odpC' => 'exists()'
        ]);


        DB::table('pytanie')->insert([
            'id' => 13,
            'idQuiz' => 2,
            'tresc' => 'Który z podanych sposobów porównywania ciągów jest błędny?',
            'odpPoprawna' => 'operator "="',
            'odpA' => 'strcasecmp()',
            'odpB' => 'strcmp',
            'odpC' => 'operator "=="'
        ]);


        DB::table('pytanie')->insert([
            'id' => 14,
            'idQuiz' => 2,
            'tresc' => 'Która z podanych funkcji pozwoli na zamianę wszystkich znalezionych fragmentów tekstu "tekst" na "nowy_tekst" w ciagu "ciąg"?',
            'odpPoprawna' => 'string str_replace(string tekst, string nowy_tekst, string ciag);',
            'odpA' => 'string strreplace(string tekst, string nowy_tekst, string ciag);',
            'odpB' => 'string streplace(string tekst, string nowy_tekst, string ciag);',
            'odpC' => 'string string_replace(string tekst, string nowy_tekst, string ciag);'
        ]);


        DB::table('pytanie')->insert([
            'id' => 15,
            'idQuiz' => 3,
            'tresc' => 'Która z funkcji PCRE zwraca tablicę ciągów pasujących do wzorca?',
            'odpPoprawna' => 'preg_grep',
            'odpA' => 'preg_filter',
            'odpB' => 'preg_math',
            'odpC' => 'preg_quote'
        ]);
        DB::table('pytanie')->insert([
            'id' => 16,
            'idQuiz' => 3,
            'tresc' => 'Co umożliwia funkcja "filter_input()"?',
            'odpPoprawna' => 'Funkcja pobiera zmienne zewnętrzne (np. z formularzy) i opcjonalnie je filtruje.',
            'odpA' => 'Funkcja pobiera zmienne zewnętrzne i tworzy tablicę z "true", bądź "false".',
            'odpB' => 'Funkcja sprawdza, czy zmienna została przefiltrowana.',
            'odpC' => 'Funkcja sprawdza, czy zmienna istnieje.'
        ]);
        DB::table('pytanie')->insert([
            'id' => 17,
            'idQuiz' => 3,
            'tresc' => 'Co umożliwia funkcja FILTER_SANITIZE_NUMBER_INT',
            'odpPoprawna' => 'Usuwa wszystkie znaki poza cyframi oraz znakami plus i minus.',
            'odpA' => 'Usuwa wszystkie znaki poza cyframi oraz znakami "*" i "/".',
            'odpB' => 'Usuwa wszystkie znaki poza cyframi',
            'odpC' => 'Usuwa wszystkie znaki poza cyframi oraz znakami matematycznymi.'
        ]);
        DB::table('pytanie')->insert([
            'id' => 18,
            'idQuiz' => 4,
            'tresc' => 'Które zainicjalizowanie funkcji jest nieprawidłowe?',
            'odpPoprawna' => '1funkcja',
            'odpA' => 'funkcja1',
            'odpB' => 'funkcja_1',
            'odpC' => 'funkcja'
        ]);
        DB::table('pytanie')->insert([
            'id' => 19,
            'idQuiz' => 4,
            'tresc' => 'Czym różni się require_once() od require()?',
            'odpPoprawna' => 'Identyczne działanie jak require(), poza tym, że PHP sprawdzi czy żądany plik nie został już dołączony i jeśli tak to nie dołączy go ponownie',
            'odpA' => 'Niczym. Identyczne działanie jak require',
            'odpB' => 'Identyczne działanie jak require(), poza tym, że PHP sprawdzi czy żądany plik nie został już dołączony i jeśli tak to odświeży plik - załaduje go ponownie',
            'odpC' => 'Identyczne działanie jak require(), poza tym, że PHP sprawdzi czy żądany plik zostanie dołączony tylko raz.'
        ]);

        DB::table('pytanie')->insert([
            'id' => 20,
            'idQuiz' => 4,
            'tresc' => 'Która funkcja umożliwia sprawdzenie czasu ostatniej modyfikacji?',
            'odpPoprawna' => 'filemtime()',
            'odpA' => 'fileotime()',
            'odpB' => 'fileatime()',
            'odpC' => 'filemodtime()'
        ]);
        DB::table('pytanie')->insert([
            'id' => 21,
            'idQuiz' => 4,
            'tresc' => 'Co umożliwia funkcja pathinfo()?',
            'odpPoprawna' => 'pathinfo("nazwa_pliku") – pobiera informację o nazwie pliku i zwraca ją w postaci tablicy asocjacyjnej czterech elementów o kluczach: dirname, basename,extension, filename',
            'odpA' => 'pathinfo("nazwa_pliku") – pobiera informację o nazwie pliku i zwraca ją w postaci ciągu znaków o treści: lokalizacja-nazwa-rozszerzenie',
            'odpB' => 'pathinfo("nazwa_pliku") – pobiera informację o nazwie pliku i zwraca ją. ',
            'odpC' => 'pathinfo("nazwa_pliku") – pobiera informację o nazwie pliku i zwraca ją w postaci tablicy asocjacyjnej czterech elementów o kluczach: dirname, name, extension, date'
        ]);
        DB::table('pytanie')->insert([
            'id' => 22,
            'idQuiz' => 4,
            'tresc' => 'Co umożliwia funkcja opendir()?',
            'odpPoprawna' => 'Umożliwia otwarcie katalogu do odczytu. Funkcja zwraca uchwyt katalogu.',
            'odpA' => 'Umożliwia wyświetlenie zawartości katalogu.',
            'odpB' => 'Umożliwia utworzenie katalogu.',
            'odpC' => 'Umożliwia otwarcie katalogu do odczytu. Funkcja zwraca nazwę katalogu.'
        ]);

        DB::table('pytanie')->insert([
            'id' => 23,
            'idQuiz' => 5,
            'tresc' => 'Który specyfikator dostępu umożliwia nieograniczony dostęp do zmiennej?',
            'odpPoprawna' => 'public',
            'odpA' => 'protected',
            'odpB' => 'private',
            'odpC' => 'Żadne z wymienionych.'
        ]);
        DB::table('pytanie')->insert([
            'id' => 24,
            'idQuiz' => 5,
            'tresc' => 'Które z podanych zdań dotyczących interfejsów jest nieprawdziwe?',
            'odpPoprawna' => 'Wszystkie metody interfejsu muszą być prywatne.',
            'odpA' => 'Interfejs jest definiowany za pomocą słowa kluczowego interface.',
            'odpB' => 'Klasa nie może implementować dwóch interfejsów, które posiadają tak samo nazwane metody.',
            'odpC' => 'Interfejsy mogą po sobie dziedziczyć tak jak zwykłe klasy.'
        ]);
        DB::table('pytanie')->insert([
            'id' => 25,
            'idQuiz' => 5,
            'tresc' => 'Wskaż zdanie prawdziwe na temat klasy typu "final".',
            'odpPoprawna' => 'Jeśli cała klasa jest zdefiniowana jako final, to nie można po niej dziedziczyć.',
            'odpA' => 'Jeśli cała klasa jest zdefiniowana jako final, to można po niej dziedziczyć ze wszystkich klas.',
            'odpB' => 'Jeśli cała klasa jest zdefiniowana jako final, nie można jej edytować - jest to wersja ostateczna.',
            'odpC' => 'Jeśli cała klasa jest zdefiniowana jako final, nie może dziedziczyć po innej klasie.'
        ]);
        DB::table('pytanie')->insert([
            'id' => 26,
            'idQuiz' => 5,
            'tresc' => 'Czym kończy się deklaracja klasy?',
            'odpPoprawna' => 'średnikiem - ";"',
            'odpA' => 'kropką - "."',
            'odpB' => 'nawiasem kwadratowym - "]"',
            'odpC' => 'nawiasem okrągłym - ")"'
        ]);
        DB::table('pytanie')->insert([
            'id' => 27,
            'idQuiz' => 5,
            'tresc' => 'Które z rozwinięć skrótu "OOP" jest prawidłowe?',
            'odpPoprawna' => 'Object Oriented Programming',
            'odpA' => 'Object Of Programming',
            'odpB' => 'Operator Object Programming',
            'odpC' => 'Object Organized Programming'
        ]);
    }
}
