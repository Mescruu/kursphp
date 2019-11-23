<?php

namespace App\Http\Controllers;

use App\Powiadomienie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PowiadomieniaController extends Controller
{
    public function delete(Request $request)
    {
        $notification = Powiadomienie::find($request->input('id'));
        $notification->delete();

        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
}
