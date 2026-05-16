<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Stat: Total Produk -->
                <div class="bg-white overflow-hidden shadow-sm rounded-2xl p-6 border border-slate-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500">Total Produk</p>
                            <h3 class="text-2xl font-bold text-slate-900">{{ \App\Models\Product::count() }}</h3>
                        </div>
                        <div class="p-3 bg-blue-50 rounded-xl text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Stat: Stok Alert -->
                <div class="bg-white overflow-hidden shadow-sm rounded-2xl p-6 border border-slate-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500">Stok Menipis</p>
                            <h3 class="text-2xl font-bold text-red-600">{{ \App\Models\Product::where('stock', '<', 10)->count() }}</h3>
                        </div>
                        <div class="p-3 bg-red-50 rounded-xl text-red-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.268 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Stat: Pengiriman -->
                <div class="bg-white overflow-hidden shadow-sm rounded-2xl p-6 border border-slate-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-slate-500">Pengiriman Aktif</p>
                            <h3 class="text-2xl font-bold text-amber-600">{{ \App\Models\Shipment::where('status', 'on_delivery')->count() }}</h3>
                        </div>
                        <div class="p-3 bg-amber-50 rounded-xl text-amber-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Aktivitas Terbaru -->
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                    <h3 class="text-lg font-bold text-slate-900 mb-4">Aktivitas Terbaru</h3>
                    <div class="space-y-4">
                        @forelse(\App\Models\StockMovement::with('product')->latest()->take(5)->get() as $move)
                            <div class="flex items-center gap-4 p-3 rounded-xl bg-slate-50">
                                <div class="w-2 h-2 rounded-full {{ $move->type == 'in' ? 'bg-green-500' : 'bg-red-500' }}"></div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-slate-800">{{ $move->product->name }} ({{ strtoupper($move->type) }})</p>
                                    <p class="text-xs text-slate-500">{{ $move->created_at->diffForHumans() }} · Qty: {{ $move->quantity }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-slate-500">Belum ada aktivitas stok.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Akses Cepat (Ini yang bikin tombol bisa dipencet) -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                    <h3 class="text-lg font-bold text-slate-900 mb-4">Akses Cepat</h3>
                    <div class="grid gap-3">
                        @if(in_array(Auth::user()->role, ['admin','staf']))
                        <a href="{{ route('products.index') }}" class="flex items-center justify-between p-4 rounded-xl border border-slate-100 hover:bg-slate-50 hover:border-slate-300 transition group">
                            <span class="text-sm font-semibold text-slate-700">Kelola Produk</span>
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                        @endif

                        <a href="{{ route('shipments.index') }}" class="flex items-center justify-between p-4 rounded-xl border border-slate-100 hover:bg-slate-50 hover:border-slate-300 transition group">
                            <span class="text-sm font-semibold text-slate-700">Pengiriman</span>
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>

                        @if(in_array(Auth::user()->role, ['admin','manager']))
                        <a href="{{ route('reports.stock') }}" class="flex items-center justify-between p-4 rounded-xl border border-slate-100 hover:bg-slate-50 hover:border-slate-300 transition group">
                            <span class="text-sm font-semibold text-slate-700">Laporan Stok</span>
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>