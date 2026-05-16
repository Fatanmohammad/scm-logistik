<x-app-layout>
    <div class="space-y-8">

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight uppercase">
                    Warehouse <span class="text-indigo-600">Inventory</span>
                </h2>
                <p class="text-xs text-slate-400 font-semibold mt-0.5 uppercase tracking-wider">Kelola stok dan ketersediaan barang.</p>
            </div>
            <a href="{{ route('products.create') }}" class="px-8 py-4 bg-indigo-600 hover:bg-indigo-500 text-white text-[10px] font-black rounded-2xl transition-all shadow-xl shadow-indigo-500/20 tracking-widest uppercase">
                + Add Product
            </a>
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
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Product Name</th>
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">SKU Code</th>
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Category</th>
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Harga</th>
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Current Stock</th>
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($products as $product)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="p-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 font-black text-sm border border-indigo-100">
                                        {{ strtoupper(substr($product->name, 0, 1)) }}
                                    </div>
                                    <span class="text-sm font-bold text-slate-700 group-hover:text-slate-900 transition-colors">{{ $product->name }}</span>
                                </div>
                            </td>
                            <td class="p-6">
                                <span class="px-3 py-1.5 bg-slate-100 text-slate-500 text-[10px] font-black rounded-lg border border-slate-200 uppercase">{{ $product->sku }}</span>
                            </td>
                            <td class="p-6 text-sm font-medium text-slate-500">{{ $product->category->name ?? '-' }}</td>
                            <td class="p-6 text-sm font-bold text-slate-600">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="p-6">
                                <div class="flex items-center gap-2">
                                    <div class="w-1.5 h-1.5 rounded-full {{ $product->stock > 10 ? 'bg-emerald-500' : ($product->stock > 0 ? 'bg-amber-400' : 'bg-red-500') }}"></div>
                                    <span class="text-sm font-bold text-slate-700">{{ $product->stock }} Unit</span>
                                </div>
                            </td>
                            <td class="p-6 text-right space-x-3">
                                <a href="{{ route('products.edit', $product) }}" class="text-[10px] font-black text-indigo-400 hover:text-indigo-600 uppercase tracking-widest transition-colors">Edit</a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-[10px] font-black text-red-400 hover:text-red-600 uppercase tracking-widest transition-colors">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-12 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center">
                                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-bold text-slate-400">Belum ada data produk.</p>
                                    <a href="{{ route('products.create') }}" class="text-xs font-black text-indigo-500 hover:text-indigo-700 uppercase tracking-wider transition-colors">+ Tambah Produk Pertama</a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Update Stok Form (Modal sederhana inline) --}}
        @foreach($products as $product)
        <div id="modal-stock-{{ $product->id }}" class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm z-50 flex items-center justify-center">
            <div class="bg-white rounded-[2rem] shadow-2xl p-8 w-full max-w-md mx-4">
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest mb-1">Update Stok</h3>
                <p class="text-xs text-slate-400 mb-6">Produk: <strong>{{ $product->name }}</strong> — Stok saat ini: <strong>{{ $product->stock }}</strong></p>

                <form action="{{ route('stock.update', $product) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2">Jumlah</label>
                        <input type="number" name="quantity" min="1" placeholder="0"
                            class="w-full px-5 py-4 rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:border-slate-900 focus:ring-0 transition-all shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2">Tipe Mutasi</label>
                        <select name="type" class="w-full px-5 py-4 rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:border-slate-900 focus:ring-0 transition-all shadow-sm">
                            <option value="in">Stok Masuk (In)</option>
                            <option value="out">Stok Keluar (Out)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2">Catatan (Opsional)</label>
                        <input type="text" name="note" placeholder="Contoh: Restock dari supplier..."
                            class="w-full px-5 py-4 rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:border-slate-900 focus:ring-0 transition-all shadow-sm">
                    </div>
                    <div class="flex gap-3 pt-2">
                        <button type="button" onclick="closeModal('modal-stock-{{ $product->id }}')" class="flex-1 py-4 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-2xl font-bold text-sm transition-all">Batal</button>
                        <button type="submit" class="flex-1 py-4 bg-slate-900 hover:bg-black text-white rounded-2xl font-bold text-sm transition-all shadow-lg">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        @endforeach

        <p class="text-center text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] pt-2">
            Sistem SCM Logistik • Universitas Tadulako 2026
        </p>
    </div>

    <script>
        function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
        function closeModal(id) { document.getElementById(id).classList.add('hidden'); }
    </script>
</x-app-layout>