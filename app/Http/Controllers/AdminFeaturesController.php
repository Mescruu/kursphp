<?php

namespace App\Http\Controllers;

use App\Grupa;
use App\User;
use App\Punkty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminFeaturesController extends Controller {

    //ADMIN

    public function panel() {//sposób na przerzucenie zmiennej:
        //jezeli uzytkownik nie ma typu admin, wtedy zostaje przekierowany na adres profile
        if (Auth::user()->typ == Auth::user()->user) {
            return redirect('/profil');
        } else {
            $studenci = DB::table('uzytkownik')->where('typ', 'student')->orderBy('nazwisko', 'asc')->get();
            $nauczyciele = DB::table('uzytkownik')->where('typ', 'nauczyciel')->get();
            $user = User::get(); //pobierz wszystkich uzytkownikow
            $group = Grupa::get(); //pobierz wszystkie grupy
            $notification = DB::table('powiadomienie')->where('idUzytkownik', Auth::user()->id)->get();
            $punkty = DB::table('punkty')->orderBy('created_at', 'desc')->get();
            $punkty_nauczyciele = [];
            $punkty_studenci = [];

            //Imie i nazwisko nauczyciela w historii punktów
            foreach ($punkty as $wpis) {
                $nauczyciel = DB::table('uzytkownik')->where('id', $wpis->idNauczyciel)->value('imie') . " " . DB::table('uzytkownik')->where('id', $wpis->idNauczyciel)->value('nazwisko');
                $punkty_nauczyciele[$wpis->id] = $nauczyciel;
                $student = DB::table('uzytkownik')->where('id', $wpis->idStudent)->value('imie') . " " . DB::table('uzytkownik')->where('id', $wpis->idStudent)->value('nazwisko');
                $punkty_studenci[$wpis->id] = $student;
            }

            //ilosc punktow kazdego studenta i przypisanie studenta do grupy
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
                    if ($iloscPunktow < 50) {
                        $ocena = '2';
                    } elseif ($iloscPunktow < 75) {
                        $ocena = '3';
                    } elseif ($iloscPunktow < 100) {
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

            return view('pages.admin.panel', ['user' => $user, 'group' => $group, 'studenci' => $studenci, 'nauczyciele' => $nauczyciele, 'notification' => $notification, 'punkty' => $punkty, 'punkty_nauczyciele' => $punkty_nauczyciele, 'punkty_studenci' => $punkty_studenci]);
        }
    }

    public function Groups() {//sposób na przerzucenie zmiennej:
        return view('pages.admin.editgroup');
    }

    public function Student() {//sposób na przerzucenie zmiennej:
        $grupy = DB::table('grupa')->get();

        return view('pages.admin.dodajstudenta')->with('grupy', $grupy);
    }

    public function Nauczyciel() {//sposób na przerzucenie zmiennej:
        return view('pages.admin.dodajnauczyciela');
    }

    public function zPliku()
    {//sposób na przerzucenie zmiennej:

        return view('pages.admin.dodajzpliku');
    }

    public function addFromFile(Request $request)
    {
        //sposób na przerzucenie zmiennej:
        $this->validate($request,[
            'title' => 'required',
            'separator' => 'required',   //jest wymagane
            'cover_image' => 'image|nullable|max:1999' //ustawienie że mają to być obrazki, może być puste, max 2mb

        ]);


        return redirect()->back()->with('status', trans('Link do zresetowania hasła został wysłany na Twój adres e-mail.'));

    }


    function csvToArray($filename = '', $delimiter = ',')
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

}
