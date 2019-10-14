<?php

namespace App\Http\Middleware;

use Closure;

class IsUser
{

//    public function handle($request, Closure $next)
//    {
//        return $next($request);
//    }


    public function handle($request, Closure $next)
    {
        if(auth()->user()->isUser()) {
            return $next($request);
        }
        return redirect('home');

    }

}
