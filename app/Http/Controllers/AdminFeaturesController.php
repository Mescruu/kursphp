<?php

namespace App\Http\Controllers;

use App\Grupa;
use App\Http\Middleware\CheckUserType;
use App\Rozwiazanie;
use App\Temat;
use App\User;
use App\Punkty;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class AdminFeaturesController extends Controller {

    //ADMIN
    public function __construct()
    {
        $this->middleware(CheckUserType::class);
    }

    public function panel() {

            $studenci = DB::table('uzytkownik')->where('typ', 'student')->orderBy('nazwisko', 'asc')->get();
            $nauczyciele = DB::table('uzytkownik')->where('typ', 'nauczyciel')->get();
            $group = Grupa::get();
            $notification = DB::table('powiadomienie')->where('idUzytkownik', Auth::user()->id)->orderBy('created_at','desc')->get();
            $punkty = DB::table('punkty')->orderBy('created_at', 'desc')->get();
            $kryterium = [
                'trzy' => Storage::disk('kryterium')->get('3.txt'),
                'cztery' => Storage::disk('kryterium')->get('4.txt'),
                'piec' => Storage::disk('kryterium')->get('5.txt'),
            ];
            $quizy = DB::table('quiz')->get();
            $pytania = DB::table('pytanie')->orderBy('id', 'desc')->get();
            $tematy = DB::table('temat')->orderBy('nazwa', 'asc')->get();
            $wyklady= DB::table('wyklad')->get();
            $zadania= DB::table('zadanie')->get();

            foreach ($zadania as $zadanie){

                $lab  = Temat::where([
                    'id' => $zadanie->idTemat
                ])->first();

                $zadanie->lab = $lab->nazwa;

                $rozwiazania  = Rozwiazanie::where([
                    'idZadanie' => $zadanie->id
                ])->orderBy('oceniono', 'desc')->get();

                foreach ($rozwiazania as $rozwiazanie){
                    $user= User::find($rozwiazanie->idUzytkownik);

                    $rozwiazanie->uzytkownik=$user;

                }

                $zadanie->rozwiazania=$rozwiazania;
            }

            foreach ($wyklady as $wyklad){

                $lab  = Temat::where([
                    'id' => $wyklad->idTemat
                ])->first();

                $wyklad->lab = $lab->nazwa;
            }

            //Przypisanie nazw grup do każdego tematu, który jest im udostępniony
            //oraz informacja, czy temat posiada już zadanie
            //oraz informacja, czy temat posiada już quizy
            //oraz informacja, czy temat posiada już wykład

            $zajete = [
                'quiz' => 0,
                'zadanie' => 0,
                'wyklad' => 0
            ];
            foreach($tematy as $temat){
                $nazwyGrup = [];
                $grupy = DB::table('temat')
                        ->join('listagrup', 'listagrup.idTemat', '=', 'temat.id')
                        ->join('grupa', 'listagrup.idGrupa', '=', 'grupa.id')
                        ->where('temat.id', $temat->id)
                        ->select('grupa.*')
                        ->get();
                foreach($grupy as $grupa){
                    array_push($nazwyGrup, $grupa->nazwa);
                }
                $temat->grupy = $nazwyGrup;
                
                //czy temat ma zadanie
                $zadanieTemat = DB::table('zadanie')
                        ->where('idTemat', $temat->id)
                        ->value('id');
                if($zadanieTemat !== null){
                    $temat->maZadanie = true;
                    $zajete['zadanie']++;
                }else{
                    $temat->maZadanie = false;
                }
                
                //czy temat ma quiz
                $quizTemat = DB::table('quiz')
                        ->where('idTemat', $temat->id)
                        ->value('id');
                if($quizTemat !== null){
                    $temat->maQuiz = true;
                    $zajete['quiz']++;

                }else{
                    $temat->maQuiz = false;
                }
                
                //czy temat ma wyklad
                $wykladTemat = DB::table('wyklad')
                        ->where('idTemat', $temat->id)
                        ->value('id');
                if($wykladTemat !== null){
                    $temat->maWyklad = true;
                    $zajete['wyklad']++;

                }else{
                    $temat->maWyklad = false;
                }
                
            }

            if($zajete['wyklad']===count($tematy)){
                $zajete['wyklad']=1;
            }
            else
            {
                $zajete['wyklad']=0;
            }

            if($zajete['quiz']===count($tematy)){
                $zajete['quiz']=1;
            }
            else
            {
                $zajete['quiz']=0;
            }

            if($zajete['zadanie']===count($tematy)){
                $zajete['zadanie']=1;
            }
            else
            {
                $zajete['zadanie']=0;
            }

            //Ilość pytań w każdym z quizów
            //oraz nazwa tematu, do którego quiz jest przypisany
            $iloscPytan = [];
            $index = 0;
            foreach($quizy as $quiz){

                $iloscPytan[$index]=0;

                $pytania_w_quizie = $pytania->where('idQuiz', ($quiz->id));
                foreach ($pytania_w_quizie as $pytanie_w_quizie) {

                    $iloscPytan[$index]++;

                }
                $quiz->iloscPytan =  $iloscPytan[$index];

                $index++;
                
                $quiz->tematNazwa = DB::table('temat')
                        ->where('id', $quiz->idTemat)
                        ->value('nazwa');
            }

            //Ilość punktów każdego studenta i przypisanie studenta do grupy
            foreach ($group as $grupa) {
                $grupa_studenci = [];
                foreach ($studenci as $student) {
                    $iloscPunktow = 0;
                    $punkty_student = $punkty->where('idStudent', ($student->id));
                    foreach ($punkty_student as $wpis) {
                        $iloscPunktow += $wpis->ilosc;
                    }
                    $student->iloscPunktow = $iloscPunktow;

                    //Ocena za punkty
                    if ($iloscPunktow < (int)$kryterium['trzy']) {
                        $ocena = '2';
                    } elseif ($iloscPunktow < (int)$kryterium['cztery']) {
                        $ocena = '3';
                    } elseif ($iloscPunktow < (int)$kryterium['piec']) {
                        $ocena = '4';
                    } else {
                        $ocena = '5';
                    }
                    $student->ocena = $ocena;

                    if ($student->idGrupa == $grupa->id) {
                        array_push($grupa_studenci, $student);
                    }
                }
                $grupa->studenci = $grupa_studenci;

                $grupa->nauczyciel = DB::table('uzytkownik')->where('id',$grupa->idNauczyciel)->first();
            }
            $editTask= session('editTask');
            session()->forget('editTask');
            return view('pages.admin.panel', ['quizy'=>$quizy,'zajete'=>$zajete,'group' => $group, 'studenci' => $studenci, 'nauczyciele' => $nauczyciele,
                'editTask'=>$editTask,
                'notification' => $notification, 'kryterium' => $kryterium, 'tematy' => $tematy, 'wyklady'=>$wyklady, 'zadania'=>$zadania]);
    }

    public function removeGroup($id, $zeStudentami)
    {
        if(!Gate::allows('admin-only', Auth::user())){
            return redirect()->back()->with('error',  trans('Brak dostępu!'));
        }
            $listagrup = DB::table('listagrup')->where('idGrupa', $id);
            $listagrup->delete();
            
            if($zeStudentami === '1'){
                $studenci = DB::table('uzytkownik')->where('idGrupa', $id);
                $studenci->delete();
            }
            
            $grupa = Grupa::find($id);
            $grupa->delete();

                return redirect('/panel/')->with('success', 'Udało się usunąć grupę '.$grupaNazwa.'.');
    }

    public function EditGroups(Request $request, $id)
    {
        if(!Gate::allows('admin-only', Auth::user())){
            return redirect()->back()->with('error',  trans('Brak dostępu!'));
        }

        //Wyswietlany błąd.
        $messages = [
            'max' => 'Nazwa grupy może mieć maksymalnie 12 znaków'
        ];

        //Sprawdzanie danych wejsiowych
        $validator = Validator::make($request->all(), [
            'nazwa-grupy' => 'required|max:12',
        ],$messages);

        //Sprawdzenie czy dane są poprawne.
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $pieces = explode(" ", $request->input('nauczyciel'));

        echo $pieces[0];
        echo $pieces[1];


        $nauczyciel = User::where([
            'imie' => $pieces[0],
            'nazwisko' => $pieces[1],
        ])->first();

        DB::table('grupa')
            ->where('id', $id)
            ->update(['nazwa' => $request->input('nazwa-grupy'),
                'idNauczyciel' =>$nauczyciel->id,
                'updated_at' => Carbon::now()
            ]);

        return redirect()->back()->with('success', trans('Udało się edytować grupę.'));

    }
    public function Groups(Request $request) {

        if(!Gate::allows('admin-only', Auth::user())){
            return redirect()->back()->with('error',  trans('Brak dostępu!'));
        }

        //Wyswietlany błąd.
        $messages = [
            'max' => 'Nazwa grupy może mieć maksymalnie 12 znaków'
        ];

        //Sprawdzanie danych wejsiowych
        $validator = Validator::make($request->all(), [
            'nazwa-grupy' => 'required|max:12',
        ],$messages);

        //Sprawdzenie czy dane są poprawne.
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $pieces = explode(" ", $request->input('nauczyciel'));

        echo $pieces[0];
        echo $pieces[1];

        $group = DB::table('grupa')->where('nazwa',$request->input('nazwa-grupy'))->get()->first();

        if($group!=null){

            return redirect()->back()->with('error',  trans('Wystąpił bład!'));
        }
        else{

            $nauczyciel = User::where([
                'imie' => $pieces[0],
                'nazwisko' => $pieces[1],
            ])->first();


            $array = [
                'nazwa' => $request->input('nazwa-grupy'),
                'idNauczyciel' => $nauczyciel->id,
                'created_at' => Carbon::now()
            ];

            $created_grupa = Grupa::create($array);

            return redirect()->back()->with('success', trans('została dodana grupa o nazwie: '.$created_grupa->nazwa));
        }
    }


    public function Student() {

        if(!Gate::allows('admin-only', Auth::user())){
            return redirect()->back()->with('error',  trans('Brak dostępu!'));
        }
        $grupy = DB::table('grupa')->get();

        return view('pages.admin.dodajstudenta')->with('grupy', $grupy);
    }

    public function Nauczyciel() {//sposób na przerzucenie zmiennej:
        return view('pages.admin.dodajnauczyciela');
    }


    public function StudentFile()
    {
        $grupy = DB::table('grupa')->get();
        return view('pages.admin.dodajstudentazpliku')->with('grupy', $grupy);
    }



    public function addFromFile(Request $request)
    {
        //Wyswietlany błąd.
        $messages = [
            'required' => 'Pole jest wymagane',
            'mimes' => 'Wymagany format pliku: csv'
        ];

        //Sprawdzanie danych wejsiowych
        $validator = Validator::make($request->all(), [
            'Radio' => 'required',   //jest wymagane
            'file' => 'required|mimes:csv,txt' //jest wymagane, ustawienie że ma to byc plik, max 2mb
           ],$messages);

        //Sprawdzenie czy dane są poprawne.
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $file = $request->file('file');


        //Sprawdznie, czy plik jest w formacie UTF-8
        if (mb_check_encoding(file_get_contents($file), 'UTF-8')) {


            //oznaczenie zmiennych:
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $fileSize = $file->getSize();

            // Sprwadzenie rozszerzenia.
            $valid_extension = array("csv");

            // Ustalenie maksymalnego rozmiaru pliku:
            $maxFileSize = 2097152;

            // Sprawdzenie czy rozszerzenie się zgadza:
            if(in_array(strtolower($extension),$valid_extension)){

                // Sprawdzenie, czy rozmiar się zgadza
                if($fileSize <= $maxFileSize){

                    // Wrzucenie pliku
                    $location = 'uploads';

                    // Przeniesienie pliku
                    $file->move($location,$filename);
                    $filepath = public_path($location."/".$filename);

                    // Odczyt pliku
                    $file = fopen($filepath,"r");
                    $importData_arr = array();
                    $i = 0;

                    while (($filedata = fgetcsv($file, 1000, $request->input('Radio'))) !== FALSE) {
                        $num = count($filedata );
                        // Usuwanie pierwszych 3 linijek w których znajduje się:
                        //Lp; Nazwisko i imiona studenta; Księga; nrAlbumu; Status;
                        //Rok akademicki: 2019/2020
                        //Przedmiot: ...
                        //Grupa: GL01


                        if($i==2){
                            $goupname = substr($filedata[0], 7);
                            $group = DB::table('grupa')->where('nazwa',$goupname)->get()->first();
                            if($group===null) {
                                return redirect()->back()->with('error', trans('W bazie nie ma grupy o nazwie: ' . $goupname));
                            }
                        }
                        if($i <= 3){
                            $i++;
                            continue;
                        }


                        for ($c=0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata [$c];
                        }
                        $i++;
                    }
                    fclose($file);

                    // Wrzucenie linijek kodu do bazy danych
                    foreach($importData_arr as $importData){

                        $user = DB::select('SELECT * FROM uzytkownik WHERE nrAlbumu="'.$importData[3].'"');

                        if($user!=null){
                            return redirect()->back()->with('error', trans('W bazie znajduje się użytkownik o numerze albumu: '.$importData[3]));
                         }else{
                            $nazwa_uzytkownika = explode(" ", $importData[1]);
                            if(isset($nazwa_uzytkownika[2])){
                                $imie=$nazwa_uzytkownika[1]." ".$nazwa_uzytkownika[2];
                            }
                            DB::table('uzytkownik')->insert(
                                ['imie' => $imie,
                                    'nazwisko'=> $nazwa_uzytkownika[0],
                                    "nrAlbumu"=>$importData[3],
                                    "idGrupa"=>(int)$group->id,
                                    "typ"=>User::$user,
                                    "haslo"=> bcrypt($nazwa_uzytkownika[0].$importData[2]),
                                    'created_at' => Carbon::now()]
                            );
                        }
                    }
                    return redirect()->back()->with('success', trans('Użytkownicy zostali dodani do grupy: '.$group->nazwa.'!'));
                }else{
                    return redirect()->back()->with('error', trans('Plik jest za duży! Maksymalny rozmiar to 2MB'));
                }
            }else{
                return redirect()->back()->with('error', trans('zle rozszerzenie pliku'));
            }
        }else{
            return redirect()->back()->with('error', trans('Plik nie jest w formacie UTF-8 - mogą wystąpić błędy z wprowadzonymi danymi'));
        }
    }



    function csvToArray($filename = '', $delimiter = ';')
    {
        if (!file_exists($filename) || !is_readable($filename))
        return false;
        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }

    public  function  editUserGroup(Request $request, $id){
        $grupa = DB::table('grupa')->where('nazwa', $request->input('grupa'))->first();
        DB::table('uzytkownik')
            ->where('id', $id)
            ->update(['idGrupa' => $grupa->id,
                'updated_at' => Carbon::now()
            ]);

        return redirect()->back()->with('success', trans('Udało się zmienić grupę.'));
    }

    public function EditUser($id) {
        $user = DB::table('uzytkownik')->where('id', $id)->first();
        $grupy = DB::table('grupa')->get();
        $nazwaGrupy = DB::table('grupa')->where('id', $user->idGrupa)->value('nazwa');
        $punkty = Punkty::where('idStudent', $id)->orderBy('created_at', 'desc')->get();
        $iloscPunktow = 0;
        if ($punkty) {
            foreach ($punkty as $wpis) {
                $iloscPunktow += $wpis->ilosc;
                $nauczyciel = DB::table('uzytkownik')->where('id', $wpis->idNauczyciel)->value('imie') . " " . DB::table('uzytkownik')->where('id', $wpis->idNauczyciel)->value('nazwisko');
                $wpis->nauczyciel = $nauczyciel;
            }
        }

        $data = array(
            'user' => $user,
            'nazwaGrupy' => $nazwaGrupy,
            'iloscPunktow' => $iloscPunktow,
            'punkty' => $punkty,
            'grupy' => $grupy
        );

        return view('pages.admin.edituser')->with($data);
    }

    public function AddPoints($id) {
        $user = User::find($id);
        $data = array(
            'user' => $user,
            'rozwiazanie' => "empty"
        );
        return view('pages.admin.addpoints')->with($data);
    }

    public function rateAnAnswer($id, $answerID) {
        $user = User::find($id);
        $data = array(
            'user' => $user,
            'rozwiazanie' => $answerID
        );
        return view('pages.admin.addpoints')->with($data);
    }

    
    public function EdytujKryterium(){
        $kryterium = [
                'trzy' => Storage::disk('kryterium')->get('3.txt'),
                'cztery' => Storage::disk('kryterium')->get('4.txt'),
                'piec' => Storage::disk('kryterium')->get('5.txt'),
            ];
        return view('pages.admin.edytujkryterium', ['kryterium' => $kryterium]);
    }
    
    public function removeUser($id){
        if (Auth::user()->typ == \App\User::$admin) {
            if($powiadomienia = DB::table('powiadomienie')->where('idUzytkownik', $id)){
                $powiadomienia->delete();
            }

            if($punkty = DB::table('punkty')->where('idStudent', $id)){
                $punkty->delete();
            }
            
            if($rozwiazania = DB::table('rozwiazanie')->where('idUzytkownik', $id)){
                $rozwiazania->delete();
            }
            
            if($wyniki = DB::table('wynik')->where('idUzytkownik', $id)){
                $wyniki->delete();
            }
            
            $imie = '';
            $nazwisko = '';

            if($uzytkownik = User::find($id)){
                $imie = $uzytkownik->imie;
                $nazwisko = $uzytkownik->nazwisko;
                $uzytkownik->delete();
            }else{
                return redirect()->back()->with('error', 'Taki użytkownik nie istnieje.');
            }
            
            return redirect('/panel')->with('success', 'Usunięto użytkownika '.$imie.' '.$nazwisko.'.');
            
        }else{
            return redirect()->back()->with('error', 'Brak dostępu.');
        }
    }

}
