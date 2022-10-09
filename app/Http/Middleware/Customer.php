<?php

namespace App\Http\Middleware;
use App\Models\Customer;
use Closure;

class Customer
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
        if(auth()->guard('customer')->check()){
            return $next($request);
        }
        return redirect('/')->with('failure','Login to access this url');
        
    }
}
    