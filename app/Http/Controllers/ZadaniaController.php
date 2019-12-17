<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckUserType;
use App\Powiadomienie;
use App\Rozwiazanie;
use App\Temat;
use App\User;
use App\Zadanie;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ZadaniaController extends Controller
{

    public function __construct()
    {
        $this->middleware(CheckUserType::class, ['except' => ['show','answer','link']]);
    }


    public  function  link($id, $user){

        if (Auth::user()->typ == \App\User::$admin) {
            $zadanie = Zadanie::find($id);
            $file = $user."-".$zadanie->id.'.zip';
        }
        else{
            $zadanie = Zadanie::find($id);
            $file =Auth::user()->id."-".$zadanie->id.'.zip';
        }

        if($file==null){
            return redirect()->back()->with('error', trans('Nie ma takiego pliku'));

        }else{
            return response()->download(
                storage_path()."/rozwiazania/".$id."/".$file,
                $file,
                [],
                'inline'
            );
        }
    }


    public function show($id)
    {
        $zadanie = Zadanie::find($id);

        $temat= DB::table('temat')->where('id',$zadanie->idTemat)->first();

        $rozwiazanie = DB::table('rozwiazanie')->where('idZadanie',$id)->Where('idUzytkownik',Auth::user()->id)->first();

        if($rozwiazanie!=null){
            $zadanie->oceniono = $rozwiazanie->oceniono;
        }else
        {
            $zadanie->oceniono = "nie";
        }

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
        }
        else{
            $zadanie->quiz="empty";
        }

        $file =Auth::user()->id."-".$zadanie->id.'.zip';



        if (file_exists(storage_path()."/rozwiazania/".$id."/".$file)){

//            $privateFile = Storage::files(storage_path()."rozwiazania/".$file);

            $zadanie->url="link";

        }else{
            $zadanie->url="empty";
        }


        return view('zadania.show')->with('zadanie', $zadanie);
    }
    public function redirectToEdit($id)
    {
        session(['editTask'=>$id]);
        return redirect('/panel/');
    }

    public function edit(Request $request, $id)
    {


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

            $zadanie = Zadanie::find($id);

            $temat = Temat::find($zadanie->idTemat);
            Powiadomienie::createNotificationWhenEdit($temat->id, "Uzytkownik ". Auth::user()->imie." ". Auth::user()->nazwisko." zedytował zadanie z tematu ".$temat->nazwa);


                return redirect('/panel/')->with('success', 'Zadanie "'.$request->input('nazwa-zadania').'" zostało edytowane.');

        }else
        {
            return redirect()->back()->with('error', trans('Brak dostepu!'));
        }
    }

    public function create(Request $request)
    {

        if (Auth::user()->typ == \App\User::$admin) {


            $this->validate($request, [
                'nazwa-zadania' => 'required|max:100',
                'tresc-zadania' => 'max:255',
            ]);


            $temat = DB::table('temat')->where('nazwa', $request->input('nazwa-tematu'))->first();



            Zadanie::create(
                ['nazwa' => $request->input('nazwa-zadania'),
                    'idTemat' => $temat->id,
                    'tresc' => $request->input('tresc-zadania'),
                    'created_at' => Carbon::now()
                ]
            );

            return redirect('/panel/')->with('success', 'Udało się dodać zadanie.');


        } else {
            return redirect('/panel/')->with('errors', 'Brak dostępu.');
        }
    }

    public function remove($id)
    {

        if (Auth::user()->typ == \App\User::$admin) {
            $zadanie=Zadanie::find($id);

            if($zadanie!=null){
                $temat = Temat::find($zadanie->idTemat);
                Powiadomienie::createNotificationWhenEdit($temat->id, "Uzytkownik ". Auth::user()->imie." ". Auth::user()->nazwisko." usunął zadanie z tematu ".$temat->nazwa);

                $rozwiazania = DB::table('rozwiazanie')->where('idZadanie', $id);
                $rozwiazania->delete();

                $zadanie->delete();

                Storage::disk('rozwiazania')->deleteDirectory($id);

                return redirect('/panel/')->with('success', 'Udało się usunąć zadanie.');
            }
            else{
                return redirect('/panel/')->with('errors', 'Nie ma takiego zadania.');

            }


        } else {
            return redirect('/panel/')->with('errors', 'Brak dostępu.');
        }
    }

    public function answer(Request $request, $id)
    {
        $zadanie = Zadanie::find($id);
        $temat= DB::table('temat')->where('id',$zadanie->idTemat)->first();



            $this->validate($request, [
                'file' => 'required|mimes:zip'
            ]);

            if ($request->file('file')->isValid()) {




                $file =Auth::user()->id."-".$zadanie->id.'.zip';

                if (file_exists(storage_path()."/rozwiazania/".$id."/".$file)){

                    $msg=" zaktualizował";

                    DB::table('rozwiazanie')
                        ->where('idZadanie', $id)->where('idUzytkownik', Auth::user()->id)
                        ->update(['updated_at' => Carbon::now()]);

                }else{
                    $msg=" przesłał";

                    Rozwiazanie::create(
                        ['idZadanie' => $id,
                            'idUzytkownik' =>Auth::user()->id,
                            'oceniono' =>"nie",
                            'Informacje' =>"Zadanie: ".$zadanie->nazwa." Treść zadania".$zadanie->tresc,
                            'created_at' => Carbon::now()
                        ]
                    );

                }

                File::makeDirectory(storage_path()."/rozwiazania/".$id, $mode = 0777, true, true);

                if ($request->file('file')->move(storage_path().'/rozwiazania/'.$id,$file)) {



                    if(Auth::user()->typ!='nauczyciel') {

                        $user = User::find(Auth::user()->id);

                        $grupa = DB::table('grupa')->where('id', $user->idGrupa)->get()->first();

                        Powiadomienie::createImportantNotification($grupa->idNauczyciel, "Uzytkownik " . Auth::user()->imie . " " . Auth::user()->nazwisko. $msg." rozwiązanie do zadania \"".$zadanie->nazwa."\", Grupa: ".$grupa->nazwa);
                    }

                    return redirect()->back()->with('success', 'Dodano rozwiązanie.');

                }
                else{
                    return redirect()->back()->with('errors', 'Nie udało się zapisać pliku, być może katalog nie jest zapisywalny.');
                }
            }
            else
            {
                return redirect()->back()->with('errors', 'Nie udało się dodać pliku!');
            }

    }

}
