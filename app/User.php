<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    //zmienne odwołujące się do typów w tabeli
    public $admin = 'nauczyciel';
    public $user = 'student';

    //nazwa tabeli uzytkownik. przez dodanie do zmiennej $table "laravel"(Auth) wie, ze jest to tabela uzytkownika
    protected $table = 'uzytkownik';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nrAlbumu', 'idGrupa', 'haslo',
    ];

//    protected $primaryKey = 'id'; gdyby chciec ustawic primary key

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





    public  function  post(){
        return $this->hasMany('App\Post'); //User ma wiele postów., ale post ma jednego usera //Relacja jeden do wielu.
    }
    //Nowe połączenia
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
}