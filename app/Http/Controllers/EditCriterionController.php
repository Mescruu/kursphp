<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckUserType;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EditCriterionController extends Controller
{
    //ADMIN
    public function __construct()
    {
        $this->middleware(CheckUserType::class);
    }

    public function EditCriterion(){

        //Wyswietlany błąd.
        $messages = [
            'max' => 'To pole może mieć maksymalnie 3 znaki.'
        ];

        //Sprawdzanie danych wejsiowych
        $validator = Validator::make(request()->all(), [
            'trzy' => 'required|max:3|',
            'cztery' => 'required|max:3',
            'piec' => 'required|max:3'
        ],$messages);

        //Sprawdzenie czy dane są poprawne.
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if(request('trzy')<request('cztery')&& request('cztery')<request('piec')){

            Storage::disk('kryterium')->put('3.txt', request('trzy'));
            Storage::disk('kryterium')->put('4.txt', request('cztery'));
            Storage::disk('kryterium')->put('5.txt', request('piec'));

            return redirect('/panel')->with('success', 'Zmieniłeś kryterium oceniania.');
        }else{
            return redirect('/panel')->with('error', 'Progi są nieprawidłowe.');
        }

    }
}
