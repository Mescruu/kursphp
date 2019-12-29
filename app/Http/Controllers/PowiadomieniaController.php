<?php

namespace App\Http\Controllers;

use App\Powiadomienie;
use Illuminate\Http\Request;

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
