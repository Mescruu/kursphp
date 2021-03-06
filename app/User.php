<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    //zmienne odwołujące się do typu użytkownika w tabeli uzytkownik
    public static $admin = 'nauczyciel';
    public static $user = 'student';

    protected $table = 'uzytkownik';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'imie','email','nazwisko','nrAlbumu', 'idGrupa', 'haslo','typ',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'haslo', 'remember_token',
    ];

    // Override required, otherwise existing Authentication system will not match credentials
    public function getAuthPassword()
    {
        return $this->haslo;
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['haslo'] = bcrypt($password);
    }

    //Relacje
    public  function  grupa(){
        return $this->belongsTo('App\Grupa','idGrupa');
    }

    public  function  rozwiazanie(){
        return $this->hasMany('App\Rozwiazanie','idUzytkownik');
    }

    public  function  wynik(){
        return $this->hasMany('App\Wynik','idUzytkownik');
    }

    public  function  punktyZdobyte(){
        return $this->hasMany('App\Punkty','idStudent');
    }

    public  function  punktyNadane(){
        return $this->hasMany('App\Punkty','idNauczyciel');
    }
    
    public function powiadomienie(){
        return $this->hasMany('App\Powiadomienie','idUzytkownik');
    }
}