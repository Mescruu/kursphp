<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quiz';
    public $primaryKey = 'id';
    
    public function temat(){
        return $this->belongsTo('App\Zadanie','idTemat');
    }
    
    public function pytanie(){
        return $this->hasMany('App\Pytanie','idQuiz');
    }
    
    public function wynik(){
        return $this->hasMany('App\Wynik','idQuiz');
    }
}
