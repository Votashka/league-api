<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $apiKey = $request->header('api-token');

        if (empty($apiKey)) {
            return response()->json(['message' => 'api-token header has been missed'], 403);
        }

        if ($apiKey !== 'a6BXF5U4grsdE7CFoxVKcwPvuAUw3mzEUb9tevbu') {
            return response()->json(['message' => 'Wrong token'], 403);
        }

        return $next($request);
    }
}
