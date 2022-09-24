<?php

namespace App\Http\Middleware;

use Closure;

class alreadyloggedin_captain
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
        if(session()->has('captainloginID')){
            return redirect('captain/home');
        }
        return $next($request);
    }
}
