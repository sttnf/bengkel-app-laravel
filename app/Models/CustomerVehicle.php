<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerVehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vehicle_id',
        'year',
        'license_plate',
        'color',
        'vin_number',
    ];

    protected function casts(): array
    {
        return [
            'year' => 'integer',
        ];
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class, 'vehicle_id');
    }

    // Scopes
    public function scopeByOwner($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByYear($query, $year)
    {
        return $query->where('year', $year);
    }

    public function scopeByBrand($query, $brand)
    {
        return $query->whereHas('vehicle', function ($q) use ($brand) {
            $q->where('brand', $brand);
        });
    }

    // Helper methods
    public function getFullDescriptionAttribute(): string
    {
        $vehicleName = $this->vehicle ? $this->vehicle->full_name : 'Unknown Vehicle';
        return "{$this->year} {$vehicleName} ({$this->license_plate})";
    }

    public function getAgeAttribute(): int
    {
        return now()->year - $this->year;
    }

    public function isVintage(): bool
    {
        return $this->age >= 25;
    }

    public function getLastServiceAttribute()
    {
        return $this->serviceRequests()
                    ->where('status', 'completed')
                    ->latest('completion_datetime')
                    ->first();
    }
}
