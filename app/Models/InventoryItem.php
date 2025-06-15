<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventoryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'unit_price',
        'current_stock',
        'reorder_level',
        'unit',
        'part_number',
        'supplier',
        'location',
    ];

    protected function casts(): array
    {
        return [
            'unit_price' => 'decimal:2',
            'current_stock' => 'integer',
            'reorder_level' => 'integer',
        ];
    }

    // Scopes
    public function scopeLowStock($query)
    {
        return $query->whereColumn('current_stock', '<=', 'reorder_level');
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // Helper methods
    public function isLowStock(): bool
    {
        return $this->current_stock <= $this->reorder_level;
    }

    public function getTotalValue(): float
    {
        return $this->current_stock * $this->unit_price;
    }

    public function updateStock(int $quantity): bool
    {
        $this->current_stock += $quantity;
        return $this->save();
    }
}
