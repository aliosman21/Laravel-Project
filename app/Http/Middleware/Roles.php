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
        
         if(Auth::guard('user')->user()->hasRole('receptionist')){

             return redirect()->route('users.nonApprovedClients');
         }
        return $next($request);
    }
}
