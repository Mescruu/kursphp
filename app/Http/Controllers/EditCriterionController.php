<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EditCriterionController extends Controller
{
    public function EditCriterion(){
        $this->validate(request(), [
            'trzy' => 'required|max:3|',
            'cztery' => 'required|max:3',
            'piec' => 'required|max:3'
        ]);
        
        Storage::disk('kryterium')->put('3.txt', request('trzy'));
        Storage::disk('kryterium')->put('4.txt', request('cztery'));
        Storage::disk('kryterium')->put('5.txt', request('piec'));
        
        return redirect('/panel')->with('success', 'Zmieniłeś kryterium oceniania.');
    }
}
