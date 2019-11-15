<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Grupa;
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

    public function profil(){
        //sposób na przerzucenie zmiennej:

        if(Auth::user()->typ==Auth::user()->admin)
        {
            return redirect('/panel');
        }else{
            $grupa  = Grupa::find(auth()->user()->idGrupa);
            $punkty = DB::table('punkty')->where('idStudent', auth()->user()->id);
            $nazwaGrupy = 'Brak';
            $iloscPunktow = 0;
            if($grupa){
                $nazwaGrupy = $grupa->nazwa;
            }
            if($punkty){
                $wpisy = $punkty->pluck('ilosc')->toArray();
                foreach($wpisy as $wpis){
                    $iloscPunktow += $wpis;
                }
            }
            $data = array(
                'nazwaGrupy' => $nazwaGrupy,
                'iloscPunktow' => $iloscPunktow
            );
            return view('pages.profil')->with($data);
        }
    }

    public function panel(){//sposób na przerzucenie zmiennej:

        //jezeli uzytkownik nie ma typu admin, wtedy zostaje przekierowany na adres profile
        if(Auth::user()->typ==Auth::user()->user)
        {
            return redirect('/profil');
        }
        else{
            $data = array(
                //'usersNotAssigned' => DB::table('uzytkownik')->where('idGrupa', null)->get(),
                'grupy' => DB::table('grupa')->pluck('nazwa'),
                //'usersAssigned' => DB::table('uzytkownik')->where('idGrupa', !null)->get()
                );
            
            //$grupy = DB::table('grupa')->get();
            return view('pages.panel')->with($data);
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

    public function services(){
        $data = array(
            'title'=>'Services',
            'services'=>['Web Design','Programming','SEO']
        );

        return view('pages.services')->with($data);   //drugi sposób
    }
}
