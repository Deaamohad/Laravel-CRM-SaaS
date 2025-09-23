<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SanitizeInput
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Sanitize all input data
        $input = $request->all();
        $sanitizedInput = $this->sanitizeArray($input);
        
        // Replace the request input with sanitized data
        $request->replace($sanitizedInput);
        
        return $next($request);
    }
    
    /**
     * Recursively sanitize an array of input data
     *
     * @param  array  $data
     * @return array
     */
    private function sanitizeArray(array $data): array
    {
        $sanitized = [];
        
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $sanitized[$key] = $this->sanitizeArray($value);
            } elseif (is_string($value)) {
                // Skip sanitization for password fields and tokens
                if (in_array($key, ['password', 'password_confirmation', 'token', 'api_token', 'secret'])) {
                    $sanitized[$key] = $value;
                } else {
                    $sanitized[$key] = $this->sanitizeString($value);
                }
            } else {
                $sanitized[$key] = $value;
            }
        }
        
        return $sanitized;
    }
    
    /**
     * Sanitize a string value
     *
     * @param  string  $value
     * @return string
     */
    private function sanitizeString(string $value): string
    {
        // Remove HTML tags
        $sanitized = strip_tags($value);
        
        // Decode HTML entities to prevent double encoding
        $sanitized = html_entity_decode($sanitized, ENT_QUOTES, 'UTF-8');
        
        // Re-encode special characters for security
        $sanitized = htmlspecialchars($sanitized, ENT_QUOTES, 'UTF-8');
        
        // Remove any remaining potentially dangerous characters
        $sanitized = preg_replace('/[<>"\']/', '', $sanitized);
        
        // Remove excessive whitespace
        $sanitized = preg_replace('/\s+/', ' ', $sanitized);
        
        return trim($sanitized);
    }
}

