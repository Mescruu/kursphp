<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupa extends Model
{
    protected $table = 'grupa'; // nazwa tabeli do której się odwołuje model.

    public $primaryKey = 'id';
    
    public function uzytkownik(){
        return $this->hasMany('App\User','idGrupa'); //post ma relacje z userem jeden do wielu
    }
    
    public function listaGrup(){
        return $this->hasMany('App\ListaGrup','idGrupa');
    }

}
