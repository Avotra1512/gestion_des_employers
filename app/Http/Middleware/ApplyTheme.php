<?php

namespace App\Http\Middleware;

use Closure;

class ApplyTheme
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

        public function handle($request, Closure $next)
        {
            // Appliquer le thème à toutes les pages
            if (session()->has('theme')) {
                view()->share('theme', session('theme')); // Partager la variable $theme avec toutes les vues
            } else {
                view()->share('theme', 'light'); // Par défaut, le thème clair
            }
    
            return $next($request);
        }

}
