<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateApiRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only apply to API routes
        if (!$request->is('api/*')) {
            return $next($request);
        }
        
        // Validate Content-Type for POST/PUT/PATCH requests
        if (in_array($request->method(), ['POST', 'PUT', 'PATCH'])) {
            $contentType = $request->header('Content-Type');
            if (!$contentType || !str_contains($contentType, 'application/json')) {
                return response()->json([
                    'error' => 'Invalid Content-Type',
                    'message' => 'Content-Type must be application/json for this request'
                ], 415);
            }
        }
        
        // Validate Accept header
        $accept = $request->header('Accept');
        if (!$accept || !str_contains($accept, 'application/json')) {
            return response()->json([
                'error' => 'Invalid Accept header',
                'message' => 'Accept header must include application/json'
            ], 406);
        }
        
        // Check for suspicious patterns in request data
        $this->checkSuspiciousPatterns($request);
        
        return $next($request);
    }
    
    /**
     * Check for suspicious patterns in request data
     *
     * @param  Request  $request
     * @return void
     */
    private function checkSuspiciousPatterns(Request $request): void
    {
        $input = $request->all();
        $this->scanForSuspiciousContent($input);
    }
    
    /**
     * Recursively scan input for suspicious content
     *
     * @param  mixed  $data
     * @param  string  $path
     * @return void
     */
    private function scanForSuspiciousContent($data, string $path = ''): void
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $currentPath = $path ? "{$path}.{$key}" : $key;
                $this->scanForSuspiciousContent($value, $currentPath);
            }
        } elseif (is_string($data)) {
            $this->checkStringForSuspiciousContent($data, $path);
        }
    }
    
    /**
     * Check a string for suspicious content
     *
     * @param  string  $value
     * @param  string  $path
     * @return void
     */
    private function checkStringForSuspiciousContent(string $value, string $path): void
    {
        // Check for SQL injection patterns
        $sqlPatterns = [
            '/(\bunion\b.*\bselect\b)/i',
            '/(\bselect\b.*\bfrom\b)/i',
            '/(\binsert\b.*\binto\b)/i',
            '/(\bupdate\b.*\bset\b)/i',
            '/(\bdelete\b.*\bfrom\b)/i',
            '/(\bdrop\b.*\btable\b)/i',
            '/(\balter\b.*\btable\b)/i',
            '/(\bexec\b|\bexecute\b)/i',
            '/(\bscript\b.*\bsrc\b)/i',
            '/(\bonload\b|\bonerror\b|\bonclick\b)/i',
        ];
        
        foreach ($sqlPatterns as $pattern) {
            if (preg_match($pattern, $value)) {
                \Log::warning('Suspicious content detected', [
                    'path' => $path,
                    'value' => substr($value, 0, 100),
                    'pattern' => $pattern,
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                ]);
                break;
            }
        }
        
        // Check for XSS patterns
        $xssPatterns = [
            '/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/i',
            '/<iframe\b[^<]*(?:(?!<\/iframe>)<[^<]*)*<\/iframe>/i',
            '/javascript:/i',
            '/on\w+\s*=/i',
        ];
        
        foreach ($xssPatterns as $pattern) {
            if (preg_match($pattern, $value)) {
                \Log::warning('XSS pattern detected', [
                    'path' => $path,
                    'value' => substr($value, 0, 100),
                    'pattern' => $pattern,
                    'ip' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                ]);
                break;
            }
        }
    }
}

