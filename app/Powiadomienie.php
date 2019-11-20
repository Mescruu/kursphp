<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Powiadomienie extends Model
{
    protected $table = 'powiadomienie';
    public $primaryKey = 'id';
    
    public function uzytkownik(){
        return $this->belongsTo('App\User','idUzytkownik');
    }
}
