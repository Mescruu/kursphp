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
    public static function createImportantNotification($id, $content){

        DB::table('powiadomienie')->insert(
            ['komunikat' => $content, 'idUzytkownik'=> $id,'waga'=>'kolokwium', 'created_at' => Carbon::now()]
        );
    }


    public function uzytkownik(){
        return $this->belongsTo('App\User','idUzytkownik');
    }
}
