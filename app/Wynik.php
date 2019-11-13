<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wynik extends Model
{
    public  function  quiz(){
        return $this->belongsTo('App\Quiz','idQuiz'); 
    }
    
    public  function  uzytkownik(){
        return $this->belongsTo('App\User','idUzytkownik'); 
    }
}
