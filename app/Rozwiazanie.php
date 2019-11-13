<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rozwiazanie extends Model
{
    protected $table = 'rozwiazanie';
    public $primaryKey = 'id';
    
    public function zadanie(){
        return $this->belongsTo('App\Zadanie','idZadanie');
    }
    
    public function uzytkownik(){
        return $this->belongsTo('App\User','idUzytkownik');
    }
    
    //public function uzytkownik(){}
}
