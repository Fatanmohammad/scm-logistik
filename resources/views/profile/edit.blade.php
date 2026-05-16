<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-slate-900 rounded-lg text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <h2 class="font-bold text-2xl text-slate-800 leading-tight">
                {{ __('Pengaturan Profil') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Informasi Profil -->
            <div class="p-6 sm:p-10 bg-white border border-slate-100 shadow-sm rounded-2xl transition hover:shadow-md">
                <div class="max-w-xl">
                    <h3 class="text-lg font-bold text-slate-900 mb-1">Informasi Akun</h3>
                    <p class="text-sm text-slate-500 mb-6">Perbarui nama dan alamat email akun Anda.</p>
                    
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="p-6 sm:p-10 bg-white border border-slate-100 shadow-sm rounded-2xl transition hover:shadow-md">
                <div class="max-w-xl">
                    <h3 class="text-lg font-bold text-slate-900 mb-1">Keamanan Kata Sandi</h3>
                    <p class="text-sm text-slate-500 mb-6">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.</p>
                    
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Hapus Akun -->
            <div class="p-6 sm:p-10 bg-white border border-red-50 shadow-sm rounded-2xl transition hover:shadow-md">
                <div class="max-w-xl">
                    <h3 class="text-lg font-bold text-red-600 mb-1">Hapus Akun</h3>
                    <p class="text-sm text-slate-500 mb-6">Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen.</p>
                    
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>