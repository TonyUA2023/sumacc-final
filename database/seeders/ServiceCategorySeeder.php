<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;
use Illuminate\Support\Str; // <-- Importante: Añadir el helper Str

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceCategory::create([
            'name' => 'Premium Detailing',
            'slug' => Str::slug('Premium Detailing'), // <-- AÑADIDO
            'description' => 'Servicios de detallado exhaustivo para restaurar y proteger su vehículo a un nivel superior.',
            'display_order' => 1,
        ]);

        ServiceCategory::create([
            'name' => 'Hand Super Wash',
            'slug' => Str::slug('Hand Super Wash'), // <-- AÑADIDO
            'description' => 'Lavados a mano de alta calidad para el mantenimiento regular de su vehículo.',
            'display_order' => 2,
        ]);
    }
}