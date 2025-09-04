<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServicePrice;
use App\Models\VehicleType;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener IDs para las relaciones
        $categories = ServiceCategory::pluck('id', 'name');
        $vehicleTypes = VehicleType::pluck('id', 'name');

        $servicesData = [
            // ... (todo tu array de datos de servicios permanece igual)
             // === SERVICIOS DE PREMIUM DETAILING ===
             [
                'category' => 'Premium Detailing',
                'name' => 'Premium Interior Detail',
                'base_duration_hours' => 2.5,
                'recommendation' => 'Sugerido cada 3-5 meses o después de largos periodos sin un detallado profundo.',
                'features' => [
                    'Interior Detail' => [
                        'Thorough Vacuuming', 'Shampoo Door Panels, Headliner, All Carpets & Mats',
                        'Clean Seat Rails', 'Clean & Protect All Leather', 'Detailing Dash & Vents',
                        'Trunk Detail', 'Clean All Windows', 'Minor Stain Cleaning',
                        'Elimination of bad odors caused by pets', 'Premium air freshener', 'Interior UV protection',
                    ]
                ],
                'prices' => [
                    'Cars/Wagons' => 270.00, 'SUV' => 280.00, 'Full Size SUV' => 300.00,
                    'Full Size Truck/Van' => 320.00, 'XL/Lifted Vehicle' => 340.00,
                ]
            ],
            [
                'category' => 'Premium Detailing',
                'name' => 'Advanced Full Detail',
                'base_duration_hours' => 2.5,
                'notes' => 'Limpieza profunda con protección cerámica añadida. Perfecto para suciedad moderada o si ha pasado más de un mes desde el último detallado.',
                'recommendation' => 'Recomendado cada 2 a 4 semanas para un mantenimiento impecable.',
                'features' => [
                    'Exterior Cleaning' => ['Gentle Hand-Wash with Ceramic Shampoo', 'Hand Washed with a Coat of Carnauba', 'Exterior Glass Cleaned', 'Deep Clean Wheels & Wells', 'Dress and Shine Tires and Clean Exhaust Tips'],
                    'Interior Cleaning' => ['Interior and deep trunk vacuum cleaner', 'Complete Interior Detail', 'Interior Glass Cleaned', 'Wipe Down Door Jambs', 'Clean cup holders and clean rubber mats with Steam', 'Upholstery Cleaning', 'Cleaning Tables and Vents with Steam'],
                ],
                'prices' => [
                    'Cars/Wagons' => 240.00, 'SUV' => 250.00, 'Full Size SUV' => 270.00,
                    'Full Size Truck/Van' => 290.00, 'XL/Lifted Vehicle' => 310.00,
                ]
            ],
            [
                'category' => 'Premium Detailing',
                'name' => 'Premium Full Detail',
                'base_duration_hours' => 3.0,
                'notes' => 'Restaura el brillo y elegancia original de su vehículo. Limpieza profunda de interiores, eliminando manchas y olores, y protegiendo todas las superficies.',
                'recommendation' => 'Ideal cada 3-5 meses para una experiencia de auto como nuevo.',
                'features' => [
                    'Exterior Detail' => ['Per Foam Wash', 'Gentle Hand Car Wash', 'Clean Wheel & Wheel Wells', 'Clean Engine Bay', 'Clean Door, Trunk & Hood Jambs', 'Bug and Tar Removal', 'Wax with 1 Coat of Carnauba (Applied by Hand)', 'Clean Windows Inside & Out', 'Conditioner, Clean Exhaust Tips'],
                    'Interior Detail' => ['Thorough Vacuuming', 'Shampoo Door Panels, Headliner, All Carpets & Mats', 'Clean Seat Rails', 'Clean & Protect All Leather', 'Detailing Dash & Vents', 'Trunk Detail', 'Clean All Windows', 'Minor Stain Cleaning', 'Premium air freshener', 'Interior UV protection', 'Elimination of bad odors caused by pets'],
                ],
                'prices' => [
                    'Cars/Wagons' => 340.00, 'SUV' => 350.00, 'Full Size SUV' => 360.00,
                    'Full Size Truck/Van' => 380.00, 'XL/Lifted Vehicle' => 400.00,
                ]
            ],
            [
                'category' => 'Premium Detailing',
                'name' => 'Executive Detail Polish & Premium',
                'base_duration_hours' => 4.0,
                'notes' => 'Nuestro servicio más exclusivo. Restaura el brillo original, elimina imperfecciones y protege a largo plazo con un acabado impecable.',
                'recommendation' => 'Recomendado cada 2-5 meses para mantener una condición de exhibición.',
                'features' => [
                    'Exterior Detail' => ['Gentle Hand Car Wash', 'Clean Wheels & Wheel Wells', 'Clean Engine Bay', 'Clean Door, Trunk & Hood Jambs', 'Bug and Tar Removal', 'Paint Sealant', 'Single-State Machine Polish w/Swirl Removal', 'Wax w/1 - Coat of Carnauba (Applied by Hand)', 'Condition Plastic Trim', 'Polish Chrome and Trim', 'Clean Exhaust Tips', 'Dress Tires', 'Paint Correction [upon request]'],
                    'Interior Detail' => ['Thorough Vacuuming', 'Shampoo Door Panels, Headliner, All Carpets & Mats', 'Clean Seat Rails', 'Clean & Protect All Leather', 'Detailing Dash & Vents', 'Trunk Detail', 'Clean All Windows', 'Minor Stain Cleaning', 'Premium air freshener', 'Interior UV protection', 'Elimination of bad odors caused by pets'],
                ],
                'prices' => [
                    'Cars/Wagons' => 440.00, 'SUV' => 460.00, 'Full Size SUV' => 490.00,
                    'Full Size Truck/Van' => 510.00, 'XL/Lifted Vehicle' => 560.00,
                ]
            ],
            // === SERVICIOS DE HAND SUPER WASH ===
            [
                'category' => 'Hand Super Wash',
                'name' => 'Basic Super Wash',
                'base_duration_hours' => 1.5,
                'notes' => 'Mantiene su vehículo limpio y en excelentes condiciones. Ideal para la suciedad ligera del día a día.',
                'recommendation' => 'Recomendado cada 1 a 2 semanas.',
                'features' => [
                    'Exterior Cleaning' => ['Gentle Hand Car Wash with Shampoo', 'Exterior Glass Cleaned', 'Clean Exhaust Tips', 'Clean Wheel Wells', 'Clean Wheels', 'Dress and Shine Tires'],
                    'Interior Cleaning' => ['Deep vacuuming of the interior and trunk', 'Interior Spiff', 'Interior Glass Cleaned', 'Wipe Down Door Jambs', 'Clean Cup Holders, and Clean Rubber Floor Mats', 'Upholstery Cleaning', 'Cleaning Boards and Ventilation Grills'],
                ],
                'prices' => [
                    'Cars/Wagons' => 170.00, 'SUV' => 180.00, 'Full Size SUV' => 200.00,
                    'Full Size Truck/Van' => 220.00, 'XL/Lifted Vehicle' => 240.00,
                ]
            ],
            [
                'category' => 'Hand Super Wash',
                'name' => 'Basic Interior Service',
                'base_duration_hours' => 1.0,
                'features' => [
                    'Interior Cleaning' => ['Deep vacuuming of the interior and trunk', 'Interior Spiff', 'Interior Glass Cleaned', 'Wipe Down Door Jambs', 'Clean Cup Holders, and Clean Rubber Floor Mats', 'Upholstery Cleaning', 'Cleaning Boards and Ventilation Grills'],
                ],
                'prices' => [
                    'Cars/Wagons' => 130.00, 'SUV' => 140.00, 'Full Size SUV' => 160.00,
                    'Full Size Truck/Van' => 180.00, 'XL/Lifted Vehicle' => 200.00,
                ]
            ],
            [
                'category' => 'Hand Super Wash',
                'name' => 'Basic Exterior Wash',
                'base_duration_hours' => 1.0,
                'features' => [
                    'Exterior Cleaning' => ['Gentle Hand Car Wash with Shampoo', 'Exterior Glass Cleaned', 'Clean Exhaust Tips', 'Clean Wheel Wells', 'Clean Wheels', 'Dress and Shine Tires'],
                ],
                'prices' => [
                    'Cars/Wagons' => 100.00, 'SUV' => 115.00, 'Full Size SUV' => 125.00,
                    'Full Size Truck/Van' => 135.00, 'XL/Lifted Vehicle' => 155.00,
                ]
            ],
            [
                'category' => 'Hand Super Wash',
                'name' => 'Ceramic Maintenance Wash',
                'base_duration_hours' => 1.5,
                'notes' => 'Lavado especial para vehículos con recubrimiento cerámico. Mantiene el brillo y la protección sin dañar el sellador.',
                'recommendation' => 'Sugerido cada 2 a 4 semanas para maximizar la vida del cerámico.',
                'features' => [
                    'Exterior Cleaning' => ['Gentle Hand Car Wash', 'Exterior Glass Cleaned', 'Clean Wheels & Tires', 'Dress Tires', 'Ceramic Boost Sealant'],
                    'Interior Cleaning' => ['Interior & Trim, Vacuum', 'Interior Spiff', 'Interior Glass', 'Wipe down Door Jambs, Cup Holders, Rubber Floor Mats'],
                ],
                'prices' => [
                    'Cars/Wagons' => 190.00, 'SUV' => 200.00, 'Full Size SUV' => 220.00,
                    'Full Size Truck/Van' => 230.00, 'XL/Lifted Vehicle' => 250.00,
                ]
            ],
            [
                'category' => 'Hand Super Wash',
                'name' => 'Deluxe Wash & Wax',
                'base_duration_hours' => 2.5,
                'recommendation' => 'Recomendado cada 3-5 meses para una protección duradera.',
                'features' => [
                    'Exterior Detail' => ['Per Foam Wash', 'Gentle Hand Car Wash', 'Clean Wheels & Wheel Wells', 'Clean Engine Bay', 'Clean Door, Trunk & Hood Jambs', 'Bug and Tar Removal', 'Spot Clean Interior', 'Claybar Exterior Paint', 'Hand Wax with Carnauba Paste Wax (Ask About Ceramic Coatings 3-6 month Protection)', 'Clean Windows Inside & Out', 'Conditioner, Clean Exhaust Tips'],
                    'Interior Detail' => ['* Complementary vacuum only.'],
                ],
                'prices' => [
                    'Cars/Wagons' => 250.00, 'SUV' => 260.00, 'Full Size SUV' => 280.00,
                    'Full Size Truck/Van' => 300.00, 'XL/Lifted Vehicle' => 320.00,
                ]
            ],
        ];

        foreach ($servicesData as $data) {
            $service = Service::updateOrCreate(
                ['name' => $data['name']],
                [
                    'category_id' => $categories[$data['category']],
                    'base_duration_hours' => $data['base_duration_hours'],
                    'notes' => $data['notes'] ?? null,
                    'recommendation' => $data['recommendation'] ?? null,
                    // CORRECCIÓN: Se elimina json_encode() porque el modelo ya lo maneja con $casts
                    'features' => $data['features'],
                    'image_path' => '/images/services/' . \Illuminate\Support\Str::slug($data['name']) . '.jpg',
                    'is_active' => true,
                ]
            );

            foreach ($data['prices'] as $vehicleName => $price) {
                if (isset($vehicleTypes[$vehicleName])) {
                    ServicePrice::updateOrCreate(
                        [
                            'service_id' => $service->id,
                            'vehicle_type_id' => $vehicleTypes[$vehicleName],
                        ],
                        ['price' => $price]
                    );
                }
            }
        }
    }
}