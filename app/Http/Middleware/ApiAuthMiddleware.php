<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check for API token in header
        $token = $request->bearerToken();
        
        if (!$token) {
            return response()->json([
                'error' => 'API token required',
                'message' => 'Please provide a valid API token in Authorization header'
            ], 401);
        }
        
        // In production, validate token against database
        if ($token !== config('app.api_key', 'your-secret-api-key')) {
            return response()->json([
                'error' => 'Invalid API token',
                'message' => 'The provided API token is invalid'
            ], 401);
        }
        
        return $next($request);
    }
}