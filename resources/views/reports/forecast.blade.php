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

        {{-- Section AI Groq --}}
        <div class="custom-box p-6 space-y-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-violet-50 text-violet-600 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m1.636-6.364l.707.707M12 21v-1M6.343 17.657l-.707.707M17.657 6.343l-.707.707M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <h4 class="font-extrabold text-slate-800 text-sm">Analisis AI (Groq)</h4>
                    <p class="text-xs text-slate-400 mt-0.5">Rekomendasi tindakan otomatis berdasarkan data forecast di atas.</p>
                </div>
            </div>

            @if(session('ai_result'))
                <div class="bg-violet-50 border border-violet-100 rounded-xl p-4 text-sm text-slate-700 leading-relaxed whitespace-pre-line">
                    {{ session('ai_result') }}
                </div>
            @endif

            @if(session('ai_error'))
                <div class="bg-red-50 border border-red-100 rounded-xl p-4 text-sm text-red-600">
                    {{ session('ai_error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('reports.forecast.analyze') }}">
                @csrf
                <button type="submit" class="w-full py-2.5 bg-violet-600 hover:bg-violet-700 text-white text-[10px] font-black rounded-lg uppercase tracking-wider transition-colors shadow-sm">
                    ✦ Analisis dengan AI
                </button>
            </form>
        </div>

        <p class="text-center text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] pt-6">
            Sistem SCM Logistik • Universitas Tadulako 2026
        </p>

    </div>
</x-app-layout>
