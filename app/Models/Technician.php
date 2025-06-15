<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Technician extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_id';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'specialization',
        'experience_years',
        'skills',
    ];

    protected function casts(): array
    {
        return [
            'skills' => 'array',
            'experience_years' => 'integer',
        ];
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class, 'technician_id', 'user_id');
    }

    // Scopes
    public function scopeBySpecialization($query, $specialization)
    {
        return $query->where('specialization', $specialization);
    }

    public function scopeExperienced($query, $minYears = 2)
    {
        return $query->where('experience_years', '>=', $minYears);
    }

    public function scopeAvailable($query)
    {
        return $query->whereDoesntHave('serviceRequests', function ($q) {
            $q->where('status', 'in_progress');
        });
    }

    // Helper methods
    public function hasSkill(string $skill): bool
    {
        return in_array($skill, $this->skills ?? []);
    }

    public function addSkill(string $skill): bool
    {
        $skills = $this->skills ?? [];
        if (!in_array($skill, $skills)) {
            $skills[] = $skill;
            $this->skills = $skills;
            return $this->save();
        }
        return false;
    }

    public function getExperienceLevelAttribute(): string
    {
        if ($this->experience_years >= 10) {
            return 'Expert';
        } elseif ($this->experience_years >= 5) {
            return 'Senior';
        } elseif ($this->experience_years >= 2) {
            return 'Intermediate';
        } else {
            return 'Junior';
        }
    }
}
