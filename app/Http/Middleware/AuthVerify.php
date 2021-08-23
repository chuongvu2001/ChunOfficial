<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthVerify
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
        $user = DB::table('users')->where("email","like","%".$request->email."%");
        if($user->count() < 1){
            return redirect(url('login/member'))->with("error-auth","Tài khoản chưa được đăng ký. Xin mời thao tác lại.");
        }
        else{
            $firstuser = DB::table('users')->where("email","like","%".$request->email."%")->first();
            if($firstuser->confirmed == 1){
                return $next($request);
            }
            else{
                return redirect(url('login/member'))->with("error-auth","Tài khoản chưa được xác thực. Xin mời thao tác lại.");
            }
        }
    }
}
