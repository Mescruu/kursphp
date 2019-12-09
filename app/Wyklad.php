<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wyklad extends Model
{
    //Table Name
    protected $table = 'wyklad'; // nazwa tabeli do której się odwołuje model.

    //Primary Key
    public $primaryKey = 'id';

    protected $fillable = ['tytul','idTemat','created_at', 'updated_at'];

}
