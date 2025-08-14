<?php

namespace App\Http\Middleware;

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
    public function handle(Request $request, Closure $next, $guard = null): Response
    {
        if (Auth::guard($guard)->check()) {
            // Redirect based on the authenticated guard
            switch ($guard) {
                case 'admin':
                    return redirect()->intended('/admin/dashboard'); // Change as needed
                case 'agent':
                    return redirect()->intended('/agent/dashboard'); // Change as needed
                case 'vendor':
                    return redirect()->intended('/vendor/dashboard'); // Change as needed
                case 'web':
                    return redirect()->intended('/user/dashboard'); // Change as needed
                default:
                    return redirect()->intended('/'); // Default redirect
            }
        }

        return $next($request);
    }
}
