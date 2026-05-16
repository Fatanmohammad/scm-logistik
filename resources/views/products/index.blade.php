<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-white tracking-tighter uppercase">
                    Warehouse <span class="text-indigo-500">Inventory</span>
                </h2>
                <p class="text-slate-500 text-sm font-medium">Kelola stok dan ketersediaan barang.</p>
            </div>
            <a href="{{ route('products.create') }}" class="px-8 py-4 bg-indigo-600 hover:bg-indigo-500 text-white text-[10px] font-black rounded-2xl transition-all shadow-xl shadow-indigo-500/20 tracking-widest uppercase">
                + Add Product
            </a>
        </div>
    </x-slot>

    <div class="bg-[#1e293b]/30 backdrop-blur-md rounded-[2.5rem] border border-white/5 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-white/5 bg-white/[0.02]">
                        <th class="p-8 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">Product Name</th>
                        <th class="p-8 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">SKU Code</th>
                        <th class="p-8 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">Category</th>
                        <th class="p-8 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em]">Current Stock</th>
                        <th class="p-8 text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    {{-- Loop data di sini --}}
                    <tr class="hover:bg-white/[0.03] transition-colors group">
                        <td class="p-8">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-slate-800 flex items-center justify-center text-slate-500 font-bold border border-white/5">P</div>
                                <span class="text-sm font-bold text-slate-200 group-hover:text-white transition-colors">Sample Product</span>
                            </div>
                        </td>
                        <td class="p-8">
                            <span class="px-3 py-1.5 bg-slate-800 text-slate-400 text-[10px] font-black rounded-lg border border-white/10 uppercase">LOG-001</span>
                        </td>
                        <td class="p-8 text-sm font-medium text-slate-400">Elektronik</td>
                        <td class="p-8">
                            <div class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 rounded-full bg-emerald-500"></div>
                                <span class="text-sm font-bold text-slate-200">45 Unit</span>
                            </div>
                        </td>
                        <td class="p-8 text-right space-x-2">
                            <button class="text-[10px] font-black text-indigo-400 hover:text-indigo-300 uppercase tracking-widest transition-colors">Edit</button>
                            <button class="text-[10px] font-black text-red-500/50 hover:text-red-500 uppercase tracking-widest transition-colors">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>