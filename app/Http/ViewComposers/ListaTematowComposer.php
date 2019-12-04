<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ListaTematowComposer {

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (!Auth::guest()) {
            if (Auth::user()->typ === 'nauczyciel') {
                    $view->with('listaTematow', \App\Temat::all());
            } else {
                $listaTematow = DB::table('temat')
                        ->join('listagrup', 'listagrup.idTemat', '=', 'temat.id')
                        ->where('listagrup.idGrupa', Auth::user()->idGrupa)
                        ->select('temat.*')
                        ->get();
                $view->with('listaTematow', $listaTematow);
            }
        } else {
                $pustaLista = collect();
                $view->with('listaTematow', $pustaLista);
        }
    }

}