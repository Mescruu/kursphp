<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pytanie extends Model
{
    protected $fillable = ['idQuiz', 'tresc', 'odpPoprawna', 'odpA', 'odpB', 'odpC', 'created_at', 'updated_at'];

    protected $table = 'pytanie';
    public $primaryKey = 'id';
    
    public function quiz(){
        return $this->belongsTo('App\Quiz','idQuiz');
    }
}
