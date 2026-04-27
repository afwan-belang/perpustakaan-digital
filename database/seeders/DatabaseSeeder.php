<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category; 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. BUAT AKUN ADMIN
        User::create([
            'name' => 'Admin Perpustakaan',
            'email' => 'admin@smk.com',
            'password' => Hash::make('password'), // Passwordnya: password
            'role' => 'admin', // Kuncinya di sini!
        ]);

        // 2. BUAT AKUN USER BIASA (SISWA)
        User::create([
            'name' => 'Siswa Teladan',
            'email' => 'siswa@smk.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // 3. BUAT KATEGORI DEFAULT (Agar tidak kosong saat di-reset)
        $categories = ['Pemrograman', 'Sains', 'Sejarah', 'Ekonomi', 'Bahasa','Filsafat'];
        foreach ($categories as $cat) {
            Category::create(['name' => $cat]);
        }
    }
}