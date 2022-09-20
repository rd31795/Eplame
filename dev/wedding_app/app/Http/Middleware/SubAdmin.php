<?php

namespace App\Http\Middleware;

use Closure;

class SubAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $menu, $permission)
    {
        if( \Auth::user()->role =="admin" ){                       
            return $next($request);
        }elseif(\Auth::user()->role =="subadmin"){
            if(hasPermission($menu, $permission) == 1){
                return $next($request);
            }
        }
        return redirect()->route('admin_dashboard');

    }
}
