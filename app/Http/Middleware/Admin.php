<?php

namespace App\Http\Middleware;
use App\User;
use Closure;

class Admin
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
        if(auth()->guard('admin')->check() && auth()->guard('admin')->user()->user_type==3){
            return $next($request);
        }else{
            return redirect('/adminlogin')->with('failure','Login to access this url');
        }
        
    }
}
    