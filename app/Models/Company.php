<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'email', 
        'phone'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function deals()
    {
        return $this->hasMany(Deal::class);
    }

    public function interactions()
    {
        return $this->hasMany(Interaction::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Accessor for company initials
    public function getInitialsAttribute()
    {
        return strtoupper(substr($this->name, 0, 1));
    }
}
