<?php

namespace App\Http\Middleware;

use Closure;

class AuthCheck_user
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
        if(!session()->has('loginID')){
            return redirect('admin/')->with('fail', 'Please login first ');;
        }
        return $next($request);
    }
}
