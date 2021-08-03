<?php

namespace App\Providers;

use App\Models\Medicos;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        /* Variavel 'Global' para verificar qtde de cadastros */
        View::composer('index', function($view) {
 
            $cont = Medicos::all();
            $view->with('cont', $cont);
        });
    }
}
