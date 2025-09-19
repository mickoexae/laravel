<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Jalankan database seeds.
     */
    public function run(): void
    {
        // Admin Project
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // cek email
            [
                'name' => 'Admin Project',
                'password' => Hash::make('password'), // default password
                'role' => 'admin',
            ]
        );

        // Anggota Tim
        User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Anggota Tim',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );
    }
}
