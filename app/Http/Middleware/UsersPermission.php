<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UsersPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role == 3 || auth()->user()->role == 4 || auth()->user()->role == 5) {
            return redirect('/dashboard');
        }
        return $next($request);
    }
}
