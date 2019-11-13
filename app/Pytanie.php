<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pytanie extends Model
{
    protected $table = 'pytanie';
    public $primaryKey = 'id';
    
    public function quiz(){
        return $this->belongsTo('App\Quiz','idQuiz');
    }
}
