<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackUserTimeMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = auth()->user();
            $now = now();
            
            if ($user->last_seen_at) {
                // Ensure we get a positive integer for seconds difference
                $diffInSeconds = (int) abs($now->diffInSeconds($user->last_seen_at));
                
                // If the user was active within the last 15 minutes (900 seconds),
                // consider it as continuous active time and add to total.
                // If difference is greater, it means they left and came back (new session).
                if ($diffInSeconds < 900) {
                    // Update directly via query builder to avoid firing events/timestamps continuously
                    \DB::table('users')
                        ->where('id', $user->id)
                        ->increment('total_time_spent', $diffInSeconds, [
                            'last_seen_at' => $now
                        ]);
                    return $next($request);
                }
            }
            
            // Just update last seen
            \DB::table('users')
                ->where('id', $user->id)
                ->update(['last_seen_at' => $now]);
        }

        return $next($request);
    }
}
