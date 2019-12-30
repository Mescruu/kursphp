<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rozwiazanie extends Model
{
    protected $table = 'rozwiazanie';
    public $primaryKey = 'id';
    protected $fillable = ['idZadanie','idUzytkownik','oceniono','Informacje','created_at', 'updated_at'];

    public function zadanie(){
        return $this->belongsTo('App\Zadanie','idZadanie');
    }
    
    public function uzytkownik(){
        return $this->belongsTo('App\User','idUzytkownik');
    }
    
}
