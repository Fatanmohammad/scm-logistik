<x-app-layout>
    <div class="py-10" x-data="{ activeTab: 'none' }">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Profil Card Utama -->
            <div class="bg-white border border-slate-100 shadow-sm rounded-3xl overflow-hidden mb-8">
                <!-- Cover Background -->
                <div class="h-32 bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-600"></div>
                
                <!-- Info Area -->
                <div class="px-8 pb-8 flex flex-col sm:flex-row gap-6 items-center sm:items-end -mt-12 sm:-mt-16">
                    <!-- Foto Profil (Inisial) -->
                    <div class="w-24 h-24 sm:w-32 sm:h-32 rounded-full bg-white p-1.5 shadow-xl shrink-0">
                        <div class="w-full h-full rounded-full bg-slate-900 flex items-center justify-center text-4xl sm:text-5xl font-black text-white uppercase">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                    </div>
                    
                    <!-- Detail User -->
                    <div class="text-center sm:text-left flex-1 mb-2">
                        <h1 class="text-2xl sm:text-3xl font-black text-slate-800 tracking-tight">{{ $user->name }}</h1>
                        <p class="text-slate-500 font-medium">{{ $user->email }}</p>
                    </div>
                    
                    <!-- Role Badge -->
                    <div class="mb-2">
                        <span class="px-4 py-1.5 rounded-full text-xs font-black tracking-widest uppercase bg-indigo-50 text-indigo-600 border border-indigo-100">
                            Role: {{ $user->role }}
                        </span>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="px-8 pb-6 pt-5 border-t border-slate-100 flex flex-wrap justify-center sm:justify-start gap-3 bg-slate-50/50">
                    <button @click="activeTab = activeTab === 'profile' ? 'none' : 'profile'" :class="activeTab === 'profile' ? 'bg-indigo-600 text-white shadow-md border-transparent' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200'" class="px-5 py-2.5 border rounded-xl font-bold text-sm transition-all duration-200 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        Edit Informasi Akun
                    </button>
                    <button @click="activeTab = activeTab === 'password' ? 'none' : 'password'" :class="activeTab === 'password' ? 'bg-indigo-600 text-white shadow-md border-transparent' : 'bg-white text-slate-700 hover:bg-slate-100 border-slate-200'" class="px-5 py-2.5 border rounded-xl font-bold text-sm transition-all duration-200 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        Ganti Password
                    </button>
                    <button @click="activeTab = activeTab === 'delete' ? 'none' : 'delete'" :class="activeTab === 'delete' ? 'bg-red-600 text-white shadow-md border-transparent' : 'bg-white text-red-600 hover:bg-red-50 border-red-200'" class="px-5 py-2.5 border rounded-xl font-bold text-sm transition-all duration-200 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Hapus Akun
                    </button>
                </div>
            </div>

            <!-- Tab Content: Informasi Profil -->
            <div x-show="activeTab === 'profile'" x-collapse x-cloak>
                <div class="p-6 sm:p-10 bg-white border border-slate-100 shadow-sm rounded-2xl mb-8">
                    <div class="max-w-xl">
                        <h3 class="text-lg font-bold text-slate-900 mb-1">Informasi Akun</h3>
                        <p class="text-sm text-slate-500 mb-6">Perbarui nama dan alamat email akun Anda.</p>
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <!-- Tab Content: Update Password -->
            <div x-show="activeTab === 'password'" x-collapse x-cloak>
                <div class="p-6 sm:p-10 bg-white border border-slate-100 shadow-sm rounded-2xl mb-8">
                    <div class="max-w-xl">
                        <h3 class="text-lg font-bold text-slate-900 mb-1">Keamanan Kata Sandi</h3>
                        <p class="text-sm text-slate-500 mb-6">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.</p>
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <!-- Tab Content: Hapus Akun -->
            <div x-show="activeTab === 'delete'" x-collapse x-cloak>
                <div class="p-6 sm:p-10 bg-white border border-red-50 shadow-sm rounded-2xl mb-8">
                    <div class="max-w-xl">
                        <h3 class="text-lg font-bold text-red-600 mb-1">Hapus Akun</h3>
                        <p class="text-sm text-slate-500 mb-6">Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen.</p>
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>