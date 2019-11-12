<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temat extends Model
{
    //Table Name
    protected $table = 'temat'; // nazwa tabeli do której się odwołuje model.

    //Primary Key
    public $primaryKey = 'id';

    //trzeba dodać relację

}
