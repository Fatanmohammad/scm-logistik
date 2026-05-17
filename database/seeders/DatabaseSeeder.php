<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Kita buat User secara manual (tanpa factory) agar tidak mencari kolom 'email_verified_at'
        User::create([
            'name' => 'Fatan Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Tambahkan juga data kategori agar tabel products tidak error saat testing
        Category::create(['name' => 'Elektronik']);
        Category::create(['name' => 'Logistik Umum']);

        // 2. TAMBAHKAN USER ROLE LAINNYA:

        // Kurir (untuk petugas pengiriman)
        User::create([
            'name' => 'Budi',
            'email' => 'staf@scm.com',
            'password' => Hash::make('password123'),
            'role' => 'staf', // Sesuai skema Anda, kurir adalah role 'staf'
        ]);

        // Manajer Operasional
        User::create([
            'name' => 'Kavri',
            'email' => 'manager@scm.com',
            'password' => Hash::make('password123'),
            'role' => 'manager', // Role manager untuk approval
        ]);

        echo "\nSeeding berhasil! Akun admin, staf, dan manajer sudah dibuat.\n";
        echo "\nLogin dengan detail berikut:\n";
        echo "Email: admin@gmail.com | Password: password123 (Role: Admin)\n";
        echo "Email: staf@scm.com | Password: password123 (Role: Staf)\n";
        echo "Email: manager@scm.com | Password: password123 (Role: Manager)\n";
    }
}