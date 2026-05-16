<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function update(Request $request, Product $product) {
        $request->validate([
            'quantity' => 'required|integer',
            'type' => 'required|in:in,out',
            'note' => 'nullable|string'
        ]);

        // Update stok di tabel produk
        if ($request->type == 'in') {
            $product->increment('stock', $request->quantity);
        } else {
            $product->decrement('stock', $request->quantity);
        }

        // Catat riwayat
        StockMovement::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            'type' => $request->type,
            'quantity' => $request->quantity,
            'note' => $request->note
        ]);

        return back()->with('success', 'Stok berhasil diperbarui!');
    }
}