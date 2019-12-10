<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zadanie extends Model
{
    protected $table = 'zadanie';
    public $primaryKey = 'id';

    protected $fillable = ['nazwa','idTemat','tresc','created_at', 'updated_at'];


    public function temat(){
        return $this->belongsTo('App\Temat','idTemat');
    }
    
    public function rozwiazanie(){
        return $this->hasMany('App\rozwiazanie','idZadanie');
    }
}
