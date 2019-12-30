<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Contracts\View\Factory as ViewFactory;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(ViewFactory $view) {
        Schema::defaultStringLength(191);
        //Dynamiczne udostępnianie tematów do paska nawigacji i listy tematów
        $view->composer(['inc.navbar', 'tematy.index', 'inc.footer'], 'App\Http\ViewComposers\ListaTematowComposer');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
