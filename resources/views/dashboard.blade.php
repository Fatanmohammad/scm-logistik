<x-app-layout>
    <div class="space-y-8">
        
        <div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight uppercase">Dashboard <span class="text-indigo-600">Overview</span></h1>
            <p class="text-xs text-slate-400 font-semibold mt-0.5 uppercase tracking-wider">Selamat datang kembali di pusat kendali, {{ Auth::user()->name }}.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <div class="custom-box p-6 flex flex-col justify-between gap-4">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-extrabold text-slate-800 text-sm">Stok Barang (Product)</h4>
                        <p class="text-xs text-slate-400 mt-1 leading-relaxed">Kelola jumlah ketersediaan inventaris unit, kode SKU, serta manipulasi kategori.</p>
                    </div>
                </div>
                <div class="flex items-center gap-2 pt-2 border-t border-slate-50">
                    <a href="{{ route('products.index') }}" class="flex-1 py-2 bg-slate-50 hover:bg-slate-100 text-slate-600 text-[10px] font-black text-center rounded-lg uppercase tracking-wider transition-colors">Buka Data</a>
                    <a href="{{ route('products.create') }}" class="flex-1 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-[10px] font-black text-center rounded-lg uppercase tracking-wider transition-all shadow-sm">+ Tambah</a>
                </div>
            </div>

            <div class="custom-box p-6 flex flex-col justify-between gap-4">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 00()1 1h1m-4 0h4"/></svg>
                    </div>
                    <div>
                        <h4 class="font-extrabold text-slate-800 text-sm">Logistik (Shipment)</h4>
                        <p class="text-xs text-slate-400 mt-1 leading-relaxed">Pantau jalannya status ekspedisi pengiriman barang dan tracking kurir logistik.</p>
                    </div>
                </div>
                <div class="flex items-center gap-2 pt-2 border-t border-slate-50">
                    <a href="{{ route('shipments.index') }}" class="flex-1 py-2 bg-slate-50 hover:bg-slate-100 text-slate-600 text-[10px] font-black text-center rounded-lg uppercase tracking-wider transition-colors">Buka Data</a>
                    <a href="{{ route('shipments.create') }}" class="flex-1 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-[10px] font-black text-center rounded-lg uppercase tracking-wider transition-all shadow-sm">+ Tambah</a>
                </div>
            </div>

            @if(in_array(Auth::user()->role, ['admin', 'manager']))
            <div class="custom-box p-6 flex flex-col justify-between gap-4">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <div>
                        <h4 class="font-extrabold text-slate-800 text-sm">Analisis Laporan (Report)</h4>
                        <p class="text-xs text-slate-400 mt-1 leading-relaxed">Rekapitulasi mutasi keluar masuk barang gudang serta cetak laporan berkas SCM.</p>
                    </div>
                </div>
                <div class="pt-2 border-t border-slate-50">
                    <a href="{{ route('reports.stock') }}" class="block w-full py-2 bg-amber-500 hover:bg-amber-600 text-white text-[10px] font-black text-center rounded-lg uppercase tracking-wider transition-colors shadow-sm">Buka Rekapitulasi Laporan</a>
                </div>
            </div>
            @endif

            @if(Auth::user()->role === 'admin')
            <div class="custom-box p-6 flex flex-col justify-between gap-4">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-extrabold text-slate-800 text-sm">Hak Akses Kontrol (User)</h4>
                        <p class="text-xs text-slate-400 mt-1 leading-relaxed">Konfigurasi akun kredensial user untuk jabatan tingkat staf, kurir, ataupun manager.</p>
                    </div>
                </div>
                <div class="flex items-center gap-2 pt-2 border-t border-slate-50">
                    <a href="/admin/users" class="flex-1 py-2 bg-slate-50 hover:bg-slate-100 text-slate-600 text-[10px] font-black text-center rounded-lg uppercase tracking-wider transition-colors">Kelola User</a>
                </div>
            </div>
            @endif

        </div>

        <p class="text-center text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] pt-6">
            Sistem SCM Logistik • Universitas Tadulako 2026
        </p>

    </div>
</x-app-layout>