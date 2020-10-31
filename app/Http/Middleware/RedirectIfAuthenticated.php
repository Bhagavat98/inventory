<?php

namespace Inventory\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }

        // if (  (Auth::user()->is_super_admin || Auth::user()->is_admin || Auth::user()->is_user || Auth::user()->is_admin ) ) {
        //     return redirect('/home')->with('errorMessage','You are not authorized to perform this operation!');
        // }

        return $next($request);
    }
}
