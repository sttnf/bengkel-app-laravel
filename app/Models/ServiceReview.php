<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'rating',
        'review_text',
        'review_date',
    ];

    protected function casts(): array
    {
        return [
            'rating' => 'integer',
            'review_date' => 'datetime',
        ];
    }

    // Relationships
    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class, 'request_id');
    }

    // Scopes
    public function scopeByRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }

    public function scopePositive($query)
    {
        return $query->where('rating', '>=', 4);
    }

    public function scopeNegative($query)
    {
        return $query->where('rating', '<=', 2);
    }

    public function scopeRecent($query, $days = 30)
    {
        return $query->where('review_date', '>=', now()->subDays($days));
    }

    // Helper methods
    public function isPositive(): bool
    {
        return $this->rating >= 4;
    }

    public function isNeutral(): bool
    {
        return $this->rating === 3;
    }

    public function isNegative(): bool
    {
        return $this->rating <= 2;
    }

    public function getSentimentAttribute(): string
    {
        if ($this->isPositive()) {
            return 'Positive';
        } elseif ($this->isNeutral()) {
            return 'Neutral';
        } else {
            return 'Negative';
        }
    }

    public function getStarsAttribute(): string
    {
        return str_repeat('★', $this->rating) . str_repeat('☆', 5 - $this->rating);
    }

    public function getRatingColorAttribute(): string
    {
        return match(true) {
            $this->rating >= 4 => 'green',
            $this->rating === 3 => 'yellow',
            $this->rating <= 2 => 'red',
            default => 'gray'
        };
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($review) {
            if (!$review->review_date) {
                $review->review_date = now();
            }
        });
    }
}
