<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function changePassword(){



        if (!(\Hash::check(request('current-password'), Auth::user()->haslo))) {
            // hasła nie są takie same
            return redirect()->back()->with("error","Aktualne hasło nie zgadza się z Twoim obecnym hasłem!");
        }

        if(strcmp(request('current-password'), request('new-password')) == 0){
            //hasła są takie same
            return redirect()->back()->with("error","Nowe hasło nie może być takie samo jak obecne!");
        }

        //Wyswietlany błąd.
        $messages = [
            'exists' => 'Ten :attribute - nie zgadza się.',
            'string' => 'Hasło musi być łańcuchem znaków.',
            'confirmed' => 'Hasła nie są takie same.',
            'min' => 'Pole z hasłem musi zawierać conajmniej 6 znaków'
        ];

        //Sprawdzanie danych wejsiowych
        $validator = Validator::make(request()->all(), [
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ],$messages);

        //Sprawdzenie czy dane są poprawne.
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        //Change Password
        $user = Auth::user();
        $user->haslo = bcrypt(request('new-password'));
        $user->save();

        return redirect()->back()->with("success","Password changed successfully !");
    }
}