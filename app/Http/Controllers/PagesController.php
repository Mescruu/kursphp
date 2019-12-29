<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Grupa;
use App\Punkty;
use App\User;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{

    public function __construct()
    {
        //blokowanie jeżeli użytkownik nie przejdzie autoryzacji wtedy wysyla go do strony z logowaniem
        //wyjątkami są strony index, gdzie wysiwetlane są posty, oraz show gdzie po kliknięciu przechodzi się do posta
        $this->middleware('auth', ['except'=>['index']]);
    }

    public function index(){
        $title  = 'Kurs PHP';
        if(Auth::guest()){
            return view('pages.index', compact('title'));
        }else{
            return redirect('/home');
        }
    }
    
    public function home(){
        return view('pages.home');
    }

    ////PROFIL

    public function profil(){

        DB::table('grupa')->where('id', auth()->user()->idGrupa)->first();
        $notification = DB::table('powiadomienie')->where('idUzytkownik', Auth::user()->id)->orderBy('created_at','desc')->get();

        if(Auth::user()->typ==User::$admin)
        {
            return redirect('/panel');
        }else{
            $grupa  = Grupa::find(auth()->user()->idGrupa);
            $punkty = Punkty::where('idStudent', (auth()->user()->id))->orderBy('created_at', 'desc')->get();
            $nazwaGrupy = 'Brak';
            $iloscPunktow = 0;
            $nauczyciele = [];
            if($grupa){
                $nazwaGrupy = $grupa->nazwa;
            }
            if($punkty){
                foreach($punkty as $wpis){
                    $iloscPunktow += $wpis->ilosc;
                    $nauczyciel = DB::table('uzytkownik')->where('id', $wpis->idNauczyciel)->value('imie') . " " . DB::table('uzytkownik')->where('id', $wpis->idNauczyciel)->value('nazwisko');
                    $nauczyciele[$wpis->id] = $nauczyciel;
                }
            }
            $data = array(
                'nazwaGrupy' => $nazwaGrupy,
                'iloscPunktow' => $iloscPunktow,
                'punkty' => $punkty,
                'nauczyciele' => $nauczyciele,
                'notification' => $notification
            );
            return view('pages.profil')->with($data);
        }
    }


    public function punkty(){
        $punkty = DB::table('punkty')->where('idStudent', auth()->user()->id)->orderByRaw('created_at DESC')->get();
        $nauczyciele = array();
        $iterations = 0;
        foreach($punkty as $wpis){
            $temp = DB::table('uzytkownik')->where('id', $wpis->idNauczyciel)->first();
            $nauczyciel = $temp->imie . " " . $temp->nazwisko;
            array_push($nauczyciele, $nauczyciel);
            $iterations++;
        }
        $data = array(
            'iterations' => $iterations,
            'ilosc' => $punkty->pluck('ilosc')->toArray(),
            'komentarz' => $punkty->pluck('komentarz')->toArray(),
            'nauczyciel' => $nauczyciele,
            'data' => $punkty->pluck('created_at')->toArray()
        );
        return view('pages.punkty')->with($data);
    }
}
