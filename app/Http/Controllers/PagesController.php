<?php

namespace App\Http\Controllers;

use App\Grupa;
use Illuminate\Http\Request;

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

        $grupa  = Grupa::find(auth()->user()->idGrupa);

        return view('pages.profile')->with('grupa', $grupa);   //drugi sposób
    }


    public function services(){
        $data = array(
            'title'=>'Services',
            'services'=>['Web Design','Programming','SEO']
        );

        return view('pages.services')->with($data);   //drugi sposób
    }
}
