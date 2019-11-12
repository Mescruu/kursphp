<?php

namespace App\Http\Controllers;

use App\Temat;
use Illuminate\Http\Request;

class TematyController extends Controller
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
        $temat = Temat::find($id);
        return view ('tematy.show')->with('temat', $temat);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dostarcza wszystkich danych do Kontrolera

        $tematy = Temat::orderBy('id','desc')->get(); //pobiera z bazy posortowane po id malejąco


        //wyswietlenie kontentu strony /posts ktory znajduje sie w resources/posts/index
        //razem ze zmienną $posts, w której znajdują się wszystkie rzeczy z modelu Post(tabela posts)
        return view('tematy.index')->with('tematy', $tematy);
    }


}
