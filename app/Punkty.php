<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Punkty extends Model
{
    protected $table = 'punkty';
    public $primaryKey = 'id';
    
    protected $fillable = [
        'idStudent','idNauczyciel','ilosc','komentarz'
    ];
    
    public function student(){
        return $this->belongsTo('App\User','idStudent');
    }
    
    public function nauczyciel(){
        return $this->belongsTo('App\User','idNauczyciel');
    }
}
