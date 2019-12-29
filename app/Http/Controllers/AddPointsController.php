<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckUserType;
use App\Punkty;
use App\User;
use App\Powiadomienie;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddPointsController extends Controller
{
    public function __construct()
    {
        $this->middleware(CheckUserType::class);
    }

    public function AddPoints($id){


        $this->validate(request(), [
            'ilosc' => 'required',
            'komentarz' => 'required',
        ]);
        
        $array = [
            'idStudent' => (int)$id,
            'idNauczyciel' => Auth::user()->id,
            'ilosc' => (int)request('ilosc'),
            'komentarz' => request('komentarz')
        ];
        
        Punkty::create($array);
        
        $user = User::find($id);
        Powiadomienie::createNotification($id,"Uzytkownik ". Auth::user()->imie." ". Auth::user()->nazwisko." przyznał Ci ".request('ilosc')."pkt.");
        
        return redirect('/panel/uzytkownik/'.$id)->with('success', 'Udało się dodać punkty ('.request('ilosc').') użytkownikowi '.$user->imie." ".$user->nazwisko."!");
    }

    public function rateAnAnswer($id, $anwerID){


        $this->validate(request(), [
            'ilosc' => 'required',
            'komentarz' => 'required',
        ]);

        $array = [
            'idStudent' => (int)$id,
            'idNauczyciel' => Auth::user()->id,
            'ilosc' => (int)request('ilosc'),
            'komentarz' => request('komentarz')
        ];

        Punkty::create($array);


        DB::table('rozwiazanie')
            ->where('id', $anwerID)
            ->update(['oceniono' => "tak", 'updated_at'=>Carbon::now()]);


        $user = User::find($id);
        Powiadomienie::createNotification($id,"Uzytkownik ". Auth::user()->imie." ". Auth::user()->nazwisko." przyznał Ci punkty!:".request('ilosc')."pkt. za zadanie! Komentarz: ".request('komentarz'));

        return redirect('/panel/')->with('success', 'Udało się dodać punkty ('.request('ilosc').') użytkownikowi '.$user->imie." ".$user->nazwisko."za przesłane zadanie!");
    }

}
