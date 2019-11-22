<?php

namespace App\Http\Controllers;

use App\Punkty;
use App\User;
use App\Powiadomienie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddPointsController extends Controller
{
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
        
        $punkty = Punkty::create($array);
        
        $user = User::find($id);
        Powiadomienie::createNotification($id,"Uzytkownik ". Auth::user()->imie." ". Auth::user()->nazwisko." przyznał Ci punkty!:".request('ilosc')."pkt");
        
        return redirect('/panel/uzytkownik/'.$id)->with('success', 'Udało się dodać punkty ('.request('ilosc').') użytkownikowi '.$user->imie." ".$user->nazwisko."!");
        
    }
}
