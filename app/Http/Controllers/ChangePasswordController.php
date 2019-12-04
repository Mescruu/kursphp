<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function changePassword(){



        if (!(\Hash::check(request('current-password'), Auth::user()->haslo))) {
            // The passwords matches
            return redirect()->back()->with("error","Aktualne hasło nie zgadza się z Twoim obecnym hasłem!");
        }

        if(strcmp(request('current-password'), request('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","Nowe hasło nie może być takie samo jak obecne!");
        }

        $this->validate(request(), [
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->haslo = bcrypt(request('new-password'));
        $user->save();




        return redirect()->back()->with("success","Password changed successfully !");

    }
}