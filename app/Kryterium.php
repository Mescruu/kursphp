<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kryterium extends Model
{
    protected $table = 'kryterium';
    public $primaryKey = 'id';
    
    protected $fillable = [
        'trzy','cztery','piec'
    ];
}
