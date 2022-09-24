<?php

namespace App\Http\Middleware;

use Closure;

class Alreadyloggedin_user
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
        if(session()->has('loginID')){
            return redirect('/');
        }
        return $next($request);
    }
}

