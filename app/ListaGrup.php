<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListaGrup extends Model
{
    protected $table = 'listaGrup';
    public $primaryKey = 'id';
    
    public function grupa(){
        return $this->belongsTo('App\Grupa','idGrupa');
    }
    
    public function temat(){
        return $this->belongsTo('App\Temat','idTemat');
    }
}
