<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupa extends Model
{
    protected $table = 'grupa'; // nazwa tabeli do której się odwołuje model.

    public $primaryKey = 'id';
}
