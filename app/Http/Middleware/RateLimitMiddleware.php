<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RateLimitMiddleware
{

    protected $maxAttempts = 60;
    protected $decaySeconds = 60;

    public function handle(Request $request, Closure $next)
    {
        // You can also use user_id if you require authentication to post messages.
        // For example: $key = 'rate_limit_user_' . auth()->id();
        $key = 'rate_limit_ip_' . $request->ip();

        // Get current number of requests made within the time window.
        $attempts = Cache::get($key, 0);

        // Check if the request count has exceeded max allowed attempts.
        if ($attempts >= $this->maxAttempts) {
            return response()->json([
                'message' => 'Too many requests. Please slow down.'
            ], 429);
        }

        // Increment attempts and store back in cache.
        // The cache entry will expire after $decaySeconds.
        Cache::put($key, $attempts + 1, $this->decaySeconds);

        return $next($request);
    }
}
