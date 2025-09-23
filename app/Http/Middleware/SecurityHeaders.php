<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        
        try {
            // Add security headers
            $response->headers->set('X-Content-Type-Options', 'nosniff');
            $response->headers->set('X-Frame-Options', 'DENY');
            $response->headers->set('X-XSS-Protection', '1; mode=block');
            $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
            $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');
            
            // Add HSTS header for HTTPS (only in production)
            if ($request->isSecure()) {
                $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
            }
            
            // Add CSP header for API routes
            if ($request->is('api/*')) {
                $response->headers->set('Content-Security-Policy', "default-src 'none'; frame-ancestors 'none';");
            }
        } catch (Exception $e) {
            // Log error but don't break the response
            \Log::error('SecurityHeaders middleware error: ' . $e->getMessage());
        }
        
        return $response;
    }
}
