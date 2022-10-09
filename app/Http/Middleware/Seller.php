<?php

namespace App\Http\Middleware;
use App\User;
use Closure;

class Seller
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
        if(auth()->guard('seller')->check() && auth()->guard('seller')->user()->user_type==2){
            return $next($request);
        }
        return redirect('/sellerlogin')->with('failure','Login to access this url');
        
    }
}
    