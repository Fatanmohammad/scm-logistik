<x-app-layout>
    <div class="min-h-screen bg-slate-50/50 py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-black text-slate-800 tracking-tight">Tambah Pengiriman</h2>
                    <p class="text-sm text-slate-500">Buat data pengiriman baru ke sistem SCM.</p>
                </div>
                <a href="{{ route('shipments.index') }}" class="text-sm font-semibold text-slate-400 hover:text-slate-600 transition">
                    Kembali
                </a>
            </div>

            <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/60 border border-white overflow-hidden">
                <form action="{{ route('shipments.store') }}" method="POST" class="p-8 sm:p-12">
                    @csrf
                    
                    <div class="space-y-10">
                        <section>
                            <div class="flex items-center gap-4 mb-6">
                                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-[10px] font-bold text-white">01</span>
                                <h3 class="font-bold text-slate-800 uppercase tracking-widest text-xs">Informasi Pengiriman</h3>
                            </div>
                            
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2 ml-1">No Resi / Tracking Code</label>
                                    <input type="text" name="tracking_code" value="{{ old('tracking_code') }}" placeholder="Misal: SCM-SHP-001" 
                                        class="w-full px-5 py-4 rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:border-slate-900 focus:ring-0 transition-all placeholder:text-slate-300 shadow-sm" required>
                                    @error('tracking_code')
                                        <p class="text-red-500 text-xs mt-2 ml-1 font-semibold">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2 ml-1">Tujuan Pengiriman</label>
                                    <textarea name="destination" rows="3" placeholder="Alamat tujuan pengiriman lengkap..." 
                                        class="w-full px-5 py-4 rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:border-slate-900 focus:ring-0 transition-all placeholder:text-slate-300 shadow-sm resize-none" required>{{ old('destination') }}</textarea>
                                    @error('destination')
                                        <p class="text-red-500 text-xs mt-2 ml-1 font-semibold">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </section>

                        <section>
                            <div class="flex items-center gap-4 mb-6">
                                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-[10px] font-bold text-white">02</span>
                                <h3 class="font-bold text-slate-800 uppercase tracking-widest text-xs">Kurir & Status</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2 ml-1">
                                        Produk / Barang
                                    </label>
                                    <select name="product_id" class="w-full px-5 py-4 rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:border-slate-900 focus:ring-0 transition-all shadow-sm" required>
                                        <option value="">-- Pilih Produk --</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                                {{ $product->name }} (SKU: {{ $product->sku }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('product_id')
                                        <p class="text-red-500 text-xs mt-2 ml-1 font-semibold">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2 ml-1">
                                        Kurir <span class="text-emerald-500">(Staff)</span>
                                    </label>
                                    <select name="user_id" class="w-full px-5 py-4 rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:border-slate-900 focus:ring-0 transition-all shadow-sm" required>
                                        <option value="">-- Pilih Kurir --</option>
                                        @foreach($kurirs as $kurir)
                                            <option value="{{ $kurir->id }}" {{ old('user_id') == $kurir->id ? 'selected' : '' }}>
                                                {{ $kurir->name }} (Kurir)
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <p class="text-red-500 text-xs mt-2 ml-1 font-semibold">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-black text-slate-400 uppercase tracking-wider mb-2 ml-1">Status</label>
                                    <select name="status" class="w-full px-5 py-4 rounded-2xl border-slate-100 bg-slate-50 focus:bg-white focus:border-slate-900 focus:ring-0 transition-all shadow-sm" required>
                                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="on_delivery" {{ old('status') == 'on_delivery' ? 'selected' : '' }}>On Delivery</option>
                                        <option value="delivered" {{ old('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    </select>
                                    @error('status')
                                        <p class="text-red-500 text-xs mt-2 ml-1 font-semibold">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </section>
                    </div>

                    <div class="mt-12">
                        <button type="submit" class="w-full py-5 bg-slate-900 text-white rounded-2xl font-bold text-sm hover:bg-black transition-all shadow-2xl shadow-slate-300 transform active:scale-[0.98]">
                            Simpan Pengiriman
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
