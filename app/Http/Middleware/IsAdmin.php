<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
{

//    public function handle($request, Closure $next)
//    {
//        return $next($request);
//    }


    public function handle($request, Closure $next)
    {
        if(auth()->user()->isAdmin()) {
            return $next($request);
        }
        return redirect('home');

    }


}
