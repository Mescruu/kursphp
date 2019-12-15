<?php

namespace App\Http\Controllers;

use App\Grupa;
use App\Powiadomienie;
use App\Punkty;
use App\Pytanie;
use App\Quiz;
use App\Temat;
use App\User;
use App\Wynik;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class QuizController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $quiz = Quiz::find($id);
        $pytania = Pytanie::get()->where('idQuiz', $id);
        $wynik = DB::table('wynik')
                ->where('idQuiz', $id)
                ->where('idUzytkownik', Auth::user()->id)
                ->first();


        $wyklad = DB::table('wyklad')->where('idTemat',$quiz->idTemat)->get()->first();
        if($wyklad!=null)
        {
            $quiz->wyklad=$wyklad->id;
        }
        else{
            $quiz->wyklad="empty";
        }
        $temat = DB::table('temat')->where('id',$quiz->idTemat)->get()->first();
        if($temat!=null)
        {
            $quiz->temat=$temat->id;
        }
        else{
            $quiz->temat="empty";
        }
        $zadanie = DB::table('zadanie')->where('idTemat',$quiz->idTemat)->get()->first();
        if($zadanie!=null)
        {
            $quiz->zadanie=$zadanie->id;
        }
        else{
            $quiz->zadanie="empty";
        }

        if($quiz->typ==="kolokwium"&&$wynik!==null&&Auth::user()->typ!='nauczyciel'){

            return redirect('/profil')->with('error', trans('Już brałeś udział w tym kolokwium!'));
        }

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


        return view ('quizy.show', ['pytania'=>$pytania,'ilosc'=>$iloscPytan, 'id'=>$id,'typ' => $quiz->typ,'quiz'=> $quiz, 'seed'=>$seed, 'wynik'=>$wynik]);

    }


    public function checkAnswers(Request $request,$id)
    {

        $quiz = Quiz::get()->where('id', $id)->first();

        $wyklad = DB::table('wyklad')->where('idTemat',$quiz->idTemat)->get()->first();
        if($wyklad!=null)
        {
            $quiz->wyklad=$wyklad->id;
        }
        else{
            $quiz->wyklad="empty";
        }
        $temat = DB::table('temat')->where('id',$quiz->idTemat)->get()->first();
        if($temat!=null)
        {
            $quiz->temat=$temat->id;
        }
        else{
            $quiz->temat="empty";
        }
        $zadanie = DB::table('zadanie')->where('idTemat',$quiz->idTemat)->get()->first();
        if($zadanie!=null)
        {
            $quiz->zadanie=$zadanie->id;
        }
        else{
            $quiz->zadanie="empty";
        }



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

        $results=[
            'idQuiz'=>$id,
            'idUzytkownik'=>Auth::user()->id,
            'wynik'=>$allPoints.'/'.$index,
            'created_at'=>Carbon::now()
        ];



        if($quiz->typ=="kolokwium"){

            $user =  Auth::user();

            if(Auth::user()->typ!='nauczyciel'){

                $grupa = DB::table('grupa')->where('id',$user->idGrupa)->get()->first();

                Powiadomienie::createImportantNotification($grupa->idNauczyciel,"Uzytkownik ". Auth::user()->imie." ". Auth::user()->nazwisko." uzyskał ".$allPoints.'/'.$index." punktów z kolokwium");


                $array2 = [
                    'idStudent' => (int)$user->id,
                    'idNauczyciel' => $grupa->idNauczyciel,
                    'ilosc' => $allPoints*$quiz->mnoznik,
                    'komentarz' => 'Kolokwium z '.Carbon::now()
                ];


                $nauczyciel = DB::table('uzytkownik')->where('id',$grupa->idNauczyciel)->get()->first();
                Punkty::create($array2);
                Powiadomienie::createNotification($user->id,"Uzytkownik ". $nauczyciel->imie." ". $nauczyciel->nazwisko." przyznał Ci punkty!:".$allPoints."pkt za kolokwium!");
            }

        }
        
        $wynik = DB::table('wynik')->where('idQuiz', $id)->where('idUzytkownik', Auth::user()->id)->first();
        if($wynik != null){
            DB::table('wynik')->where('idQuiz', $id)->where('idUzytkownik', Auth::user()->id)->update(['wynik' => $results['wynik'], 'updated_at' => Carbon::now()]);
        }else{
            Wynik::create($results);
        }
        
        return view ('quizy.odpowiedzi', ['pytania'=>$pytania,'wszystkiePunkty'=>$iloscPytan, 'quiz'=>$quiz, 'id'=>$id,'zdobytePunkty' => $allPoints]);
    }


    function seedShuffle(array &$array, $seed) {

        mt_srand($seed);
        $size = count($array);
        for ($i = 0; $i < $size; ++$i) {
            list($chunk) = array_splice($array, mt_rand(0, $size-1), 1);
            array_push($array, $chunk);
        }
    }


    public function create()
    {
        //wyswitla rzeczy zwiazane z konkretnym tematem o id $id

        $tematy=Temat::get();

        return view ('quizy.create')->with('tematy', $tematy);
    }

    public function edit($id)
    {
        //wyswitla rzeczy zwiazane z konkretnym tematem o id $id


        $quiz = Quiz::find($id);
        $pytania = Pytanie::get()->where('idQuiz', $id);

        $wyklad = DB::table('wyklad')->where('idTemat',$quiz->idTemat)->get()->first();
        if($wyklad!=null)
        {
            $quiz->wyklad=$wyklad->id;
        }
        else{
            $quiz->wyklad="empty";
        }
        $temat = DB::table('temat')->where('id',$quiz->idTemat)->get()->first();
        if($temat!=null)
        {
            $quiz->temat=$temat->id;
        }
        else{
            $quiz->temat="empty";
        }
        $zadanie = DB::table('zadanie')->where('idTemat',$quiz->idTemat)->get()->first();
        if($zadanie!=null)
        {
            $quiz->zadanie=$zadanie->id;
        }
        else{
            $quiz->zadanie="empty";
        }



        $index=0;
        foreach ($pytania as $pytanie){
           $index++;
            $pytanie->nr = $index;
        }

        $iloscPytan=count($pytania);

        $tematy=Temat::get();
        $nazwaTematu = DB::table('temat')->where('id',$id)->value('nazwa');


        return view ('quizy.edit', ['nazwaTematu'=>$nazwaTematu,'tematy'=>$tematy, 'pytania'=>$pytania,'ilosc'=>$iloscPytan, 'quiz'=>$quiz, 'id'=>$id,'typ' => $quiz->typ]);
    }

    public function confirm(Request $request)
    {

        $request->input('mnoznik');


        $error=false;

        foreach (Input::except('credit_card') as $req)
        {
            if(empty($req))
            {
                var_dump($req);

                $error=true;
            }

        }

        if ($error){
            return redirect()->back()->with('error', trans('Cos poszlo nie tak! Czy na pewno wszystkie pola są uzupełnione? '));
        }
        else{

            $limit = (sizeof($request->all())-6)/5;


            if($request->input('id')=='new')
            {

                $temat = DB::table('temat')->where('nazwa', $request->input('nazwa-tematu'))->first();

                $array = [
                    'idTemat' => $temat->id,
                    'typ' => $request->input('typ'),
                    'mnoznik' => $request->input('mnoznik'),
                    'created_at' => Carbon::now()
                ];

                $quiz = Quiz::create($array);

                for ($index=1;$index<=$limit;$index++){

                    $array = [
                        'idQuiz' =>$quiz->id,
                        'tresc' => $request->input('tresc'.$index),
                        'odpPoprawna' => $request->input('odpPoprawna'.$index),
                        'odpA' => $request->input('odpA'.$index),
                        'odpB' => $request->input('odpB'.$index),
                        'odpC' => $request->input('odpC'.$index),
                        'created_at' => Carbon::now()
                    ];

                    Pytanie::create($array);
                }

            }else{
                $pytanie= DB::table('pytanie')->where('idQuiz',$request->input('id'));
                $pytanie->delete();

                $temat = DB::table('temat')->where('nazwa', $request->input('nazwa-tematu'))->first();

                DB::table('quiz')
                    ->where('id',$request->input('id'))
                    ->update([
                        'typ' => $request->input('typ'),
                        'idTemat' =>$temat->id,
                        'mnoznik' => $request->input('mnoznik'),
                        'updated_at' => Carbon::now()
                    ]);

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
            }
            if($request->input('id')=='new')
            {
                return redirect('quizy/'.$quiz->id)->with('success', trans('Quiz został poprawnie załadowany'));
            }
            else{
                return redirect('quizy/'.$request->input('id'))->with('success', trans('Quiz został poprawnie załadowany'));
            }

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
