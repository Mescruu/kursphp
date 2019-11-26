<?php

namespace App\Http\Controllers;

use App\Quiz;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuizController extends Controller
{
    //
    public function __construct()
    {
        //blokowanie jeżeli użytkownik nie przejdzie autoryzacji wtedy wysyla go do strony z logowaniem
        //wyjątkami są strony index, gdzie wysiwetlane są tematy
        $this->middleware('auth', ['except'=>['index']]);
    }

    public function show($id)
    {
        //wyswitla rzeczy zwiazane z konkretnym tematem o id $id
        $quiz = Quiz::find($id);
        return view ('quizy.show')->with('quiz', $quiz);
    }

    public function edit($id)
    {
        //wyswitla rzeczy zwiazane z konkretnym tematem o id $id
        $quiz = Quiz::find($id);
        return view ('quizy.edit')->with('quiz', $quiz);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dostarcza wszystkich danych do Kontrolera

        $quizy = Quiz::orderBy('id')->get(); //pobiera z bazy posortowane po id malejąco


        //wyswietlenie kontentu strony /posts ktory znajduje sie w resources/posts/index
        //razem ze zmienną $posts, w której znajdują się wszystkie rzeczy z modelu Post(tabela posts)
        return view('quizy.index')->with('quizy', $quizy);
    }

}
