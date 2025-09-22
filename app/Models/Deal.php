<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'value',
        'stage',
        'company_id',
        'user_id'
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    /**
     * The "booted" method of the model.
     * Apply a default ordering to all queries
     */
    protected static function booted()
    {
        static::addGlobalScope('order', function ($query) {
            $query->latest('created_at');
        });
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function interactions()
    {
        return $this->hasMany(Interaction::class);
    }

    // Scopes for common queries
    public function scopeClosed($query)
    {
        return $query->where('stage', 'closed-won');
    }

    public function scopePending($query)
    {
        return $query->where('stage', 'new');
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
    }
}
