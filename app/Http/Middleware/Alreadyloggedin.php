<?php

namespace App\Http\Middleware;

use Closure;

class Alreadyloggedin
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
            return redirect('admin/dashboard');
        }
        return $next($request);
    }
}
