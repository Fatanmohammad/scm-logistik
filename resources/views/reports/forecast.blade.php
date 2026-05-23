<x-app-layout>
    <div class="space-y-8">

        <div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight uppercase">Prediksi <span class="text-indigo-600">Stok Habis</span></h1>
            <p class="text-xs text-slate-400 font-semibold mt-0.5 uppercase tracking-wider">Forecast berbasis Moving Average 7 hari — estimasi hari hingga stok habis per produk.</p>
        </div>

        <div class="custom-box overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-slate-100">
                        <th class="text-left px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-wider">Produk</th>
                        <th class="text-left px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-wider">Kategori</th>
                        <th class="text-center px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-wider">Stok Saat Ini</th>
                        <th class="text-center px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-wider">Rata-rata Keluar/Hari</th>
                        <th class="text-center px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-wider">Estimasi Habis</th>
                        <th class="text-center px-6 py-4 text-xs font-black text-slate-400 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach ($forecasts as $f)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 font-bold text-slate-800">{{ $f['product']->name }}</td>
                        <td class="px-6 py-4 text-slate-500">{{ $f['product']->category->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-center font-bold text-slate-700">{{ $f['product']->stock }}</td>
                        <td class="px-6 py-4 text-center text-slate-600">{{ $f['avg_per_day'] }}</td>
                        <td class="px-6 py-4 text-center font-bold
                            @if($f['status'] === 'kritis') text-red-600
                            @elseif($f['status'] === 'waspada') text-amber-600
                            @else text-slate-500 @endif">
                            {{ $f['days_left'] !== null ? $f['days_left'] . ' hari' : '—' }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($f['status'] === 'kritis')
                                <span class="px-3 py-1 bg-red-100 text-red-700 text-[10px] font-black rounded-full uppercase tracking-wider">Kritis</span>
                            @elseif($f['status'] === 'waspada')
                                <span class="px-3 py-1 bg-amber-100 text-amber-700 text-[10px] font-black rounded-full uppercase tracking-wider">Waspada</span>
                            @else
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-black rounded-full uppercase tracking-wider">Aman</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <p class="text-center text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] pt-6">
            Sistem SCM Logistik • Universitas Tadulako 2026
        </p>

    </div>
</x-app-layout>
