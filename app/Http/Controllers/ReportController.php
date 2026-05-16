<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function mutation() {
        // Mengambil data mutasi stok terbaru beserta relasi produk dan user
        $movements = StockMovement::with(['product', 'user'])->latest()->get();
        return view('reports.mutation', compact('movements'));
    }

    public function stock() {
        // Mengambil data produk beserta kategori untuk laporan stok
        $products = Product::with('category')->get();
        return view('reports.stock', compact('products'));
    }
}