<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    // Mass assignment protection
    protected $fillable = ['name', 'sku', 'category_id', 'stock', 'price'];

    // Relasi ke kategori barang
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke riwayat stok/pergerakan barang
    public function movements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }
}