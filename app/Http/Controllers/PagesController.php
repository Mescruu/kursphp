<?php

namespace App\Http\Controllers;

use App\Grupa;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{

    public function __construct()
    {
        //blokowanie jeżeli użytkownik nie przejdzie autoryzacji wtedy wysyla go do strony z logowaniem
        //wyjątkami są strony index, gdzie wysiwetlane są posty, oraz show gdzie po kliknięciu przechodzi się do posta
        $this->middleware('auth', ['except'=>['index']]);
    }

    public function index(){
        //sposób na przerzucenie zmiennej:
        $title  = 'Welcome to Laravel';
        return view('pages.index', compact('title'));

//        return view('pages.index')->with('title', $title);   //drugi sposób

    }


    public function about(){
        //sposób na przerzucenie zmiennej:

        $title  = 'About us';
        return view('pages.about')->with('title', $title);   //drugi sposób
    }

    public function profile(){
        //sposób na przerzucenie zmiennej:

        if(Auth::user()->typ==Auth::user()->admin)
        {
            return redirect('/panel');
        }else{
            $grupa  = Grupa::find(auth()->user()->idGrupa);
            return view('pages.profile')->with('grupa', $grupa);   //drugi sposób
        }
    }

    public function panel(){//sposób na przerzucenie zmiennej:

        //jezeli uzytkownik nie ma typu admin, wtedy zostaje przekierowany na adres profile
        if(Auth::user()->typ==Auth::user()->user)
        {
            return redirect('/profile');
        }
        else{
            return view('pages.panel');   //drugi sposób
        }
    }

    public function services(){
        $data = array(
            'title'=>'Services',
            'services'=>['Web Design','Programming','SEO']
        );

        return view('pages.services')->with($data);   //drugi sposób
    }
}
