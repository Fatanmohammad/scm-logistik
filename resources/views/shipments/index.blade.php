<x-app-layout>
    <div class="space-y-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight uppercase">
                    Logistik <span class="text-emerald-600">Shipment</span>
                </h2>
                <p class="text-xs text-slate-400 font-semibold mt-0.5 uppercase tracking-wider">Daftar seluruh pengiriman barang logistik.</p>
            </div>
            @if(in_array(Auth::user()->role, ['admin', 'staf']))
            <a href="{{ route('shipments.create') }}" class="px-8 py-4 bg-emerald-600 hover:bg-emerald-500 text-white text-[10px] font-black rounded-2xl transition-all shadow-xl shadow-emerald-500/20 tracking-widest uppercase">
                + Tambah Pengiriman
            </a>
            @endif
        </div>

        @if(session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-2xl">
            <p class="text-sm font-semibold text-emerald-700">{{ session('success') }}</p>
        </div>
        @endif

        <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/60 border border-white overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-100 bg-slate-50/50">
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">No Resi</th>
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Barang (SKU)</th>
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Jumlah</th>
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Kurir</th>
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Status</th>
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Tujuan</th>
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Tanggal</th>
                            @if(in_array(Auth::user()->role, ['admin', 'staf']))
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-center">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($shipments as $shipment)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="p-6">
                                <span class="px-3 py-1.5 bg-slate-100 text-slate-600 text-[10px] font-black rounded-lg border border-slate-200 uppercase">{{ $shipment->tracking_code }}</span>
                            </td>
                            <td class="p-6">
                                <p class="text-sm font-bold text-slate-700">{{ $shipment->product->name ?? '-' }}</p>
                                <p class="text-[10px] font-bold text-indigo-500 uppercase tracking-wider">SKU: {{ $shipment->product->sku ?? '-' }}</p>
                            </td>
                            <td class="p-6">
                                <span class="px-3 py-1 bg-slate-100 text-slate-600 text-xs font-bold rounded-lg border border-slate-200">{{ $shipment->quantity }} Unit</span>
                            </td>
                            <td class="p-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-[10px] font-black border border-emerald-100">K</div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-700">{{ $shipment->user->name ?? '-' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                @if($shipment->status === 'pending')
                                    <span class="px-3 py-1.5 bg-amber-50 text-amber-600 text-[10px] font-black rounded-lg border border-amber-200 uppercase">Pending</span>
                                @elseif($shipment->status === 'on_delivery')
                                    <span class="px-3 py-1.5 bg-blue-50 text-blue-600 text-[10px] font-black rounded-lg border border-blue-200 uppercase">On Delivery</span>
                                @else
                                    <span class="px-3 py-1.5 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-lg border border-emerald-200 uppercase">Delivered</span>
                                @endif
                            </td>
                            <td class="p-6 text-sm font-medium text-slate-500">{{ $shipment->destination }}</td>
                            <td class="p-6 text-xs font-medium text-slate-400">{{ $shipment->created_at->format('d M Y') }}</td>
                            @if(in_array(Auth::user()->role, ['admin', 'staf']))
                            <td class="p-6 text-right space-x-3">
                                <a href="{{ route('shipments.edit', $shipment) }}" class="text-[10px] font-black text-indigo-400 hover:text-indigo-600 uppercase tracking-widest transition-colors">Edit</a>
                                <form action="{{ route('shipments.destroy', $shipment) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus pengiriman ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[10px] font-black text-red-400 hover:text-red-600 uppercase tracking-widest transition-colors">Hapus</button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-12 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center">
                                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-bold text-slate-400">Belum ada data pengiriman.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <p class="text-center text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] pt-2">
            Sistem SCM Logistik • Universitas Tadulako 2026
        </p>
    </div>
</x-app-layout>