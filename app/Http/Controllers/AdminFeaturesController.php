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

            $user = User::get(); //pobierz wszystkich uzytkownikow
            $group = Grupa::get(); //pobierz wszystkie grupy

            //$grupy = DB::table('grupa')->get();
            return view('pages.admin.panel',['user' => $user,'group'=>$group])->with($data);
        }
    }

    public function Groups()
    {//sposób na przerzucenie zmiennej:

        return view('pages.admin.editgroup');
    }

    public function Users()
    {//sposób na przerzucenie zmiennej:

        $grupy = DB::table('grupa')->get();

        return view('pages.admin.edituser')->with('grupy', $grupy);
    }
}