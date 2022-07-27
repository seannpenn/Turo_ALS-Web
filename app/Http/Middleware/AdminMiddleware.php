<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        // admin == 1

        if(Auth::check()){
            if(Auth::user()->userType === 1){
                return $next($request);
            }
            else{
                return redirect()->back()->with('message', 'Access Denied. You dont have any control!');
            }
        }
        else{
            return redirect()->back();
        }
    }
}
