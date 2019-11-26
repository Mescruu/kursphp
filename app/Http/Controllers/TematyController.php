<?php

namespace App\Http\Controllers;

use App\Temat;
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
        $this->middleware('auth', ['except'=>['index']]);
    }

    public function show($id)
    {
        //wyswitla rzeczy zwiazane z konkretnym tematem o id $id
        $temat = Temat::find($id);
        $trescAktualna = Storage::disk('tematy')->get($id.'/ahtml.txt');
        return view ('tematy.show', ['temat' => $temat, 'trescAktualna' => $trescAktualna]);
    }
    
    public function create(){
        if(Auth::user()->typ==\App\User::$admin){
            $temat = Temat::create();
            $trescAktualnaPath = $temat->id.'/ahtml.txt';
            $trescAktualnaBBCodePath = $temat->id.'/abb.txt';
            $trescPoprzedniaBBCodePath = $temat->id.'/pbb.txt';
            Storage::disk('tematy')->put($trescAktualnaPath, '');
            Storage::disk('tematy')->put($trescAktualnaBBCodePath, '');
            Storage::disk('tematy')->put($trescPoprzedniaBBCodePath, '');
            return redirect('/tematy/'.$temat->id.'/edycja');
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
    
    public function update($id){
        $array = [
            'nazwa' => request('nazwa'),
            'opis' => request('opis'),
        ];
        DB::table('temat')->where('id', $id)->update($array);
        
        $trescAktualna = Storage::disk('tematy')->get($id.'/abb.txt');
        Storage::disk('tematy')->put($id.'/pbb.txt', $trescAktualna);
        Storage::disk('tematy')->put($id.'/abb.txt', request('text'));
        Storage::disk('tematy')->put($id.'/ahtml.txt', request('texthtml'));
        return redirect()->back()->with('success', 'Udało się zaktualizować temat!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dostarcza wszystkich danych do Kontrolera

        $tematy = Temat::orderBy('nazwa')->get(); //pobiera z bazy posortowane po id malejąco


        //wyswietlenie kontentu strony /posts ktory znajduje sie w resources/posts/index
        //razem ze zmienną $posts, w której znajdują się wszystkie rzeczy z modelu Post(tabela posts)
        return view('tematy.index')->with('tematy', $tematy);
    }


}
