<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    public function create() {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name'        => 'required',
            'sku'         => 'required|unique:products',
            'category_id' => 'required',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer'
        ]);

        Product::create($data);
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product) {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product) {
        $data = $request->validate([
            'name'        => 'required',
            'sku'         => 'required|unique:products,sku,' . $product->id,
            'category_id' => 'required',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer'
        ]);

        $product->update($data);
        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product) {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}