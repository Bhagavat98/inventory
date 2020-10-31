<?php

namespace Inventory\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( ! (Auth::user()->is_super_admin == 1 ) ) {
            return redirect('/home')->with('error','You are not authorized to perform this operation!');
        }

        return $next($request);
    }
}
