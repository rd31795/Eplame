<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next,$guard = null)
    {

        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {

                return redirect('admin/login');
            }
        }else{
            if( \Auth::user()->role =="admin" || \Auth::user()->role =="subadmin"){                       
                        return $next($request);
            }
        }
        return redirect()->route('admin_login');

    }
     
}
