<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApiRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'method',
        'endpoint',
        'full_url',
        'status_code',
        'response_time_ms',
        'request_headers',
        'request_body',
        'response_headers',
        'response_body',
        'user_agent',
        'ip_address',
        'api_version',
        'is_successful',
        'error_message',
        'requested_at',
    ];

    protected $casts = [
        'request_headers' => 'array',
        'request_body' => 'array',
        'response_headers' => 'array',
        'is_successful' => 'boolean',
        'requested_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSuccessful($query)
    {
        return $query->where('is_successful', true);
    }

    public function scopeFailed($query)
    {
        return $query->where('is_successful', false);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('requested_at', today());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('requested_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ]);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('requested_at', now()->month)
                    ->whereYear('requested_at', now()->year);
    }
}
