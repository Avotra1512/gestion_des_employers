<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        if (session()->has('theme')) {
            $theme = session('theme');  // Récupère le thème de la session
        } else {
            $theme = 'light';  // Si aucun thème n'est défini, par défaut "light"
        }
    
        // Appliquez le thème dans la configuration de l'application
        config(['app.theme' => $theme]);
    }
    
}
