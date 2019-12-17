<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Powiadomienie extends Model
{
    protected $table = 'powiadomienie';
    public $primaryKey = 'id';

    public static function createNotification($id, $content){

        DB::table('powiadomienie')->insert(
            ['komunikat' => $content, 'idUzytkownik'=> $id,'waga'=>'zwykle', 'created_at' => Carbon::now()]
        );
    }
    public static function createNotificationWhenGetAccess($id, $content)
    {
        $uzytkownicy = DB::table('uzytkownik')
            ->where('idGrupa', $id)
            ->get();

        foreach ($uzytkownicy as $uzytkownik){
            Powiadomienie::createNotification($uzytkownik->id,$content);
        }
    }

    public static function createNotificationWhenEdit($id, $content)
    {
        $uzytkownicy = DB::table('temat')
            ->join('listagrup', 'listagrup.idTemat', '=', 'temat.id')
            ->join('grupa', 'listagrup.idGrupa', '=', 'grupa.id')
            ->join('uzytkownik', 'uzytkownik.idGrupa','=','grupa.id')
            ->where('temat.id', $id)
            ->select('uzytkownik.id')
            ->get();

        foreach ($uzytkownicy as $uzytkownik){
            Powiadomienie::createNotification($uzytkownik->id,$content);
        }

        $nauczyciele = DB::table('uzytkownik')->where('typ', \App\User::$admin)->get();
        foreach ($nauczyciele as $nauczyciel){
            if($nauczyciel->id!=Auth::user()->id){
                Powiadomienie::createNotification($nauczyciel->id,$content);
            }
        }

        return true;
    }
        public static function createImportantNotification($id, $content){

        DB::table('powiadomienie')->insert(
            ['komunikat' => $content, 'idUzytkownik'=> $id,'waga'=>'wazne', 'created_at' => Carbon::now()]
        );
    }


    public function uzytkownik(){
        return $this->belongsTo('App\User','idUzytkownik');
    }
}
