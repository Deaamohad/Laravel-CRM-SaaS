<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'type',
        'notes',
        'company_id',
        'user_id',
        'deal_id',
        'interaction_date'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Contact relation removed

    public function deal()
    {
        return $this->belongsTo(Deal::class);
    }
}
