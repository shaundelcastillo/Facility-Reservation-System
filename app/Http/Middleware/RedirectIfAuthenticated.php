<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
 public function handle($request, \Closure $next, ...$guards)
{
    $guards = empty($guards) ? [null] : $guards;

    foreach ($guards as $guard) {
        if (auth()->guard($guard)->check()) {
            // This is the logic that separates Admin from User
            if (auth()->user()->role === 'admin') {
                return redirect()->route('admin.home');
            }
            
            // This is where standard users go
            return redirect('/home'); 
        }
    }

    return $next($request);
}