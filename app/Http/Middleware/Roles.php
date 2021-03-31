<?php

namespace App\Http\Middleware;

use Closure;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Auth;

class Roles
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
        // dd(Auth::guard('user')->user());
         if(Auth::guard('user')->user()->hasRole('receptionist')){

             return redirect()->route('home');
         }
        return $next($request);
    }
}
