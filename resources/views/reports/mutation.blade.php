<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <h2 class="text-xl font-bold text-slate-800 mb-6">Riwayat Mutasi Stok (Masuk/Keluar)</h2>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200">
                                <th class="p-4 text-xs font-bold uppercase text-slate-500">Tanggal</th>
                                <th class="p-4 text-xs font-bold uppercase text-slate-500">Produk</th>
                                <th class="p-4 text-xs font-bold uppercase text-slate-500">Tipe</th>
                                <th class="p-4 text-xs font-bold uppercase text-slate-500 text-center">Jumlah</th>
                                <th class="p-4 text-xs font-bold uppercase text-slate-500">Oleh</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($movements as $m)
                            <tr class="border-b border-slate-100">
                                <td class="p-4 text-sm text-slate-600">{{ $m->created_at->format('d/m/Y H:i') }}</td>
                                <td class="p-4 text-sm font-semibold text-slate-700">{{ $m->product->name }}</td>
                                <td class="p-4 text-sm">
                                    @if($m->type == 'in')
                                        <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">MASUK</span>
                                    @else
                                        <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold">KELUAR</span>
                                    @endif
                                </td>
                                <td class="p-4 text-sm text-center font-bold">{{ $m->quantity }}</td>
                                <td class="p-4 text-sm text-slate-500">{{ $m->user->name ?? 'System' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-slate-400 italic">Belum ada riwayat mutasi stok.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>