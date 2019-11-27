<?php

namespace App\Http\Controllers;

use App\Grupa;
use App\Powiadomienie;
use App\Pytanie;
use App\Quiz;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

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
        $quiz = Quiz::find($id);
        $pytania = Pytanie::get()->where('idQuiz', $id);

        $index=0;

        $seed = rand(100,10000);

        foreach ($pytania as $pytanie){
            $index++;
            $pytanie->nr = $index;

            $array=[
                'odpPoprawna'=>$pytanie->odpPoprawna,
                'odpA'=>$pytanie->odpA,
                'odpB'=>$pytanie->odpB,
                'odpC'=>$pytanie->odpC
            ];




            $table = array_values($array);

           $this->seedShuffle($table,$seed+$index);


            $pytanie->a=$table[0];
            $pytanie->b=$table[1];
            $pytanie->c=$table[2];
            $pytanie->d=$table[3];
        }


        $iloscPytan=count($pytania);

        return view ('quizy.show', ['pytania'=>$pytania,'ilosc'=>$iloscPytan, 'id'=>$id,'typ' => $quiz->typ, 'seed'=>$seed]);

    }


    public function checkAnswers(Request $request,$id)
    {


        $pytania = Pytanie::get()->where('idQuiz', $id);

        $iloscPytan = count($pytania);

        $index=0;

        $allPoints=0;


        $seed=(int)$request->input('seed')-count($pytania)+4;


        foreach ($pytania as $pytanie){
            $index++;
            $pytanie->nr = $index;


            if ($request->input('odpowiedz'.$index)!=nullOrEmptyString()){

                $pytanie->twojaOdp = $request->input('odpowiedz'.$index);

                if($pytanie->odpPoprawna==($request->input('odpowiedz'.$index))){

                    $allPoints++;


                }
            }

            //szuflowanie pytań

            $array=[
                'odpPoprawna'=>$pytanie->odpPoprawna,
                'odpA'=>$pytanie->odpA,
                'odpB'=>$pytanie->odpB,
                'odpC'=>$pytanie->odpC
            ];


            $table = array_values($array);

            $this->seedShuffle($table,$seed+$index);

            $pytanie->a=$table[0];
            $pytanie->b=$table[1];
            $pytanie->c=$table[2];
            $pytanie->d=$table[3];

        }

        return view ('quizy.odpowiedzi', ['pytania'=>$pytania,'wszystkiePunkty'=>$iloscPytan, 'id'=>$id,'zdobytePunkty' => $allPoints]);
    }


    function seedShuffle(array &$array, $seed) {

        mt_srand($seed);
        $size = count($array);
        for ($i = 0; $i < $size; ++$i) {
            list($chunk) = array_splice($array, mt_rand(0, $size-1), 1);
            array_push($array, $chunk);
        }
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
    {


        $error=false;

        foreach (Input::except('credit_card') as $req)
        {
            if(empty($req))
            {
             $error=true;
            }
        }

        if ($error){
            return redirect()->back()->with('error', trans('Cos poszlo nie tak! Czy na pewno wszystkie pola są uzupełnione? '));
        }
        else{

            $limit = (sizeof($request->all())-4)/5;

            $pytanie= DB::table('pytanie')->where('idQuiz',$request->input('id'));
            $pytanie->delete();

            for ($index=1;$index<=$limit;$index++){

                $array = [
                    'idQuiz' => $request->input('id'),
                    'tresc' => $request->input('tresc'.$index),
                    'odpPoprawna' => $request->input('odpPoprawna'.$index),
                    'odpA' => $request->input('odpA'.$index),
                    'odpB' => $request->input('odpB'.$index),
                    'odpC' => $request->input('odpC'.$index),
                    'created_at' => Carbon::now()
                ];

                Pytanie::create($array);
            }

            return redirect('quizy/'.$request->input('id'))->with('success', trans('Quiz został poprawnie załadowany'));

        }

    }


    public function remove($id)
    {
        $pytanie= DB::table('pytanie')->where('idQuiz',$id);
        $pytanie->delete();

        //wyswitla rzeczy zwiazane z konkretnym tematem o id $id
       if(Quiz::find($id)->delete())
       {
           return redirect('/panel')->with('success', trans('Usnięty został Quiz'));

       }else{
           return redirect('/panel')->with('error', trans('Coś poszło źle'));
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
