<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
       //       dd( Hash::make('123456'));
        if(Auth::check() && Auth::user()->role == 100){
            return $next($request);
        }
        return redirect(url('login/admin'));
    }
}
