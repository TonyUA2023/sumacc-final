<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    // En database/seeders/UserSeeder.php
public function run(): void
{
    if (!User::where('email', 'admin@sumacccardetailing.com')->exists()) {
        User::create([
            'name' => 'Victor Merino',
            'email' => 'admin@sumacccardetailing.com',
            'password' => Hash::make('contraseña123'),
            'role' => 'Admin', // ← Asegúrate de incluir esto
            'is_active' => true,
        ]);
    }
    
    // Opcional: crear algún usuario regular para testing
    if (!User::where('email', 'user@example.com')->exists()) {
        User::create([
            'name' => 'Usuario Regular',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'role' => 'Staff',
            'is_active' => true,
        ]);
    }
}
}