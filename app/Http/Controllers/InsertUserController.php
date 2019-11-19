<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InsertUserController extends Controller
{



    public function store()
    {
        $this->validate(request(), [
            'nrAlbumu' => 'required|max:10|unique:uzytkownik',
            'haslo' => 'required|confirmed|min:6',
        ]);


        $array = [
            'nrAlbumu' => request('nrAlbumu'),
            'idGrupa' => request('idGrupa'),
            'haslo' =>  bcrypt(request('haslo')),
        ];



        $user = User::create($array);

        //auth()->login($user);

        return redirect()->back()->with('success', 'Udało się utworzyć użytkownika o numerze albumu: '.\request('nrAlbumu'));
    }


    public function activate()
    {
        $this->validate(request(), [
            'nrAlbumu' => 'required|max:10|',
            'haslo' => 'required|min:6',
            'email' => 'required|email|unique:uzytkownik',
        ]);


            $password =  bcrypt(request('haslo'));
            $user = DB::select('SELECT * FROM uzytkownik WHERE haslo="'.$password.'" and nrAlbumu="'.request('nrAlbumu').'" '); //dodatkowo należy dodać klasę bazy //use DB;


        if(!is_null($user)){

            DB::table('uzytkownik')
                ->where('nrAlbumu', request('nrAlbumu'))
                ->update(['email' => request('email')]);


            $userid = User::where('nrAlbumu', request('nrAlbumu'))->pluck('id');


            Auth::loginUsingId($userid);

            return redirect('/profil')->with('success', 'Aktywowales konto! Uzupelnij dane i zacznij korzystać z platformy');


        }else{
            return redirect('/')->withErrors('error', 'Dane są błędne!');
        }



        return redirect('/')->with('success', 'Aktywowales konto! Uzupelnij dane i zacznij korzystać z platformy'.\request('nrAlbumu'));

    }
}
