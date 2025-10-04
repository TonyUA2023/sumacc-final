<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ExtraService;
use Illuminate\Support\Facades\DB; // <-- Importante: Importa la fachada DB

class ExtraServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Desactiva la revisión de llaves foráneas para permitir el truncate
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 2. Limpia la tabla para evitar duplicados en futuras ejecuciones
        ExtraService::truncate();

        // 3. Reactiva la revisión de llaves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Array con todos los servicios extra a crear
        $extraServices = [
            // --- Servicios de tu imagen ---
            [
                'name' => 'Aquapel Glass Treatment',
                'description' => 'Improves visibility in the rain, causing water to bead and roll off. Lasts for months.',
                'price' => 30.00,
                'estimated_duration_minutes' => 20,
                'is_active' => true,
            ],
            [
                'name' => 'Leather Treatment',
                'description' => 'Cleans and conditions leather seats to prevent cracking and restore natural softness.',
                'price' => 30.00,
                'estimated_duration_minutes' => 30,
                'is_active' => true,
            ],
            [
                'name' => 'Engine Dress',
                'description' => 'Safely cleans the engine bay and applies a non-greasy dressing for a like-new look.',
                'price' => 25.00,
                'estimated_duration_minutes' => 30,
                'is_active' => true,
            ],
            [
                'name' => 'Spray Wax',
                'description' => 'Adds a quick layer of protection and enhances gloss for a brilliant shine.',
                'price' => 15.00,
                'estimated_duration_minutes' => 15,
                'is_active' => true,
            ],
            [
                'name' => 'Tree Sap Removal',
                'description' => 'Safely removes stubborn tree sap and tar spots from the paint surface.',
                'price' => 30.00,
                'estimated_duration_minutes' => 30,
                'is_active' => true,
            ],
            [
                'name' => 'Pet Hair Removal',
                'description' => 'Thorough removal of embedded pet hair from carpets, upholstery, and mats.',
                'price' => 30.00,
                'estimated_duration_minutes' => 45,
                'is_active' => true,
            ],

            // --- Servicios adicionales recomendados ---
            [
                'name' => 'Headlight Restoration',
                'description' => 'Restores clarity to foggy or yellowed headlights, improving night-time visibility.',
                'price' => 50.00,
                'estimated_duration_minutes' => 45,
                'is_active' => true,
            ],
            [
                'name' => 'Ozone Treatment (Odor Removal)',
                'description' => 'Eliminates persistent odors like smoke, mildew, and pet smells from the vehicle interior.',
                'price' => 45.00,
                'estimated_duration_minutes' => 60,
                'is_active' => true,
            ],
            [
                'name' => 'Fabric Protection',
                'description' => 'Applies a protective coating to fabric seats and carpets to repel spills and prevent stains.',
                'price' => 40.00,
                'estimated_duration_minutes' => 30,
                'is_active' => true,
            ],
            [
                'name' => 'Carpet & Upholstery Shampoo',
                'description' => 'Deep cleaning and extraction for carpets and cloth seats to remove tough stains and grime.',
                'price' => 60.00,
                'estimated_duration_minutes' => 75,
                'is_active' => true,
            ],
        ];

        // Itera sobre el array y crea cada registro en la base de datos
        foreach ($extraServices as $service) {
            ExtraService::create($service);
        }
    }
}