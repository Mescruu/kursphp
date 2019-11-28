<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wynik extends Model
{
    protected $table = 'wynik';
    protected $fillable = ['idQuiz', 'idUzytkownik','wynik', 'created_at', 'updated_at'];


    public  function  quiz(){
        return $this->belongsTo('App\Quiz','idQuiz'); 
    }
    
    public  function  uzytkownik(){
        return $this->belongsTo('App\User','idUzytkownik'); 
    }
}
