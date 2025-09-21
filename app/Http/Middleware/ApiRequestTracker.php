<?php

namespace App\Http\Middleware;

use App\Models\ApiRequest;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ApiRequestTracker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);
        
        $response = $next($request);
        
        $endTime = microtime(true);
        $responseTime = round(($endTime - $startTime) * 1000); // Convert to milliseconds
        
        // Only track API routes
        if (str_starts_with($request->path(), 'api/')) {
            $this->logApiRequest($request, $response, $responseTime);
        }
        
        return $response;
    }
    
    private function logApiRequest(Request $request, Response $response, int $responseTime): void
    {
        try {
            ApiRequest::create([
                'user_id' => Auth::id(),
                'method' => $request->method(),
                'endpoint' => '/' . $request->path(),
                'full_url' => $request->fullUrl(),
                'status_code' => $response->getStatusCode(),
                'response_time_ms' => $responseTime,
                'request_headers' => $this->sanitizeHeaders($request->headers->all()),
                'request_body' => $this->sanitizeBody($request->all()),
                'response_headers' => $this->sanitizeHeaders($response->headers->all()),
                'user_agent' => $request->userAgent(),
                'ip_address' => $request->ip(),
                'api_version' => $request->header('API-Version', 'v1'),
                'is_successful' => $response->isSuccessful(),
                'error_message' => $response->isSuccessful() ? null : $response->getContent(),
                'requested_at' => now(),
            ]);
        } catch (\Exception $e) {
            // Log silently to avoid breaking the API response
            Log::error('Failed to log API request: ' . $e->getMessage());
        }
    }
    
    private function sanitizeHeaders(array $headers): array
    {
        $sensitiveHeaders = ['authorization', 'cookie', 'x-api-key', 'x-auth-token'];
        
        foreach ($sensitiveHeaders as $header) {
            if (isset($headers[$header])) {
                $headers[$header] = ['[REDACTED]'];
            }
        }
        
        return $headers;
    }
    
    private function sanitizeBody(array $body): array
    {
        $sensitiveFields = ['password', 'token', 'secret', 'key', 'api_key'];
        
        foreach ($sensitiveFields as $field) {
            if (isset($body[$field])) {
                $body[$field] = '[REDACTED]';
            }
        }
        
        return $body;
    }
}
