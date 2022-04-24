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
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (Auth::check() && $user->hasRole('admin')) {
            return redirect(route('dash.admin'));
        }

        if (Auth::check()) {
            return redirect(route('campus'));
        }

        return $next($request);
    }
}
