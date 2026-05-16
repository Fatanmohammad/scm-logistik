<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\StockMovement;

class ProductObserver
{
    public function updated(Product $product): void
    {
        if ($product->isDirty('stock')) {
            $oldStock = $product->getOriginal('stock');
            $newStock = $product->stock;
            $diff     = $newStock - $oldStock;

            StockMovement::create([
                'product_id' => $product->id,
                'user_id'    => auth()->id(),
                'type'       => $diff > 0 ? 'in' : 'out',
                'quantity'   => abs($diff),
                'note'       => 'Update stok otomatis',
            ]);
        }
    }
}