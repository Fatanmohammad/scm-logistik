<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shipment extends Model
{
    protected $fillable = ['tracking_code', 'user_id', 'product_id', 'status', 'destination'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class); // Kurir yang mengantar
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}