<x-app-layout>
    <div class="min-h-screen bg-slate-50/50 py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-black text-slate-800 tracking-tight">Edit Produk</h2>
                    <p class="text-sm text-slate-500">Perbarui data inventaris produk di sistem SCM.</p>
                </div>
                <a href="{{ route('products.index') }}" class="text-sm font-semibold text-slate-400 hover:text-slate-600 transition">
                    ← Kembali
                </a>
            </div>

            <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/60 border border-white overflow-hidden">
                <form action="{{ route('products.update', $product) }}" method="POST" class="p-8 sm:p-12">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-10">
                        <section>
                            <div class="flex items-center gap-4 mb-6">
                                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-[10px] font-bold text-white">01</span>
                                <h3 class="font-bold text-slate-800 uppercase tracking-widest text-xs">Informasi Produk</h3>
                            </div>
                            
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2 ml-1">Nama Produk</label>
                                    <input type="text" name="name" value="{{ old('name', $product->name) }}" placeholder="Misal: Laptop Victus 15" 
                                        class="w-full px-5 py-4 rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:border-slate-900 focus:ring-0 transition-all placeholder:text-slate-300 shadow-sm" required>
                                    @error('name')<p class="text-red-500 text-xs mt-2 ml-1 font-semibold">{{ $message }}</p>@enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2 ml-1">SKU / Kode</label>
                                        <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" placeholder="LOG-PRD-001" 
                                            class="w-full px-5 py-4 rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:border-slate-900 focus:ring-0 transition-all placeholder:text-slate-300 shadow-sm" required>
                                        @error('sku')<p class="text-red-500 text-xs mt-2 ml-1 font-semibold">{{ $message }}</p>@enderror
                                    </div>
                                    <div>
                                        <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2 ml-1">Kategori</label>
                                        <select name="category_id" class="w-full px-5 py-4 rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:border-slate-900 focus:ring-0 transition-all shadow-sm">
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                                    {{ $cat->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')<p class="text-red-500 text-xs mt-2 ml-1 font-semibold">{{ $message }}</p>@enderror
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section>
                            <div class="flex items-center gap-4 mb-6">
                                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-[10px] font-bold text-white">02</span>
                                <h3 class="font-bold text-slate-800 uppercase tracking-widest text-xs">Harga & Stok</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2 ml-1">Harga Jual</label>
                                    <div class="relative">
                                        <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 font-bold text-sm">Rp</span>
                                        <input type="number" name="price" value="{{ old('price', $product->price) }}" placeholder="0" 
                                            class="w-full pl-14 pr-5 py-4 rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:border-slate-900 focus:ring-0 transition-all shadow-sm" required>
                                    </div>
                                    @error('price')<p class="text-red-500 text-xs mt-2 ml-1 font-semibold">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2 ml-1">Stok</label>
                                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" placeholder="0" 
                                        class="w-full px-5 py-4 rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:border-slate-900 focus:ring-0 transition-all shadow-sm" required>
                                    @error('stock')<p class="text-red-500 text-xs mt-2 ml-1 font-semibold">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </section>
                    </div>

                    <div class="mt-12">
                        <button type="submit" class="w-full py-5 bg-slate-900 text-white rounded-2xl font-bold text-sm hover:bg-black transition-all shadow-2xl shadow-slate-300 transform active:scale-[0.98]">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            <p class="mt-8 text-center text-xs text-slate-400 font-medium">
                Sistem SCM Logistik v1.0 • Universitas Tadulako
            </p>
        </div>
    </div>
</x-app-layout>
