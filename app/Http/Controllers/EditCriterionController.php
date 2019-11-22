<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EditCriterionController extends Controller
{
    public function EditCriterion(){
        $this->validate(request(), [
            'trzy' => 'required|max:3|',
            'cztery' => 'required|max:3',
            'piec' => 'required|max:3'
        ]);
        
        $kryterium = DB::table('kryterium')->first();
        if(!is_null($kryterium)){
            DB::table('kryterium')->update(['trzy' => request('trzy'), 'cztery' => request('cztery'), 'piec' => request('piec')]);
            return redirect('/panel')->with('success', 'Zmieniłeś kryterium oceniania.');
        }else{
            return redirect('/panel')->withErrors('error', 'Coś poszło nie tak.');
        }
    }
}
