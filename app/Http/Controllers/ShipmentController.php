<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\User;
use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index() {
        $shipments = Shipment::with(['user', 'product'])->latest()->get();
        return view('shipments.index', compact('shipments'));
    }

    public function create() {
        $staffUsers = User::where('role', 'staf')->get();
        $products = Product::where('stock', '>', 0)->get(); // Hanya tampilkan produk yang stoknya > 0
        return view('shipments.create', compact('staffUsers', 'products'));
    }

    public function store(Request $request) {
        $request->validate([
            'tracking_code' => 'required|unique:shipments',
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:pending,on_delivery,delivered',
            'destination' => 'required|string'
        ]);

        // Cek apakah stok mencukupi
        $product = Product::findOrFail($request->product_id);
        if ($request->quantity > $product->stock) {
            return back()->withErrors(['quantity' => 'Jumlah melebihi stok tersedia (' . $product->stock . ' unit).'])->withInput();
        }

        $shipment = Shipment::create([
            'tracking_code' => $request->tracking_code,
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'status' => $request->status,
            'destination' => $request->destination
        ]);

        // Jika langsung delivered, kurangi stok sekarang
        if ($request->status === 'delivered') {
            $product->decrement('stock', $request->quantity);

            // Catat riwayat mutasi stok
            StockMovement::create([
                'product_id' => $product->id,
                'user_id' => auth()->id(),
                'type' => 'out',
                'quantity' => $request->quantity,
                'note' => 'Pengiriman #' . $request->tracking_code . ' - Delivered'
            ]);
        }

        return redirect()->route('shipments.index')->with('success', 'Pengiriman berhasil dibuat!');
    }

    public function edit(Shipment $shipment) {
        $staffUsers = User::where('role', 'staf')->get();
        $products = Product::all();
        return view('shipments.edit', compact('shipment', 'staffUsers', 'products'));
    }

    public function update(Request $request, Shipment $shipment) {
        $request->validate([
            'tracking_code' => 'required|unique:shipments,tracking_code,' . $shipment->id,
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:pending,on_delivery,delivered',
            'destination' => 'required|string'
        ]);

        $product = Product::findOrFail($request->product_id);
        $oldStatus = $shipment->status;
        $newStatus = $request->status;

        // Cek stok hanya jika status berubah menjadi delivered (dan sebelumnya bukan delivered)
        if ($newStatus === 'delivered' && $oldStatus !== 'delivered') {
            if ($request->quantity > $product->stock) {
                return back()->withErrors(['quantity' => 'Jumlah melebihi stok tersedia (' . $product->stock . ' unit).'])->withInput();
            }

            // Kurangi stok produk
            $product->decrement('stock', $request->quantity);

            // Catat riwayat mutasi stok
            StockMovement::create([
                'product_id' => $product->id,
                'user_id' => auth()->id(),
                'type' => 'out',
                'quantity' => $request->quantity,
                'note' => 'Pengiriman #' . $request->tracking_code . ' - Delivered'
            ]);
        }

        // Jika status berubah dari delivered ke status lain, kembalikan stok
        if ($oldStatus === 'delivered' && $newStatus !== 'delivered') {
            $product->increment('stock', $shipment->quantity);

            StockMovement::create([
                'product_id' => $product->id,
                'user_id' => auth()->id(),
                'type' => 'in',
                'quantity' => $shipment->quantity,
                'note' => 'Pembatalan pengiriman #' . $shipment->tracking_code . ' - Stok dikembalikan'
            ]);
        }

        $shipment->update([
            'tracking_code' => $request->tracking_code,
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'status' => $request->status,
            'destination' => $request->destination
        ]);

        return redirect()->route('shipments.index')->with('success', 'Pengiriman berhasil diperbarui!');
    }

    public function destroy(Shipment $shipment) {
        // Jika shipment yang dihapus statusnya delivered, kembalikan stok
        if ($shipment->status === 'delivered' && $shipment->product) {
            $shipment->product->increment('stock', $shipment->quantity);

            StockMovement::create([
                'product_id' => $shipment->product_id,
                'user_id' => auth()->id(),
                'type' => 'in',
                'quantity' => $shipment->quantity,
                'note' => 'Hapus pengiriman #' . $shipment->tracking_code . ' - Stok dikembalikan'
            ]);
        }

        $shipment->delete();
        return redirect()->route('shipments.index')->with('success', 'Pengiriman berhasil dihapus!');
    }
}
