<?php

namespace App\Http\Middleware;

use Closure;

class isloggedin_captain
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
        if(!session()->has('captainID')){
            return redirect('captain/')->with('fail', 'Please login first ');;
        }
        return $next($request);
    }
}
