<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class DashBoardController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //blokowanie jeżeli użytkownik nie przejdzie autoryzacji:
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //szukam postów według identyfikatora użytkownika (który jest zbierany, gdy użytkownik loguje się), bezpośrednio wyszukując za pomocą funkcji Post :: where ..

        $user_id = auth() ->user() ->id;//pobieramy id usera
        $posts = Post::where('user_id', $user_id) ->get() ;//userModell znajdz usera o takim id.
        return view('dashboard')->with('posts', $posts) ;// pobierz post z idUsera.
    }
}
