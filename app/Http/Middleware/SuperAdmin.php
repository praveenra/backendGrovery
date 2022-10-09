<?php

namespace App\Http\Middleware;
use App\User;
use Closure;

class SuperAdmin
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
        if(auth()->guard('superadmin')->check() && auth()->guard('superadmin')->user()->user_type==4){
            return $next($request);
        }
        return redirect('/superadminlogin')->with('failure','Login to access this url');
        
    }
}
    