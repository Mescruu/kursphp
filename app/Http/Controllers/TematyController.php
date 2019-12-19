<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckUserType;
use App\Powiadomienie;
use App\Temat;
use App\ListaGrup;
use App\Zadanie;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TematyController extends Controller {

    //
    public function __construct() {
        $this->middleware(CheckUserType::class, ['except' => ['show','index']]);
    }

    public function show($id) {
        //wyswitla rzeczy zwiazane z konkretnym tematem o id $id
        $temat = Temat::find($id);

        if($temat==null){
            return redirect()->back()->with('error', trans('Nie ma takiego tematu'));
        }


        $wyklad = DB::table('wyklad')->where('idTemat', $id)->get()->first();
        if ($wyklad != null) {
            $temat->wyklad = $wyklad->id;
        } else {
            $temat->wyklad = "empty";
        }
        $quiz = DB::table('quiz')->where('idTemat', $id)->get()->first();
        if ($quiz != null) {
            $temat->quiz = $quiz->id;
        } else {
            $temat->quiz = "empty";
        }
        $zadanie = DB::table('zadanie')->where('idTemat', $id)->get()->first();
        if ($zadanie != null) {
            $temat->zadanie = $zadanie->id;
        } else {
            $temat->zadanie = "empty";
        }

        if (Auth::user()->typ !== 'nauczyciel') {

            $user_idGrupa = Auth::user()->idGrupa;





//            $grupa_user = DB::table('temat')
//                        ->join('listagrup', 'listagrup.idTemat', '=', 'temat.id')
//                        ->join('grupa', 'listagrup.idGrupa', '=', 'grupa.id')
//                        ->where('temat.id', $id)
//                        ->where('grupa.id', $user_idGrupa)
//                        ->select('grupa.*')
//                        ->get();

            $lista = DB::table('listagrup')->where('idGrupa', $user_idGrupa)->where('idTemat', $id)->count();

            if ($lista > 0) {
                $trescAktualna = Storage::disk('tematy')->get($id . '/ahtml.txt');
                return view('tematy.show', ['temat' => $temat, 'trescAktualna' => $trescAktualna]);
            } else {
                return redirect()->back()->with('error', 'Brak dostępu do tematu!');
            }
        } else {
            $trescAktualna = Storage::disk('tematy')->get($id . '/ahtml.txt');
            return view('tematy.show', ['temat' => $temat, 'trescAktualna' => $trescAktualna]);
        }
    }

    public function create() {
        if (Auth::user()->typ == \App\User::$admin) {
            $temat = Temat::create(['nazwa' => 'Nowy Temat']);
            $trescAktualnaHTMLPath = $temat->id . '/ahtml.txt';
            $trescAktualnaBBCodePath = $temat->id . '/abb.txt';
            $trescPoprzedniaHTMLPath = $temat->id . '/phtml.txt';
            $trescPoprzedniaBBCodePath = $temat->id . '/pbb.txt';
            Storage::disk('tematy')->put($trescAktualnaHTMLPath, '');
            Storage::disk('tematy')->put($trescAktualnaBBCodePath, '');
            Storage::disk('tematy')->put($trescPoprzedniaHTMLPath, '');
            Storage::disk('tematy')->put($trescPoprzedniaBBCodePath, '');
            return redirect('/tematy/' . $temat->id . '/edycja')->with('success', 'Utworzono temat ' . $temat->nazwa . '.');
        } else {
            return redirect('/tematy');
        }
    }

    public function edit($id) {
        $temat = Temat::find($id);
        if($temat==null){
            return redirect()->back()->with('error', trans('Nie ma takiego tematu'));
        }

        $wyklad = DB::table('wyklad')->where('idTemat', $id)->get()->first();
        if ($wyklad != null) {
            $temat->wyklad = $wyklad->id;
        } else {
            $temat->wyklad = "empty";
        }
        $quiz = DB::table('quiz')->where('idTemat', $id)->get()->first();
        if ($quiz != null) {
            $temat->quiz = $quiz->id;
        } else {
            $temat->quiz = "empty";
        }
        $zadanie = DB::table('zadanie')->where('idTemat', $id)->get()->first();
        if ($zadanie != null) {
            $temat->zadanie = $zadanie->id;
        } else {
            $temat->zadanie = "empty";
        }

        $trescAktualna = Storage::disk('tematy')->get($id . '/abb.txt');
        if (Auth::user()->typ == \App\User::$admin) {
            return view('tematy.edit', ['temat' => $temat, 'trescAktualna' => $trescAktualna]);
        } else {
            return redirect('/tematy/' . $id);
        }
    }

    public function groups($id) {
        if (Auth::user()->typ == \App\User::$admin) {
                $temat = DB::table('temat')->where('id', $id)->first();
                $grupy = DB::table('grupa')->get();
                $grupyWybrane = DB::table('temat')
                    ->join('listagrup', 'listagrup.idTemat', '=', 'temat.id')
                    ->join('grupa', 'listagrup.idGrupa', '=', 'grupa.id')
                    ->where('temat.id', $id)
                    ->select('grupa.*')
                    ->get();
                $grupyWybraneID = [];
                foreach ($grupyWybrane as $grupaWybrana) {
                    array_push($grupyWybraneID, $grupaWybrana->id);
                }

            foreach ($grupy as $grupa) {
                if (in_array($grupa->id, $grupyWybraneID)) {
                    $grupa->checked = 'checked';
                } else {
                    $grupa->checked = '';
                }
            }

            return view('tematy.groups', ['temat' => $temat, 'grupy' => $grupy]);
        } else {
            return redirect('/tematy/' . $id);
        }
    }

    public function update($id) {
        $temat=Temat::find($id);
        if($temat==null){
            return redirect()->back()->with('error', trans('Nie ma takiego tematu'));
        }

        if (Auth::user()->typ == \App\User::$admin) {
            $array = [
                'nazwa' => request('nazwa'),
                'opis' => request('opis'),
            ];
            DB::table('temat')->where('id', $id)->update($array);

            $trescAktualnaBBCode = Storage::disk('tematy')->get($id . '/abb.txt');
            $trescAktualnaHTML = Storage::disk('tematy')->get($id . '/ahtml.txt');
            Storage::disk('tematy')->put($id . '/pbb.txt', $trescAktualnaBBCode);
            Storage::disk('tematy')->put($id . '/phtml.txt', $trescAktualnaHTML);
            Storage::disk('tematy')->put($id . '/abb.txt', request('text'));
            Storage::disk('tematy')->put($id . '/ahtml.txt', request('texthtml'));
            DB::table('temat')->where('id', $id)->update(['updated_at' => Carbon::now()]);


            Powiadomienie::createNotificationWhenEdit($temat->id, "Uzytkownik ". Auth::user()->imie." ". Auth::user()->nazwisko." zedytował temat ".$temat->nazwa);

            return redirect()->back()->with('success', 'Udało się zaktualizować temat!');
        } else {
            return redirect('/tematy/' . $id)->with('error', 'Brak dostępu.');
        }
    }

    public function updateGroups($id) {
        $temat = Temat::find($id);
        $grupy = DB::table('grupa')->get();
        $grupyWybrane = DB::table('temat')
                ->join('listagrup', 'listagrup.idTemat', '=', 'temat.id')
                ->join('grupa', 'listagrup.idGrupa', '=', 'grupa.id')
                ->where('temat.id', $id)
                ->select('grupa.*')
                ->get();
        $grupyWybraneID = [];
        foreach ($grupyWybrane as $grupaWybrana) {
            array_push($grupyWybraneID, $grupaWybrana->id);
        }
        foreach ($grupy as $grupa) {
            if (request(strval($grupa->id))) {
                if (!in_array($grupa->id, $grupyWybraneID)) {
                    ListaGrup::create(['idGrupa' => $grupa->id, 'idTemat' => $id]);
                    Powiadomienie::createNotificationWhenGetAccess($grupa->id, "Twoja grupa otrzymała dostęp do tematu  ".$temat->nazwa.".");

                }
            } else {
                if (in_array($grupa->id, $grupyWybraneID)) {
                    $listaGrup = DB::table('listagrup')->where('idGrupa', $grupa->id)->where('idTemat', $id);
                    $listaGrup->delete();
                }
            }
        }
        return redirect()->back()->with('success', 'Zaktualizowano udostępnienie tematu');
    }

    public function delete($id) {
            $temat = Temat::find($id);
        if($temat==null){
            return redirect()->back()->with('error', trans('Nie ma takiego tematu'));
        }

            if (!is_null($temat)) {


                Powiadomienie::createNotificationWhenEdit($temat->id, "Uzytkownik ". Auth::user()->imie." ". Auth::user()->nazwisko." usunął temat ".$temat->nazwa);


                $zadanie = Zadanie::find($id);
                if (!is_null($zadanie)) {

                    $rozwiazania = DB::table('rozwiazanie')->where('idZadanie', $zadanie->id);

                    if (!is_null($rozwiazania)) {
                        $rozwiazania->delete();
                    }

                    $zadanie->delete();
                    Storage::disk('rozwiazania')->deleteDirectory($id);
                }




                $quiz = DB::table('quiz')->where('idTemat', $id);
//                $pytanie = DB::table('pytanie')->where('idQuiz', $quiz->id);

                if (!is_null($quiz)) {
//                    if(!is_null($pytanie)) {
//                        $pytanie = DB::table('pytanie')->where('idQuiz', $quiz->id);
//                        $pytanie->delete();
//                    }
                    $quiz->delete();
                }

                $wyklad = DB::table('wyklad')->where('idTemat', $id);

                if (!is_null($wyklad)) {
                    $wyklad->delete();
                    Storage::disk('wyklady')->delete($id . "pdf");
                }

                $nazwa = $temat->nazwa;
                $listyGrup = ListaGrup::where('idTemat', $id);
                $listyGrup->delete();


                $temat->delete();
                Storage::disk('tematy')->deleteDirectory($id);



                return redirect()->back()->with('success', 'Usunięto temat ' . $nazwa . '.');
            } else {
                return redirect()->back()->with('error', 'Taki temat nie istnieje.');
            }
    }

    public function restore($id) {
            $temat = Temat::find($id);
            if($temat==null){
                return redirect()->back()->with('error', trans('Nie ma takiego tematu'));
            }

            if (!is_null($temat)) {
                $nazwa = $temat->nazwa;

                $trescAktualnaBBCode = Storage::disk('tematy')->get($id . '/abb.txt');
                $trescAktualnaHTML = Storage::disk('tematy')->get($id . '/ahtml.txt');
                $trescPoprzedniaBBCode = Storage::disk('tematy')->get($id . '/pbb.txt');
                $trescPoprzedniaHTML = Storage::disk('tematy')->get($id . '/phtml.txt');

                Storage::disk('tematy')->put($id . '/abb.txt', $trescPoprzedniaBBCode);
                Storage::disk('tematy')->put($id . '/ahtml.txt', $trescPoprzedniaHTML);
                Storage::disk('tematy')->put($id . '/pbb.txt', $trescAktualnaBBCode);
                Storage::disk('tematy')->put($id . '/phtml.txt', $trescAktualnaHTML);
                DB::table('temat')->where('id', $id)->update(['updated_at' => Carbon::now()]);

                return redirect()->back()->with('success', 'Przywrócono treść tematu ' . $nazwa . '.');
            } else {
                return redirect()->back()->with('error', 'Taki temat nie istnieje.');
            }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        return view('tematy.index');
    }

    public function uploadImage(Request $request) {
        $this->validate($request, [
            'imageUpload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->imageUpload;
        $input = time() . '.' . $request->imageUpload->extension();
        $request->imageUpload->move(public_path('images'), $input);

        return response()->json($input);
    }

    public function refreshImages() {
        $dirname = public_path()."/images/";
        $images = glob($dirname . "*.{jpg,png,jpeg}", GLOB_BRACE);
        $images_ready = [];
        foreach ($images as $image) {
            $image = str_replace($dirname, "/images/", $image);
            array_push($images_ready, $image);
        }
        $js_array = json_encode($images_ready);
        //$js_array = json_encode($images);
        echo $js_array;
    }

}
