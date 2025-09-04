<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asegúrate de que no exista un usuario con el mismo email
        if (!User::where('email', 'admin@suimacccardetailing.com')->exists()) {
            User::create([
                'name' => 'Victor Merino',
                'email' => 'admin@suimacccardetailing.com',
                'password' => Hash::make('contraseña123'),
                // Asumo que tu modelo User puede tener un campo 'role' o lo manejas con otra lógica (ej. Spatie Permissions)
                // 'role' => 'admin', 
            ]);
        }
    }
}