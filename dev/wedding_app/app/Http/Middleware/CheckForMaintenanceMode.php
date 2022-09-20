<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;

class CheckForMaintenanceMode extends Middleware
{
    /**
     * The URIs that should be reachable while maintenance mode is enabled.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    public function handle($request, Closure $next){
       if($this->app->isDownForMaintenance()){
        if($request->is('admin*') || $request->is('maintanance')){
            return $next($request);
        }else{
            return new RedirectResponse(url('/maintanance'));
        }
       }else{
       	if(!$request->is('maintanance')){
            return $next($request);
        }
        else{
        	return redirect('/');
        }
       }
    }
}
