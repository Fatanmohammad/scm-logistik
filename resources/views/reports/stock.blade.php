<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-slate-800">Laporan Inventaris Stok</h2>
                    <button onclick="window.print()" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-bold hover:bg-blue-700">
                        Cetak Laporan
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200">
                                <th class="p-4 text-xs font-bold uppercase text-slate-500">Nama Produk</th>
                                <th class="p-4 text-xs font-bold uppercase text-slate-500">Kategori</th>
                                <th class="p-4 text-xs font-bold uppercase text-slate-500 text-center">Sisa Stok</th>
                                <th class="p-4 text-xs font-bold uppercase text-slate-500 text-right">Nilai Aset</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $p)
                            <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
                                <td class="p-4 text-sm text-slate-700">{{ $p->name }}</td>
                                <td class="p-4 text-sm text-slate-500">{{ $p->category->name ?? 'Tanpa Kategori' }}</td>
                                <td class="p-4 text-sm text-center font-bold {{ $p->stock < 10 ? 'text-red-600' : 'text-slate-700' }}">
                                    {{ $p->stock }}
                                </td>
                                <td class="p-4 text-sm text-right font-mono">
                                    Rp {{ number_format($p->price * $p->stock, 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-8 text-center text-slate-400 italic">Data produk tidak ditemukan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>