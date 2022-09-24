<?php

namespace App\Http\Middleware;

use Closure;

class AuthCheck_tech
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
        if(!session()->has('techloginID')){
            return redirect('tech/')->with('fail', 'Please login first ');;
        }
        return $next($request);
    }
}
