<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'description',
        'base_price',
        'estimated_hours',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'base_price' => 'decimal:2',
            'estimated_hours' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    // Relationships
    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class);
    }

    // Scopes
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopePopular($query, $limit = 10)
    {
        return $query->withCount('serviceRequests')
                    ->orderBy('service_requests_count', 'desc')
                    ->limit($limit);
    }

    // Accessors
    public function getPriceAttribute()
    {
        return $this->base_price;
    }

    public function getDurationAttribute()
    {
        return $this->estimated_hours;
    }

    // Helper methods
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->base_price, 0, ',', '.');
    }

    public function getEstimatedDurationAttribute(): string
    {
        $hours = floor($this->estimated_hours);
        $minutes = ($this->estimated_hours - $hours) * 60;
        
        if ($hours > 0 && $minutes > 0) {
            return "{$hours}h {$minutes}m";
        } elseif ($hours > 0) {
            return "{$hours}h";
        } else {
            return "{$minutes}m";
        }
    }
}
