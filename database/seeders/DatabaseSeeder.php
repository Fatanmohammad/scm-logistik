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

        echo "\nSeeding berhasil! Akun login: admin@gmail.com | password: password123\n";
    }
}