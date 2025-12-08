<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_name',
        'name',
        'description',
        'price',
        'unit_measure',
        'unit',
        'product_category',
        'category',
        'farm_name',
        'image_path',
        'image_url',
        'avail_qty',
        'stock_quantity',
        'is_active',
        'is_organic',
        'accID',
        'status'
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

    /**
     * Get the seller (user) that owns the product
     */
    public function seller()
    {
        return $this->belongsTo(User::class, 'accID');
    }
}
