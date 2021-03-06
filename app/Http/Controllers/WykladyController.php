<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckUserType;
use App\Powiadomienie;
use App\Temat;
use App\Wyklad;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WykladyController extends Controller
{
    public function __construct()
    {
        $this->middleware(CheckUserType::class, ['except' => ['show']]);
    }


    public function show($id)
    {
        $name = $id . ".pdf";
        $pdf = "/wyklady/" . $name;
        echo $pdf;
        if(file_exists(storage_path().'/wyklady/'.$name)){
            return response()->file(storage_path($pdf));
        }else{
            return redirect()->back()->with('error', trans('Nie ma takiego wykładu'));
        }
    }

    public function remove($id)
    {
        $wyklad = Wyklad::find($id);
        if($wyklad!=null){
            $temat = Temat::find($wyklad->idTemat);

            if($wyklad->delete())
            {
                Powiadomienie::createNotificationWhenEdit($temat->id, "Uzytkownik ". Auth::user()->imie." ". Auth::user()->nazwisko." usunął wyklad z tematu ".$temat->nazwa);

                return redirect('/panel')->with('success', trans('Wykład został usunięty.'));
            }
        } else{
            return redirect('/panel')->with('error', trans('Coś poszło nie tak.'));
        }

    }
    public function edit(Request $request, $id)
    {
        if (Auth::user()->typ == \App\User::$admin) {

            //Wyswietlany błąd.
            $messages = [
                'mimes' => 'Plik musi być w formacie pdf.',
                'max' => 'Tytuł może mieć maksymalnie 255 znaków.'
            ];

            //Sprawdzanie danych wejsiowych
            $validator = Validator::make(request()->all(), [
                'tytul-wykladu' => 'max:255',
                'file' => 'mimes:pdf'
            ],$messages);

            //Sprawdzenie czy dane są poprawne.
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $temat= DB::table('temat')->where('nazwa',$request->input('nazwa-tematu'))->first();

            if($request->file('file')!=null){

                if ($request->file('file')->isValid()&&$request->file('file')) {

                   DB::table('wyklad')
                        ->where('id', $id)
                        ->update(['tytul' => $request->input('tytul-wykladu'),
                            'idTemat' =>$temat->id,
                            'updated_at' => Carbon::now()
                            ]);

                    $file =$id.'.pdf';

                    rename(storage_path().'/wyklady/'.$file,storage_path().'/wyklady/copy'.$file);

                    if ($request->file('file')->move(storage_path().'/wyklady/',$file)) {
                        Storage::delete(storage_path().'/wyklady/copy'.$file); // usuniecie backupu
                        $wyklad = Wyklad::find($id);
                        $temat = Temat::find($wyklad->idTemat);
                        Powiadomienie::createNotificationWhenEdit($temat->id, "Uzytkownik ". Auth::user()->imie." ". Auth::user()->nazwisko." zedytował wyklad z tematu ".$temat->nazwa);
                        return redirect('/panel/')->with('success', 'Wyklad '.$request->input('tytul-wykladu').' został edytowany.');
                    }
                    else{
                        rename(storage_path().'/wyklady/copy'.$file, storage_path().'/wyklady/'.$file);// spowrotem
                        return redirect('/panel/')->with('errors', 'Nie udało się zapisać pliku, być może katalog nie jest zapisywalny.');
                    }
                }
                else
                {
                    return redirect('/panel/')->with('errors', 'Nie udało się edytować wykładu');
                }
            }
            else{
               DB::table('wyklad')
                    ->where('id', $id)
                    ->update(['tytul' => $request->input('tytul-wykladu'),
                        'idTemat' =>$temat->id,
                        'updated_at' => Carbon::now()
                    ]);
                return redirect('/panel/')->with('success', 'Wyklad '.$request->input('tytul-wykladu').' został edytowany');
            }
        }else
        {
            return redirect()->back()->with('error', trans('Brak dostepu.'));
        }
    }

    public function create(Request $request)
    {
        if (Auth::user()->typ == \App\User::$admin) {

            //Wyswietlany błąd.
            $messages = [
                'required' => 'Pole jest wymagane',
                'mimes' => 'Plik musi być w formacie pdf.',
                'max' => 'To pole może mieć maksymalnie :attribute znaków.'
            ];

            //Sprawdzanie danych wejsiowych
            $validator = Validator::make(request()->all(), [
                'tytul-wykladu' => 'required|max:255',
                'file' => 'required|mimes:pdf'
            ],$messages);

            //Sprawdzenie czy dane są poprawne.
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            echo $request->input('nazwa-tematu');

            $temat= DB::table('temat')->where('nazwa',$request->input('nazwa-tematu'))->first();

            echo $temat->id;

            //https://www.php.net/manual/en/ini.core.php#ini.post-max-size
            if ($request->file('file')->isValid()) {

                $wyklad = Wyklad::create(
                    ['tytul' => $request->input('tytul-wykladu'),
                        'idTemat' =>$temat->id,
                    'created_at' => Carbon::now()
                    ]
                );

                $file =$wyklad->id.'.pdf';

                if ($request->file('file')->move(storage_path().'/wyklady/',$file)) {
                    return redirect('/panel/')->with('success', 'Utworzono wyklad ' . $wyklad->tytul . '.');
                }
                else{
                    return redirect('/panel/')->with('errors', 'Nie udało się zapisać pliku, być może katalog nie jest zapisywalny.');
                }
            }
            else
            {
                return redirect('/panel/')->with('errors', 'Nie udało się dodać wykładu.');
            }
        } else {
            return redirect('/panel/')->with('errors', 'Brak dostępu.');
        }
    }
}