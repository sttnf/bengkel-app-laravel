<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
    ];

    // Relationships
    public function customerVehicles()
    {
        return $this->hasMany(CustomerVehicle::class);
    }

    // Scopes
    public function scopeByBrand($query, $brand)
    {
        return $query->where('brand', $brand);
    }

    public function scopePopular($query, $limit = 10)
    {
        return $query->withCount('customerVehicles')
                    ->orderBy('customer_vehicles_count', 'desc')
                    ->limit($limit);
    }

    // Helper methods
    public function getFullNameAttribute(): string
    {
        return "{$this->brand} {$this->model}";
    }

    public static function getBrands(): array
    {
        return self::distinct('brand')->pluck('brand')->toArray();
    }

    public static function getModelsByBrand(string $brand): array
    {
        return self::where('brand', $brand)->pluck('model')->toArray();
    }
}
