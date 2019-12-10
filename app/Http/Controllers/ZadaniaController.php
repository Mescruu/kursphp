<?php

namespace App\Http\Controllers;

use App\Powiadomienie;
use App\Rozwiazanie;
use App\Temat;
use App\User;
use App\Wyklad;
use App\Zadanie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ZadaniaController extends Controller
{



    public function show($id)
    {
        $zadanie = Zadanie::find($id);


        $temat= DB::table('temat')->where('id',$zadanie->idTemat)->first();

        if($temat!=null)
        {
            $zadanie->temat=$temat->id;
        }
        else{
            $zadanie->temat="empty";
        }

        $wyklad = DB::table('wyklad')->where('idTemat',$temat->id)->get()->first();
        if($wyklad!=null)
        {
            $zadanie->wyklad=$wyklad->id;
        }
        else{
            $zadanie->wyklad="empty";
        }
        $quiz = DB::table('quiz')->where('idTemat',$temat->id)->get()->first();
        if($quiz!=null)
        {
            $zadanie->quiz=$quiz->id;
            echo $quiz->id;
        }
        else{
            $zadanie->quiz="empty";
        }



        return view('zadania.show')->with('zadanie', $zadanie);

    }

    public function edit(Request $request, $id)
    {

        echo $request->input('nazwa-tematu');
        echo $request->input('nazwa-zadania');

        if (Auth::user()->typ == \App\User::$admin) {


            $this->validate($request, [
                'nazwa-zadania' => 'required|max:100',
                'tresc-zadania' => 'max:255',
            ]);

            $temat= DB::table('temat')->where('nazwa',$request->input('nazwa-tematu'))->first();


                DB::table('zadanie')
                    ->where('id', $id)
                    ->update(['nazwa' => $request->input('nazwa-zadania'),
                        'idTemat' =>$temat->id,
                        'tresc' => $request->input('tresc-zadania'),
                        'updated_at' => Carbon::now()
                    ]);

                return redirect('/panel/')->with('success', 'Wyklad "'.$request->input('nazwa-zadania').'" został edytowany');

        }else
        {
            return redirect()->back()->with('error', trans('Brak dostepu'));
        }
    }

    public function create(Request $request)
    {

        if (Auth::user()->typ == \App\User::$admin) {


            $this->validate($request, [
                'nazwa-zadania' => 'required|max:100',
                'tresc-zadania' => 'max:255',
            ]);

            echo $request->input('nazwa-tematu');

            $temat = DB::table('temat')->where('nazwa', $request->input('nazwa-tematu'))->first();

            echo $temat->id;


            Zadanie::create(
                ['nazwa' => $request->input('nazwa-zadania'),
                    'idTemat' => $temat->id,
                    'tresc' => $request->input('tresc-zadania'),
                    'created_at' => Carbon::now()
                ]
            );

            return redirect('/panel/')->with('success', 'Uudało się dodać zadanie');


        } else {
            return redirect('/panel/')->with('errors', 'Nie udało się dodać wykładu');
        }
    }
    public function answer(Request $request, $id)
    {
        $zadanie = Zadanie::find($id);
        $temat= DB::table('temat')->where('id',$zadanie->idTemat)->first();


        if (Auth::user()->typ == \App\User::$user) {

            $this->validate($request, [
                'file' => 'required|mimes:zip'
            ]);

            if ($request->file('file')->isValid()) {

                 Rozwiazanie::create(
                    ['idZadanie' => $id,
                        'idUzytkownik' =>Auth::user()->id,
                        'Informacje' =>"Zadanie: ".$zadanie->nazwa." Treść zadania".$zadanie->tresc,
                        'created_at' => Carbon::now()
                    ]
                );


                $file =Auth::user()->id."-".$zadanie->id.'.zip';


                if ($request->file('file')->move(storage_path().'/rozwiazania/',$file)) {

                    if(Auth::user()->typ!='nauczyciel') {

                        $user = User::find(Auth::user()->id);

                        $grupa = DB::table('grupa')->where('id', $user->idGrupa)->get()->first();

                        Powiadomienie::createImportantNotification($grupa->idNauczyciel, "Uzytkownik " . Auth::user()->imie . " " . Auth::user()->nazwisko. " Przesłał rozwiązanie do zadania \"".$zadanie->nazwa."\" Grupa: ".$grupa->nazwa);
                    }

                    return redirect()->back()->with('success', 'Dodano rozwiązanie.');

                }
                else{
                    return redirect()->back()->with('errors', 'Nie udało się zapisać pliku, być może katalog nie jest zapisywalny. Daj użytkownikowi błąd.');
                }
            }
            else
            {
                return redirect()->back()->with('errors', 'Nie udało się dodać pliku!');
            }


        } else {
            return redirect()->back()->with('errors', 'Zly plik');
        }
    }

}
