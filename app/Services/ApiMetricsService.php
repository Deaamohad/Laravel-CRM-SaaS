<?php

namespace App\Services;

use App\Models\ApiMetric;
use App\Models\ApiRequest;
use Carbon\Carbon;

class ApiMetricsService
{
    public function calculateDailyMetrics($date = null): ApiMetric
    {
        $date = $date ?? today();
        
        // Check if metrics already exist for this date
        $existingMetric = ApiMetric::where('date', $date)->first();
        
        if ($existingMetric) {
            return $this->updateMetrics($existingMetric, $date);
        }
        
        return $this->createMetrics($date);
    }
    
    public function getTodaysMetrics(): array
    {
        $today = today();
        $requests = ApiRequest::whereDate('requested_at', $today);
        
        $totalRequests = $requests->count();
        $successfulRequests = $requests->where('is_successful', true)->count();
        $failedRequests = $totalRequests - $successfulRequests;
        
        $averageResponseTime = $requests->avg('response_time_ms') ?? 0;
        $maxResponseTime = $requests->max('response_time_ms') ?? 0;
        $minResponseTime = $requests->min('response_time_ms') ?? 0;
        
        $uniqueUsers = $requests->distinct('user_id')->count('user_id');
        
        // Calculate uptime (assuming downtime when response time > 10 seconds or 5xx errors)
        $downtimeRequests = $requests->where(function($query) {
            $query->where('response_time_ms', '>', 10000)
                  ->orWhere('status_code', '>=', 500);
        })->count();
        
        $uptimePercentage = $totalRequests > 0 
            ? round((($totalRequests - $downtimeRequests) / $totalRequests) * 100, 2)
            : 100.00;
        
        return [
            'total_requests' => $totalRequests,
            'successful_requests' => $successfulRequests,
            'failed_requests' => $failedRequests,
            'average_response_time' => round($averageResponseTime, 2),
            'max_response_time' => $maxResponseTime,
            'min_response_time' => $minResponseTime,
            'uptime_percentage' => $uptimePercentage,
            'unique_users' => $uniqueUsers,
            'success_rate' => $totalRequests > 0 ? round(($successfulRequests / $totalRequests) * 100, 2) : 100,
        ];
    }
    
    public function getHourlyDistribution($date = null): array
    {
        $date = $date ?? today();
        
        $hourlyData = [];
        for ($hour = 0; $hour < 24; $hour++) {
            $hourlyData[$hour] = ApiRequest::whereDate('requested_at', $date)
                ->whereHour('requested_at', $hour)
                ->count();
        }
        
        return $hourlyData;
    }
    
    public function getEndpointUsage($date = null): array
    {
        $date = $date ?? today();
        
        return ApiRequest::whereDate('requested_at', $date)
            ->selectRaw('endpoint, COUNT(*) as count')
            ->groupBy('endpoint')
            ->orderByDesc('count')
            ->pluck('count', 'endpoint')
            ->toArray();
    }
    
    public function getStatusCodeBreakdown($date = null): array
    {
        $date = $date ?? today();
        
        return ApiRequest::whereDate('requested_at', $date)
            ->selectRaw('status_code, COUNT(*) as count')
            ->groupBy('status_code')
            ->orderBy('status_code')
            ->pluck('count', 'status_code')
            ->toArray();
    }
    
    private function createMetrics($date): ApiMetric
    {
        $metrics = $this->getTodaysMetrics();
        
        return ApiMetric::create([
            'date' => $date,
            'total_requests' => $metrics['total_requests'],
            'successful_requests' => $metrics['successful_requests'],
            'failed_requests' => $metrics['failed_requests'],
            'average_response_time' => $metrics['average_response_time'],
            'max_response_time' => $metrics['max_response_time'],
            'min_response_time' => $metrics['min_response_time'],
            'status_code_breakdown' => $this->getStatusCodeBreakdown($date),
            'endpoint_usage' => $this->getEndpointUsage($date),
            'uptime_percentage' => $metrics['uptime_percentage'],
            'unique_users' => $metrics['unique_users'],
            'hourly_distribution' => $this->getHourlyDistribution($date),
        ]);
    }
    
    private function updateMetrics(ApiMetric $metric, $date): ApiMetric
    {
        $metrics = $this->getTodaysMetrics();
        
        $metric->update([
            'total_requests' => $metrics['total_requests'],
            'successful_requests' => $metrics['successful_requests'],
            'failed_requests' => $metrics['failed_requests'],
            'average_response_time' => $metrics['average_response_time'],
            'max_response_time' => $metrics['max_response_time'],
            'min_response_time' => $metrics['min_response_time'],
            'status_code_breakdown' => $this->getStatusCodeBreakdown($date),
            'endpoint_usage' => $this->getEndpointUsage($date),
            'uptime_percentage' => $metrics['uptime_percentage'],
            'unique_users' => $metrics['unique_users'],
            'hourly_distribution' => $this->getHourlyDistribution($date),
        ]);
        
        return $metric->fresh();
    }
}
