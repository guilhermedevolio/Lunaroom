<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnlyVisitants
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
        if(Auth::check() && Auth::user()->admin){
            return redirect(route('dash.admin'));
        }

        if(Auth::check() && !Auth::user()->admin){
             return redirect(route('welcome'));
        }

        return $next($request);
    }
}
