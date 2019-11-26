<?php

namespace App\Http\Controllers;

use App\Pytanie;
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
        $pytania = Pytanie::get()->where('idQuiz', $id);

        $index=0;
        foreach ($pytania as $pytanie){
           $index++;
            $pytanie->nr = $index;
        }

        $iloscPytan=count($pytania);

        return view ('quizy.edit', ['pytania'=>$pytania,'ilosc'=>$iloscPytan, 'id'=>$id,'typ' => $quiz->typ]);
    }

    public function confirm(Request $request)
    {//sposób na przerzucenie zmiennej:

        //sposób na przerzucenie zmiennej:

        $index=1;
        foreach ($request as $item){

            //na razie tylko wyswietlanie
            if($index==1){
                echo $request->input('tresc'.$index)." - ";
                echo $request->input('odpPoprawna'.$index)." - ";
                echo $request->input('odpA'.$index)." - ";
                echo $request->input('odpB'.$index)." - ";
                echo $request->input('odpC'.$index)." </br> ";
            }

            $index++;
        }

//        return redirect()->back()->withErrors(['email' => trans('Coś poszło nie tak. Spróbuj ponownie za chwilę.')]);
    }


    public function remove($id)
    {
        //wyswitla rzeczy zwiazane z konkretnym tematem o id $id
       if(Quiz::find($id)->delete())
       {
           return view ('pages.admin.panel')->with('success', trans('Usnięty został Quiz'));

       }else{
           return view ('pages.admin.panel')->with('error', 'Coś poszło źle');

       }

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
