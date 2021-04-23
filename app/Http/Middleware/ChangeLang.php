<?php

namespace App\Http\Middleware;

use Closure;

class ChangeLang
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
        app()->setLocale('en');
        if(isset($request->lang) && $request->lang == 'fr'){
            app()->setLocale('fr');
        }
        return $next($request);
    }
}
