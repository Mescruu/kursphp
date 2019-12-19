<?php

namespace App\Http\Controllers;

use App\Mail\SendResetEmail;
use App\Temat;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class NewPasswordController extends Controller
{
    public function validatePasswordRequest (Request $request){

            Auth::logout();

        $user = DB::table('uzytkownik')->where('email', '=', $request->email)->first();

        //Sprawdz czy user istnieje.
        if ($user==null) {
            return redirect()->back()->withErrors(['email' => trans('Uzytkownik o takim mailu nie istnieje.')]);
        }

//Tworzenie tokenu resetowania hasła
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => str_random(60),
            'created_at' => Carbon::now()
        ]);

        //pobranie tokenu potrzebnego do utworzenia nowego hasła.
            $tokenData = DB::table('password_resets')
            ->where('email', $request->email)->first();

        if ($this->sendResetEmail($request->email, $tokenData->token)) {
            //Jezeli się uda:
            return redirect()->back()->with('status', trans('Link do zresetowania hasła został wysłany na Twój adres e-mail.'));
        } else {
            //w razie błędu z wysłaniem maila (bład w funkcji sendResetEmail)
            return redirect()->back()->withErrors(['error' => trans('Wystąpił błąd sieci. Proszę spróbuj ponownie.')]);
        }
    }


    private function sendResetEmail($email, $token)
    {
        //Pobranie uzytkownika z bazy danych.
        $user = DB::table('uzytkownik')->where('email', $email)->select('imie', 'email')->first();
        //Generowanie linku do resetowania hasła. Wygenerowany token jest w nim osadzony
        $link = url('/').'/password/reset/' . $token . '?email=' . urlencode($user->email);
        try {

            Mail::to($email)->send(new SendResetEmail('Resetowanie hasła.', $link, $user->imie));

            //Wysylanie maila z linkiem
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    public function resetPassword(Request $request)
    {

        //Wyswietlany błąd.
        $messages = [
            'exists' => 'Ten :attribute - nie zgadza się.',
            'required' => 'Wszystkie pola są wymagane.',
            'confirmed' => 'Hasła nie są takie same.',
            'min' => 'Pole z hasłem musi zawierać conajmniej 6 znaków'
        ];

        //Sprawdzanie danych wejsiowych
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255|exists:uzytkownik,email',
            'password' => 'required|min:6|confirmed'
        ],$messages);



        //Sprawdzenie czy dane są poprawne.

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $password = $request->password;
// Sprawdzenie tokena
        $tokenData = DB::table('password_resets')
            ->where('token', $request->token)->first();


// Redirect the user back to the password reset request form if the token is invalid
        if (!$tokenData) return view('auth.passwords.email');

        $user = User::where('email', $tokenData->email)->first();
// Redirect the user back if the email is invalid
        if (!$user) return redirect()->back()->withErrors(['email' => 'Email not found']);
//Hash and update the new password
        $user->haslo = \Hash::make($password);
        $user->update(); //or $user->save();

        //login the user immediately they change password successfully
        Auth::login($user);

        $tematy = Temat::orderBy('id','desc')->get(); //pobiera z bazy posortowane po id malejąco
        session(['listaTematow' => $tematy]);


        //Delete the token
        DB::table('password_resets')->where('email', $user->email)
            ->delete();

        //Jezeli się udało
        if ($this->sendSuccessEmail($tokenData->email)) {
            return view('pages.home')->with('status', trans('Udało się! Zapisz swoje nowe hasło.'));
        } else {

            if(!Auth::guest()){

                return view('pages.home')->with('status', trans('Udało się! Zapisz swoje nowe hasło.'));
            }

            return redirect()->back()->withErrors(['email' => trans('Coś poszło nie tak. Spróbuj ponownie za chwilę.')]);
        }

    }
    private function sendSuccessEmail($email)
    {

            Mail::to($email)->send(new SendResetEmail('Resetowanie hasła!', 'Twoje hasło zostało ustawione','Uzytkowniku'));

    }

}
