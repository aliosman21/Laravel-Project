<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;


class UserAuth
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

        if(Auth::guard('user')->user() == null && $request->server->get('HTTP_AUTHORIZATION') == null ){
          return redirect()->route('users.login');
        }

         return $next($request);
     }
}
