<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckUserType;
use App\Powiadomienie;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InsertUserController extends Controller
{

    //ADMIN
    public function __construct()
    {
        $this->middleware(CheckUserType::class, ['except' => ['activate']]);
    }


    public function storeStudent()
    {

        //Wyswietlany błąd.
        $messages = [
            'required' => 'Wszystkie pola są wyamgane',
            'max' => 'To pole może mieć maksymalnie 10 znaków.',
            'unique' => 'Już istnieje wpis o takiej wartości.'
        ];

        //Sprawdzanie danych wejsiowych
        $validator = Validator::make(request()->all(), [
            'imie' => 'required',
            'nazwisko' => 'required',
            'nrAlbumu' => 'required|max:10|unique:uzytkownik',
        ],$messages);

        //Sprawdzenie czy dane są poprawne.
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


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

        //Wyswietlany błąd.
        $messages = [
            'required' => 'Wszystkie pola są wyamgane',
            'email' => 'To pole musi mieć format email',
            'confirmed' => 'Podane hasła muszą być takie same.',
            'unique' => 'Już istnieje wpis o takiej wartości.',
            'min' => 'Hasło musi mieć co najmniej 6 znaków'
        ];

        //Sprawdzanie danych wejsiowych
        $validator = Validator::make(request()->all(), [
            'email' => 'required|email|unique:uzytkownik',
            'haslo' => 'required|confirmed|min:6',
        ],$messages);

        //Sprawdzenie czy dane są poprawne.
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


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

        //Wyswietlany błąd.
        $messages = [
            'required' => 'Wszystkie pola są wyamgane',
            'email' => 'To pole musi mieć format email',
            'unique' => 'Już istnieje :attribute o takiej wartości.',
            'min' => 'Hasło musi mieć co najmniej 6 znaków',
            'max' => 'Numer albumu może mieć maksymalnie 10 znaków'
        ];

        //Sprawdzanie danych wejsiowych
        $validator = Validator::make(request()->all(), [
            'nrAlbumu' => 'required|max:10|',
            'haslo' => 'required|min:6',
            'email' => 'required|email|unique:uzytkownik'
        ],$messages);

        //Sprawdzenie czy dane są poprawne.
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


            $password =  bcrypt(request('haslo'));
            $user = DB::select('SELECT * FROM uzytkownik 
            WHERE haslo="'.$password.'" and nrAlbumu="'.request('nrAlbumu').'" ');

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
