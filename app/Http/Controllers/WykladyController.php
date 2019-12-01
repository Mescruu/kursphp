<?php

namespace App\Http\Controllers;

use App\Temat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WykladyController extends Controller
{


    public function show($id)
    {
        $pathToFile = Storage::disk('wyklady')->get($id);
        $headers= 'aaa';

        //wyswitla rzeczy zwiazane z konkretnym tematem o id $id

            return response()->file($pathToFile, $headers);
    }
    public function restore($id){

    }
}