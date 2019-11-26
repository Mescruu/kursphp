<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temat extends Model
{
    //Table Name
    protected $table = 'temat'; // nazwa tabeli do której się odwołuje model.

    //Primary Key
    public $primaryKey = 'id';
    
    protected $fillable = ['nazwa'];

    public function listaGrup(){
        return $this->hasMany('App\ListaGrup','idTemat');
    }
    
    public function zadanie(){
        return $this->hasMany('App\Zadanie','idTemat');
    }
    
    public function quiz(){
        return $this->hasMany('App\Quiz','idTemat');
    }
}
