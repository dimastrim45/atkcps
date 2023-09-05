<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // return redirect(RouteServiceProvider::HOME);
                // return redirect()->intended('/view')
                if (auth()->user()->license === 'administrator') {
                    return redirect(RouteServiceProvider::HOME);
                } else  if (auth()->user()->license === 'staff'){
                    return redirect(RouteServiceProvider::HOME);
                } else  if (auth()->user()->license === 'hradmin'){
                    return redirect(RouteServiceProvider::HOME);
                } else  if (auth()->user()->license === 'manager'){
                    return redirect(RouteServiceProvider::NEWITEMADMIN);
                } else {
                    return redirect()->intended('/');
                }
            }
        }

        return $next($request);
    }
}
