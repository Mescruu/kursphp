<?php

namespace App\Http\Controllers;

use App\Grupa;
use App\Temat;
use App\User;
use App\Punkty;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminFeaturesController extends Controller {

    //ADMIN
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function panel() {
        //jezeli uzytkownik nie ma typu admin, wtedy zostaje przekierowany na adres profile
        if (Auth::user()->typ==\App\User::$user) {
            return redirect('/profil');
        } else {
            $studenci = DB::table('uzytkownik')->where('typ', 'student')->orderBy('nazwisko', 'asc')->get();
            $nauczyciele = DB::table('uzytkownik')->where('typ', 'nauczyciel')->get();
            $group = Grupa::get();
            $notification = DB::table('powiadomienie')->where('idUzytkownik', Auth::user()->id)->get();
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
            }

            foreach ($wyklady as $wyklad){

                $lab  = Temat::where([
                    'id' => $wyklad->idTemat
                ])->first();

                $wyklad->lab = $lab->nazwa;
            }

            //Przypisanie nazw grup do każdego tematu, który jest im udostępniony
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
            }
            
            //Ilość pytań w każdym z quizów
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
            }

            return view('pages.admin.panel', ['quizy'=>$quizy, 'group' => $group, 'studenci' => $studenci, 'nauczyciele' => $nauczyciele, 'notification' => $notification, 'kryterium' => $kryterium, 'tematy' => $tematy, 'wyklady'=>$wyklady, 'zadania'=>$zadania]);
        }
    }

    public function Groups(Request $request) {//sposób na przerzucenie zmiennej:

        //sposób na przerzucenie zmiennej:
        $this->validate($request,[
            'nazwa-grupy' => 'required|max:3',
        ]);

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

        echo $nauczyciel->id;


            $array = [
                'nazwa' => $request->input('nazwa-grupy'),
                'idNauczyciel' => $nauczyciel->id,
                'created_at' => Carbon::now()
            ];

            $created_grupa = Grupa::create($array);

            return redirect()->back()->with('success', trans('została dodana grupa o nazwie: '.$created_grupa->nazwa));
        }
    }


    public function Student() {//sposób na przerzucenie zmiennej:
        $grupy = DB::table('grupa')->get();

        return view('pages.admin.dodajstudenta')->with('grupy', $grupy);
    }

    public function Nauczyciel() {//sposób na przerzucenie zmiennej:
        return view('pages.admin.dodajnauczyciela');
    }


    public function StudentFile()
    { //dodawanie studentow z pliku csv

        $grupy = DB::table('grupa')->get();

        return view('pages.admin.dodajstudentazpliku')->with('grupy', $grupy);
    }



    public function addFromFile(Request $request)
    {
        //sposób na przerzucenie zmiennej:
        $this->validate($request,[
            'grupa' => 'required',
            'Radio' => 'required',   //jest wymagane
            'file' => 'required|mimes:csv,txt' //jest wymagane, ustawienie że ma to byc plik, max 2mb
        ]);

        //pobranie grupy z nazwą
        $group = DB::table('grupa')->where('nazwa',$request->input('grupa'))->get()->first();

        $file = $request->file('file');

        //Sprawdznie, czy plik jest w formacie UTF-8
        if (mb_check_encoding(file_get_contents($file), 'UTF-8')) {


            // File Details
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();

            // Valid File Extensions
            $valid_extension = array("csv");

            // 2MB in Bytes
            $maxFileSize = 2097152;

            // Check file extension
            if(in_array(strtolower($extension),$valid_extension)){

                // Check file size
                if($fileSize <= $maxFileSize){

                    // File upload location
                    $location = 'uploads';

                    // Upload file
                    $file->move($location,$filename);

                    // Import CSV to Database
                    $filepath = public_path($location."/".$filename);

                    // Reading file
                    $file = fopen($filepath,"r");

                    $importData_arr = array();
                    $i = 0;

                    while (($filedata = fgetcsv($file, 1000, $request->input('Radio'))) !== FALSE) {
                        $num = count($filedata );

                        // Skip first row (Remove below comment if you want to skip the first row)

                        if($i == 0){
                            $i++;
                            continue;
                        }

                        for ($c=0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata [$c];
                        }
                        $i++;
                    }
                    fclose($file);

                    // Insert to MySQL database
                    foreach($importData_arr as $importData){


                        $user = DB::select('SELECT * FROM uzytkownik WHERE nrAlbumu="'.$importData[2].'"');


                        if($user!=null){
                            return redirect()->back()->with('error', trans('W bazie znajduje się użytkownik o numerze albumu: '.$importData[2]));

                         }else{
                            DB::table('uzytkownik')->insert(
                                ['imie' => $importData[0],
                                    'nazwisko'=> $importData[1],
                                    "nrAlbumu"=>$importData[2],
                                    "idGrupa"=>(int)$group->id,
                                    "typ"=>User::$user,
                                    "haslo"=> bcrypt($importData[0].$importData[2]),
                                    'created_at' => Carbon::now()]
                            );
                        }


                    }

                    return redirect()->back()->with('success', trans('Użytkownicy zostali dodani do grupy: '.$request->input('grupa').'!'));
                }else{
                    return redirect()->back()->with('error', trans('Plik jest za duży! Maksymalny rozmiar to 2MB'));
                }

            }else{
                return redirect()->back()->with('error', trans('zle rozszerzenie pliku'));
            }


        }else{

            return redirect()->back()->with('error', trans('Plik nie jest w formacie UTF-8 - mogą wystąpić błędy z wprowadzonymi danymi'));

        }



        // Redirect to index
        return redirect()->back()->with('error', trans('cos poszlo nie tak'));
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


    public function EditUser($id) {
        $user = DB::table('uzytkownik')->where('id', $id)->first();
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
            'punkty' => $punkty
        );

        return view('pages.admin.edituser')->with($data);
    }

    public function AddPoints($id) {
        $user = User::find($id);

        $data = array(
            'user' => $user
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

}
