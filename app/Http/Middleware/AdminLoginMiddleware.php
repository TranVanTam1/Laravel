<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //dd("phải cần có quyền truy cập admin hoặc kỹ thuật viên");
        if(Auth::check()){
            $user=Auth::user();
            if($user->level==1 || $user->level==2 ){
                return $next($request);
            }
            else {
                return redirect('/admin/dangnhap');
            }
        }
        else {
            return redirect('/admin/dangnhap');
        }

    }
}
