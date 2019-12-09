<?php

namespace App\Http\Controllers;

use App\Temat;
use App\User;
use App\ListaGrup;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TematyController extends Controller
{
    //
    public function __construct()
    {
        //blokowanie jeżeli użytkownik nie przejdzie autoryzacji wtedy wysyla go do strony z logowaniem
        //wyjątkami są strony index, gdzie wysiwetlane są tematy
        $this->middleware('auth');
    }

    public function show($id)
    {
        //wyswitla rzeczy zwiazane z konkretnym tematem o id $id
        $temat = Temat::find($id);

        $wyklad = DB::table('wyklad')->where('idTemat',$id)->get()->first();
        if($wyklad!=null)
        {
            $temat->wyklad=$wyklad->id;
        }
        else{
            $temat->wyklad="empty";
        }
        $quiz = DB::table('quiz')->where('idTemat',$id)->get()->first();
        if($quiz!=null)
        {
            $temat->quiz=$quiz->id;
            echo $quiz->id;
        }
        else{
            $temat->quiz="empty";
        }
        $zadanie = DB::table('zadanie')->where('idTemat',$id)->get()->first();
        if($zadanie!=null)
        {
            $temat->zadanie=$zadanie->id;
        }
        else{
            $temat->zadanie="empty";
        }

        if(Auth::user()->typ !== 'nauczyciel'){

            $user_idGrupa = Auth::user()->idGrupa;





//            $grupa_user = DB::table('temat')
//                        ->join('listagrup', 'listagrup.idTemat', '=', 'temat.id')
//                        ->join('grupa', 'listagrup.idGrupa', '=', 'grupa.id')
//                        ->where('temat.id', $id)
//                        ->where('grupa.id', $user_idGrupa)
//                        ->select('grupa.*')
//                        ->get();

            $lista = DB::table('listagrup')->where('idGrupa',$user_idGrupa)->where('idTemat',$id)->count();

            if($lista > 0){
                $trescAktualna = Storage::disk('tematy')->get($id.'/ahtml.txt');
                return view ('tematy.show', ['temat' => $temat, 'trescAktualna' => $trescAktualna]);
            }else{
                return redirect()->back()->with('error', 'Brak dostępu do tematu!');
            }
            
        }else{
            $trescAktualna = Storage::disk('tematy')->get($id.'/ahtml.txt');
            return view ('tematy.show', ['temat' => $temat, 'trescAktualna' => $trescAktualna]);
        }
    }
    
    public function create(){
        if(Auth::user()->typ==\App\User::$admin){
            $temat = Temat::create(['nazwa' => 'Nowy Temat']);
            $trescAktualnaHTMLPath = $temat->id.'/ahtml.txt';
            $trescAktualnaBBCodePath = $temat->id.'/abb.txt';
            $trescPoprzedniaHTMLPath = $temat->id.'/phtml.txt';
            $trescPoprzedniaBBCodePath = $temat->id.'/pbb.txt';
            Storage::disk('tematy')->put($trescAktualnaHTMLPath, '');
            Storage::disk('tematy')->put($trescAktualnaBBCodePath, '');
            Storage::disk('tematy')->put($trescPoprzedniaHTMLPath, '');
            Storage::disk('tematy')->put($trescPoprzedniaBBCodePath, '');
            return redirect('/tematy/'.$temat->id.'/edycja')->with('success', 'Utworzono temat '.$temat->nazwa.'.');
        }else{
            return redirect('/tematy');
        }
        
    }

    public function edit($id)
    {
        $temat = Temat::find($id);
        $trescAktualna = Storage::disk('tematy')->get($id.'/abb.txt');
        if(Auth::user()->typ==\App\User::$admin){
            return view ('tematy.edit', ['temat' => $temat, 'trescAktualna' => $trescAktualna]);
        }else{
            return redirect('/tematy/'.$id);
        }
        
    }
    
    public function groups($id){
        if(Auth::user()->typ==\App\User::$admin){
            $temat = DB::table('temat')->where('id', $id)->first();
            $grupy = DB::table('grupa')->get();
            $grupyWybrane = DB::table('temat')
                        ->join('listagrup', 'listagrup.idTemat', '=', 'temat.id')
                        ->join('grupa', 'listagrup.idGrupa', '=', 'grupa.id')
                        ->where('temat.id', $id)
                        ->select('grupa.*')
                        ->get();
            $grupyWybraneID = [];
            foreach($grupyWybrane as $grupaWybrana){
                array_push($grupyWybraneID, $grupaWybrana->id);
            }
            
            foreach($grupy as $grupa){
                if (in_array($grupa->id, $grupyWybraneID)) {
                    $grupa->checked = 'checked';
                }else{
                    $grupa->checked = '';
                }
            }
            
            return view('tematy.groups', ['temat' => $temat, 'grupy' => $grupy]);
        }else{
            return redirect('/tematy/'.$id);
        }
        
        
        
    }
    
    public function update($id){
        if(Auth::user()->typ==\App\User::$admin){
            $array = [
            'nazwa' => request('nazwa'),
            'opis' => request('opis'),
            ];
            DB::table('temat')->where('id', $id)->update($array);
        
            $trescAktualnaBBCode = Storage::disk('tematy')->get($id.'/abb.txt');
            $trescAktualnaHTML = Storage::disk('tematy')->get($id.'/ahtml.txt');
            Storage::disk('tematy')->put($id.'/pbb.txt', $trescAktualnaBBCode);
            Storage::disk('tematy')->put($id.'/phtml.txt', $trescAktualnaHTML);
            Storage::disk('tematy')->put($id.'/abb.txt', request('text'));
            Storage::disk('tematy')->put($id.'/ahtml.txt', request('texthtml'));
            return redirect()->back()->with('success', 'Udało się zaktualizować temat!');
        }else{
            return redirect('/tematy/'.$id);
        }
        
    }
    
    public function updateGroups($id){
        $grupy = DB::table('grupa')->get();
        $grupyWybrane = DB::table('temat')
                        ->join('listagrup', 'listagrup.idTemat', '=', 'temat.id')
                        ->join('grupa', 'listagrup.idGrupa', '=', 'grupa.id')
                        ->where('temat.id', $id)
                        ->select('grupa.*')
                        ->get();
        $grupyWybraneID = [];
        foreach($grupyWybrane as $grupaWybrana){
            array_push($grupyWybraneID, $grupaWybrana->id);
        }
        foreach($grupy as $grupa){
            if(request(strval($grupa->id))){
                if(!in_array($grupa->id, $grupyWybraneID)) {
                    ListaGrup::create(['idGrupa' => $grupa->id, 'idTemat' => $id]);
                }
            }else{
                if(in_array($grupa->id, $grupyWybraneID)) {
                    $listaGrup = DB::table('listagrup')->where('idGrupa', $grupa->id)->where('idTemat', $id);
                    $listaGrup->delete();
                }
            }
        }
        return redirect()->back()->with('success', 'Zaktualizowano udostępnienie tematu');
    }
    
    public function delete($id){
        if(Auth::user()->typ==\App\User::$admin){
            $temat = Temat::find($id);
            if(!is_null($temat)){
                $nazwa = $temat->nazwa;
                $listyGrup = ListaGrup::where('idTemat', $id);
                $listyGrup->delete();
                $temat->delete();
                Storage::disk('tematy')->deleteDirectory($id);
                return redirect()->back()->with('success', 'Usunięto temat '.$nazwa.'.');
            }else{
                return redirect()->back()->with('error', 'Taki temat nie istnieje.');
            }
        }else{
            return redirect('/tematy/'.$id);
        }
    }
    
    public function restore($id){
        if(Auth::user()->typ==\App\User::$admin){
            $temat = Temat::find($id);
            if(!is_null($temat)){
                $nazwa = $temat->nazwa;
                
                $trescAktualnaBBCode = Storage::disk('tematy')->get($id.'/abb.txt');
                $trescAktualnaHTML = Storage::disk('tematy')->get($id.'/ahtml.txt');
                $trescPoprzedniaBBCode = Storage::disk('tematy')->get($id.'/pbb.txt');
                $trescPoprzedniaHTML = Storage::disk('tematy')->get($id.'/phtml.txt');
                
                Storage::disk('tematy')->put($id.'/abb.txt', $trescPoprzedniaBBCode);
                Storage::disk('tematy')->put($id.'/ahtml.txt', $trescPoprzedniaHTML);
                Storage::disk('tematy')->put($id.'/pbb.txt', $trescAktualnaBBCode);
                Storage::disk('tematy')->put($id.'/phtml.txt', $trescAktualnaHTML);
                
                return redirect()->back()->with('success', 'Przywrócono treść tematu '.$nazwa.'.');
            }else{
                return redirect()->back()->with('error', 'Taki temat nie istnieje.');
            }
        }else{
            return redirect('/tematy/'.$id);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tematy = DB::table('temat')->orderBy('nazwa', 'asc')->get();
        $wyklady = DB::table('wyklad')->get();

        foreach ($tematy as $temat){

            foreach ($wyklady as $wyklad){


                if($wyklad->idTemat===$temat->id){
                    $temat->wykladID=$wyklad->id;
                    $temat->wyklad=$wyklad->tytul;
                    break;
                }
            }
        }

        return view('tematy.index')->with('tematy',$tematy);
    }


}
