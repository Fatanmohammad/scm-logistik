<aside :class="sidebarOpen ? 'w-80' : 'w-24'" class="hidden md:flex flex-col bg-[#0f172a] h-screen sticky top-0 overflow-hidden transition-all duration-300 ease-in-out z-50 border-r border-slate-800/40">
    
    <div class="h-20 px-6 border-b border-slate-800/60 flex items-center gap-4 bg-[#090d16]">
        <div class="shrink-0 w-11 h-11 bg-indigo-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-indigo-500/30">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
        </div>
        <div x-show="sidebarOpen" class="flex flex-col transition-all duration-200">
            <span class="font-black text-lg text-white tracking-tight uppercase leading-none">SCM <span class="text-indigo-500">Logistik</span></span>
            <span class="text-[9px] font-bold text-slate-500 uppercase tracking-widest mt-1">Untad v1.0</span>
        </div>
    </div>

    <div class="flex-1 px-4 py-8 space-y-8 overflow-y-auto custom-scrollbar">
        
        <div>
            <p x-show="sidebarOpen" class="px-4 text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-4">Core Operation</p>
            <div class="space-y-1.5">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800/40 hover:text-slate-200' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"/></svg>
                    <span x-show="sidebarOpen" class="text-xs font-bold uppercase tracking-wider">Control Panel</span>
                </a>

                @if(in_array(Auth::user()->role, ['admin', 'staf']))
                <a href="{{ route('products.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ request()->routeIs('products.*') ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800/40 hover:text-slate-200' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    <span x-show="sidebarOpen" class="text-xs font-bold uppercase tracking-wider">Inventory & Warehouse</span>
                </a>
                @endif

                <a href="{{ route('shipments.index') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ request()->routeIs('shipments.*') ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800/40 hover:text-slate-200' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1m-4 0h4"/></svg>
                    <span x-show="sidebarOpen" class="text-xs font-bold uppercase tracking-wider">Logistics & Fleet</span>
                </a>
            </div>
        </div>

        @if(in_array(Auth::user()->role, ['admin', 'manager']))
        <div>
            <p x-show="sidebarOpen" class="px-4 text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-4">Executive & Strategy</p>
            <div class="space-y-1.5">
                <a href="{{ route('reports.stock') }}" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ request()->routeIs('reports.*') ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800/40 hover:text-slate-200' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.003 9.003 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
                    <span x-show="sidebarOpen" class="text-xs font-bold uppercase tracking-wider">Business Analytics</span>
                </a>
            </div>
        </div>
        @endif

        @if(Auth::user()->role === 'admin')
        <div>
            <p x-show="sidebarOpen" class="px-4 text-[10px] font-black text-slate-500 uppercase tracking-[0.25em] mb-4">System Authority</p>
            <div class="space-y-1.5">
                <a href="/admin/users" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 {{ request()->is('admin/users*') ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800/40 hover:text-slate-200' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span x-show="sidebarOpen" class="text-xs font-bold uppercase tracking-wider">Access Control</span>
                </a>
            </div>
        </div>
        @endif

    </div>

    <div class="p-6 border-t border-slate-800 bg-[#090d16]" x-show="sidebarOpen">
        <div class="flex items-center gap-3">
            <div class="w-2 h-2 bg-emerald-500 rounded-full animate-ping"></div>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Main Server Secure</p>
        </div>
    </div>
</aside>