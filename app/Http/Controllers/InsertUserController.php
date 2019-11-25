<?php

namespace App\Http\Controllers;

use App\Powiadomienie;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InsertUserController extends Controller
{



    public function storeStudent()
    {
        $this->validate(request(), [
            'imie' => 'required',
            'nazwisko' => 'required',
            'nrAlbumu' => 'required|max:10|unique:uzytkownik',
        ]);


        $array = [
            'imie' => request('imie'),
            'nazwisko' => request('nazwisko'),
            'nrAlbumu' => request('nrAlbumu'),
            'typ' => User::$user,
            'idGrupa' => DB::table('grupa')->where('nazwa', request('grupa'))->value('id'),
            'haslo' =>  bcrypt(request('imie').request('nrAlbumu')),
        ];



        $student = User::create($array);

        //auth()->login($user);

        return redirect()->back()->with('success', 'Udało się utworzyć studenta o numerze albumu: '.\request('nrAlbumu'));
    }
    
    public function createTeacher() //NIE DZIAŁA?
    {
        $this->validate(request(), [
            'email' => 'required|email|unique:uzytkownik',
            'haslo' => 'required|confirmed|min:6',
        ]);

        $array = [
            'imie' => request('imie'),
            'nazwisko' => request('nazwisko'),
            'email' => request('email'),
            'haslo' =>  bcrypt(request('haslo')),
            'typ' => 'nauczyciel',
        ];

        $nauczyciel = User::create($array);

        //auth()->login($user);

        return redirect()->back()->with('success', 'Udało się utworzyć nauczyciela: '.\request('imie')." ".\request('nazwisko'));
    }


    public function activate()
    {
        $this->validate(request(), [
            'nrAlbumu' => 'required|max:10|',
            'haslo' => 'required|min:6',
            'email' => 'required|email|unique:uzytkownik'
        ]);


            $password =  bcrypt(request('haslo'));
            $user = DB::select('SELECT * FROM uzytkownik WHERE haslo="'.$password.'" and nrAlbumu="'.request('nrAlbumu').'" '); //dodatkowo należy dodać klasę bazy //use DB;


        if(!is_null($user)){

            DB::table('uzytkownik')
                ->where('nrAlbumu', request('nrAlbumu'))
                ->update(['email' => request('email'), 'typ' => 'student']);


            $userid = User::where('nrAlbumu', request('nrAlbumu'))->pluck('id')->first();



            Auth::loginUsingId($userid);


            return redirect('/profil')->with('success', 'Aktywowales konto! Uzupelnij dane i zacznij korzystać z platformy.');


        }else{
            return redirect('/')->withErrors('error', 'Dane są błędne!');
        }



        //return redirect('/')->with('success', 'Aktywowales konto! Uzupelnij dane i zacznij korzystać z platformy'.\request('nrAlbumu'));

    }
}
