<?php

namespace App\Http\Middleware;

use Closure;

class isEditor
{

 public function handle($request, Closure $next)
    {
        if(auth()->user()->isEditor()) {
            return $next($request);
        }
        return redirect('home');

    }


}
