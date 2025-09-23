<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiMetric extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'total_requests',
        'successful_requests',
        'failed_requests',
        'average_response_time',
        'max_response_time',
        'min_response_time',
        'status_code_breakdown',
        'endpoint_usage',
        'uptime_percentage',
        'unique_users',
        'hourly_distribution',
    ];

    protected $casts = [
        'date' => 'date',
        'status_code_breakdown' => 'array',
        'endpoint_usage' => 'array',
        'hourly_distribution' => 'array',
        'average_response_time' => 'decimal:2',
        'uptime_percentage' => 'decimal:2',
    ];

    public function scopeToday($query)
    {
        return $query->whereDate('date', today());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('date', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ]);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('date', now()->month)
                    ->whereYear('date', now()->year);
    }
}
