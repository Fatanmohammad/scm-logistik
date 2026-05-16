@php $user = Auth::user(); $role = $user?->role; @endphp
<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-lg sticky top-0 z-50 border-b border-slate-100">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center gap-10">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 btn-indigo rounded-2xl flex items-center justify-center text-white shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <span class="font-black text-xl tracking-tighter text-slate-800">SCM<span class="text-indigo-600">UNTAD</span></span>
                </a>

                <div class="hidden md:flex items-center gap-2">
                    @foreach(['Dashboard' => 'dashboard', 'Inventory' => 'products.index', 'Shipments' => 'shipments.index'] as $label => $route)
                        <a href="{{ route($route) }}" class="px-4 py-2 text-xs font-bold uppercase tracking-widest {{ request()->routeIs($route) ? 'text-indigo-600 bg-indigo-50' : 'text-slate-500 hover:text-slate-900' }} rounded-xl transition-all">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center" x-data="{ profOpen: false }">
                <button @click="profOpen = !profOpen" @click.outside="profOpen = false" class="flex items-center gap-3 p-1.5 pr-4 rounded-full border border-slate-100 hover:bg-slate-50 transition">
                    <div class="w-8 h-8 rounded-full bg-slate-900 flex items-center justify-center text-[10px] font-black text-white uppercase">{{ substr($user->name, 0, 2) }}</div>
                    <span class="text-xs font-bold text-slate-700">{{ $user->name }}</span>
                </button>

                <div x-show="profOpen" style="display:none" class="absolute right-0 top-16 w-48 bg-white premium-card shadow-2xl py-2 z-50 overflow-hidden">
                    <a href="{{ route('profile.edit') }}" class="block px-6 py-3 text-xs font-bold text-slate-600 hover:bg-slate-50 uppercase tracking-widest">Profile</a>
                    <div class="border-t border-slate-50"></div>
                    <form method="POST" action="{{ route('logout') }}"> @csrf
                        <button type="submit" class="w-full text-left px-6 py-3 text-xs font-bold text-red-500 hover:bg-red-50 uppercase tracking-widest">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>