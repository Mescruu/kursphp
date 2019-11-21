<?php

namespace App\Http\Controllers;

use App\Powiadomienie;
use Illuminate\Support\Facades\DB;
use App\Grupa;
use App\Punkty;
use App\User;
use Illuminate\Http\Request;
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
        //sposób na przerzucenie zmiennej:
        $title  = 'Kurs PHP';
        if(Auth::guest()){
            return view('pages.index', compact('title'));
        }else{
            return redirect('/home');
        }
        

//        return view('pages.index')->with('title', $title);   //drugi sposób

    }


    public function about(){
        //sposób na przerzucenie zmiennej:

        $title  = 'About us';
        return view('pages.about')->with('title', $title);   //drugi sposób
    }

    public function services(){
        $data = array(
            'title'=>'Services',
            'services'=>['Web Design','Programming','SEO']
        );

        return view('pages.services')->with($data);   //drugi sposób
    }



    ////PROFIL

    public function profil(){
        //sposób na przerzucenie zmiennej:

        $adminId = DB::table('grupa')->where('id', auth()->user()->idGrupa)->first();
        Powiadomienie::createNotificationToTeacher($adminId->id,"Uzytkownik ". auth()->user()->imie." ". auth()->user()->nazwisko." wszedł w swój profil! (numer indeksu: ". auth()->user()->nrAlbumu.")");


        if(Auth::user()->typ==Auth::user()->admin)
        {
            return redirect('/panel');
        }else{
            $grupa  = Grupa::find(auth()->user()->idGrupa);
            $punkty = Punkty::where('idStudent', (auth()->user()->id))->orderBy('created_at', 'desc')->get();
            //$punkty = DB::table('punkty')->where('idStudent', auth()->user()->id);
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
                'nauczyciele' => $nauczyciele
            );
            return view('pages.profil')->with($data);
        }
    }


    public function punkty(){



        $punkty = DB::table('punkty')->where('idStudent', auth()->user()->id)->orderByRaw('created_at DESC')->get();
        $nauczyciele = array();
        $iterations = 0;
        foreach($punkty as $wpis){
            $nauczyciel = "";
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
