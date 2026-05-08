<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ProfileCompleteMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'user') {
            if (!Auth::user()->is_profile_complete) {
                // Allow them to submit the profile form or view it
                if (!$request->routeIs('user.complete.profile') && !$request->routeIs('user.complete.profile.submit') && !$request->routeIs('logout')) {
                    return redirect()->route('user.complete.profile');
                }
            }
        }
        return $next($request);
    }
}
