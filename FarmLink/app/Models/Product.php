<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'unit',
        'category',
        'farm_name',
        'image_path',
        'stock_quantity',
        'is_active',
        'is_organic'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'is_organic' => 'boolean',
        'stock_quantity' => 'integer',
        'image_path' => 'array'
    ];

    public function getFormattedPriceAttribute()
    {
        return '₱' . number_format($this->price, 2);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock_quantity', '>', 0);
    }
}
