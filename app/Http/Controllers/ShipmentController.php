<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\User;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index() {
        $shipments = Shipment::with('user')->latest()->get();
        return view('shipments.index', compact('shipments'));
    }

    public function create() {
        // Ambil semua user dengan role 'staf' sebagai pilihan kurir
        $kurirs = User::where('role', 'staf')->get();
        return view('shipments.create', compact('kurirs'));
    }

    public function store(Request $request) {
        $request->validate([
            'tracking_code' => 'required|unique:shipments',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,on_delivery,delivered',
            'destination' => 'required|string'
        ]);

        Shipment::create([
            'tracking_code' => $request->tracking_code,
            'user_id' => $request->user_id,
            'status' => $request->status,
            'destination' => $request->destination
        ]);

        return redirect()->route('shipments.index')->with('success', 'Pengiriman berhasil dibuat!');
    }


    public function edit(Shipment $shipment) {
        $kurirs = User::where('role', 'staf')->get();
        return view('shipments.edit', compact('shipment', 'kurirs'));
    }

    public function update(Request $request, Shipment $shipment) {
        $request->validate([
            'tracking_code' => 'required|unique:shipments,tracking_code,' . $shipment->id,
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,on_delivery,delivered',
            'destination' => 'required|string'
        ]);

        $shipment->update([
            'tracking_code' => $request->tracking_code,
            'user_id' => $request->user_id,
            'status' => $request->status,
            'destination' => $request->destination
        ]);

        return redirect()->route('shipments.index')->with('success', 'Pengiriman berhasil diperbarui!');
    }

    public function destroy(Shipment $shipment) {
        $shipment->delete();
        return redirect()->route('shipments.index')->with('success', 'Pengiriman berhasil dihapus!');
    }
}
