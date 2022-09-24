<?php

namespace App\Http\Middleware;

use Closure;

class AuthCheck_employee
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
        if(!session()->has('employeeID')){
            return redirect('employee/')->with('fail', 'Please login first ');;
        }
        return $next($request);
    }
}
