<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SCM Logistik Untad</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .sidebar-dark { background-color: #1e2530; }
        .sidebar-item-active { background-color: #11161e; border-left: 4px solid #4f46e5; text-color: #ffffff; }
        .custom-box {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.01);
            transition: all 0.2s ease;
        }
        .custom-box:hover { border-color: #cbd5e1; transform: translateY(-1px); }
    </style>
</head>
<body class="antialiased text-slate-800">
    <div class="flex h-screen overflow-hidden">
        
        <aside class="w-64 sidebar-dark flex flex-col h-full shrink-0 shadow-xl z-20">
            <div class="h-20 px-6 flex items-center gap-3 border-b border-slate-700/50 bg-[#161b24]">
                <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-black text-sm shadow-md">
                    S
                </div>
                <div class="flex flex-col">
                    <span class="font-black text-sm text-white tracking-wider uppercase leading-none">SCM Logistik</span>
                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-1">Untad v1.0</span>
                </div>
            </div>

            <div class="flex-1 py-6 flex flex-col justify-between">
                <nav class="space-y-1 px-3">
                    <a href="{{ route('dashboard') }}" class="flex items-center justify-between px-4 py-3.5 text-xs font-bold uppercase tracking-wider rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'sidebar-item-active text-white' : 'text-slate-400 hover:bg-slate-700/30 hover:text-white' }}">
                        <span>Dashboard Hub</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>

                    <a href="{{ route('products.index') }}" class="flex items-center justify-between px-4 py-3.5 text-xs font-bold uppercase tracking-wider rounded-lg transition-colors {{ request()->routeIs('products.*') ? 'sidebar-item-active text-white' : 'text-slate-400 hover:bg-slate-700/30 hover:text-white' }}">
                        <span>Stok Barang (Product)</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>

                    <a href="{{ route('shipments.index') }}" class="flex items-center justify-between px-4 py-3.5 text-xs font-bold uppercase tracking-wider rounded-lg transition-colors {{ request()->routeIs('shipments.*') ? 'sidebar-item-active text-white' : 'text-slate-400 hover:bg-slate-700/30 hover:text-white' }}">
                        <span>Logistik (Shipment)</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>

                    @if(in_array(Auth::user()->role, ['admin', 'manager']))
                    <a href="{{ route('reports.stock') }}" class="flex items-center justify-between px-4 py-3.5 text-xs font-bold uppercase tracking-wider rounded-lg transition-colors {{ request()->routeIs('reports.*') ? 'sidebar-item-active text-white' : 'text-slate-400 hover:bg-slate-700/30 hover:text-white' }}">
                        <span>Analisis Laporan (Report)</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    @endif

                    @if(Auth::user()->role === 'admin')
                    <a href="/admin/users" class="flex items-center justify-between px-4 py-3.5 text-xs font-bold uppercase tracking-wider rounded-lg transition-colors {{ request()->is('admin/users*') ? 'sidebar-item-active text-white' : 'text-slate-400 hover:bg-slate-700/30 hover:text-white' }}">
                        <span>Hak Akses (User)</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    @endif
                </nav>

                <div class="px-6 border-t border-slate-700/50 pt-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full py-2.5 bg-red-600/10 hover:bg-red-600 text-red-400 hover:text-white text-xs font-bold rounded-lg uppercase tracking-wider transition-all text-center">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col h-full overflow-y-auto">
            
            <header class="h-20 bg-white border-b border-slate-100 px-8 flex items-center justify-between shrink-0">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Sistem Server Amankan</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="text-right">
                        <p class="text-xs font-black text-slate-800 uppercase leading-none">{{ Auth::user()->name }}</p>
                        <p class="text-[9px] font-bold text-indigo-500 uppercase tracking-widest mt-1">Role: {{ Auth::user()->role }}</p>
                    </div>
                </div>
            </header>

            <main class="p-8 md:p-10 flex-1 bg-slate-50/50">
                <div class="max-w-5xl mx-auto">
                    {{ $slot }}
                </div>
            </main>
        </div>

    </div>
</body>
</html>