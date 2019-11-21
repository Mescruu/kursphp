<?php

namespace App\Http\Controllers;

use App\Grupa;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminFeaturesController extends Controller
{


    //ADMIN

    public function panel()
    {//sposób na przerzucenie zmiennej:

        //jezeli uzytkownik nie ma typu admin, wtedy zostaje przekierowany na adres profile
        if (Auth::user()->typ == Auth::user()->user) {
            return redirect('/profil');
        } else {
            $data = array(
                //'usersNotAssigned' => DB::table('uzytkownik')->where('idGrupa', null)->get(),
                'grupy' => DB::table('grupa')->pluck('nazwa'),
                //'usersAssigned' => DB::table('uzytkownik')->where('idGrupa', !null)->get()
            );

            $studenci = DB::table('uzytkownik')->where('typ', 'student')->get();
            $nauczyciele = DB::table('uzytkownik')->where('typ', 'nauczyciel')->get();
            $user = User::get(); //pobierz wszystkich uzytkownikow
            $group = Grupa::get(); //pobierz wszystkie grupy
            $notification = DB::table('powiadomienie')->where('idUzytkownik', Auth::user()->id)->get();

            //$grupy = DB::table('grupa')->get();
            return view('pages.admin.panel',['user' => $user,'group'=>$group, 'studenci'=>$studenci, 'nauczyciele'=>$nauczyciele,'notification'=>$notification])->with($data);
        }
    }

    public function Groups()
    {//sposób na przerzucenie zmiennej:

        return view('pages.admin.editgroup');
    }

    public function Student()
    {//sposób na przerzucenie zmiennej:

        $grupy = DB::table('grupa')->get();

        return view('pages.admin.dodajstudenta')->with('grupy', $grupy);
    }
    
    public function Nauczyciel()
    {//sposób na przerzucenie zmiennej:

        return view('pages.admin.dodajnauczyciela');
    }
    
    public function EditUser($id){
        $user = DB::table('uzytkownik')->where('id', $id)->first();
        $nazwaGrupy = DB::table('grupa')->where('id', $user->idGrupa)->value('nazwa');
        $punkty = DB::table('punkty')->where('idStudent', $id);
        $iloscPunktow = 0;
        if($punkty){
            $wpisy = $punkty->pluck('ilosc')->toArray();
            foreach($wpisy as $wpis){
                $iloscPunktow += $wpis;
            }
        }
        
        $data = array(
                'user' => $user,
                'nazwaGrupy' => $nazwaGrupy,
                'iloscPunktow' => $iloscPunktow
            );
        
        return view('pages.admin.edituser')->with($data);
    }
}