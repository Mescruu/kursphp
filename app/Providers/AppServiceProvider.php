<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        //Dynamiczne udostępnianie tematów do paska nawigacji
        view()->composer(
            'inc.navbar',
            function ($view) {
                if(Auth::user()->typ !== 'nauczyciel') {

                    $view->with('listaTematow', \App\Temat::all());
                }else{
                    $view->with('listaTematow', \App\Temat::all());
                }
            }
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
