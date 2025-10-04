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
        // Get IDs for relationships
        $categories = ServiceCategory::pluck('id', 'name');
        $vehicleTypes = VehicleType::pluck('id', 'name');

        $servicesData = [
            // === PREMIUM DETAILING SERVICES ===
            [
                'category' => 'Premium Detailing',
                'name' => 'Premium Interior Detail',
                'base_duration_hours' => 2.5,
                'recommendation' => 'Suggested every 3-5 months or after long periods without a deep detail.',
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
            // NEW SERVICE ADDED
            [
                'category' => 'Premium Detailing',
                'name' => 'Premium Exterior Detail',
                'base_duration_hours' => 2.0,
                'notes' => 'Focuses exclusively on restoring and protecting the vehicle\'s exterior. Ideal for removing light scratches and achieving a deep, long-lasting shine.',
                'recommendation' => 'Recommended every 4-6 months to maintain paint integrity and a showroom finish.',
                'features' => [
                    'Exterior Detail' => [
                        'Gentle Hand Car Wash',
                        'Bug and Tar Removal',
                        'Claybar Exterior Paint',
                        'Single-Stage Machine Polish to enhance gloss and remove minor swirls',
                        'Paint Sealant for long-lasting protection',
                        'Hand Wax with Carnauba Paste Wax',
                        'Clean Wheels & Wheel Wells',
                        'Dress Tires',
                        'Condition Plastic Trim',
                        'Clean Door, Trunk & Hood Jambs',
                        'Clean Windows Inside & Out',
                    ],
                    'Interior Detail' => [
                        '* Complementary vacuum only.',
                    ]
                ],
                'prices' => [
                    'Cars/Wagons' => 260.00,
                    'SUV' => 270.00,
                    'Full Size SUV' => 290.00,
                    'Full Size Truck/Van' => 310.00,
                    'XL/Lifted Vehicle' => 330.00,
                ]
            ],
            [
                'category' => 'Premium Detailing',
                'name' => 'Advanced Full Detail',
                'base_duration_hours' => 2.5,
                'notes' => 'Deep cleaning with added ceramic protection. Perfect for moderate dirt or if it has been more than a month since the last detail.',
                'recommendation' => 'Recommended every 2 to 4 weeks for impeccable maintenance.',
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
                'notes' => 'Restores your vehicle\'s original shine and elegance. Deep cleaning of interiors, removing stains and odors, and protecting all surfaces.',
                'recommendation' => 'Ideal every 3-5 months for a like-new car experience.',
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
                'notes' => 'Our most exclusive service. Restores the original shine, removes imperfections, and provides long-term protection with a flawless finish.',
                'recommendation' => 'Recommended every 2-5 months to maintain a showroom condition.',
                'features' => [
                    'Exterior Detail' => ['Gentle Hand Car Wash', 'Clean Wheels & Wheel Wells', 'Clean Engine Bay', 'Clean Door, Trunk & Hood Jambs', 'Bug and Tar Removal', 'Paint Sealant', 'Single-State Machine Polish w/Swirl Removal', 'Wax w/1 - Coat of Carnauba (Applied by Hand)', 'Condition Plastic Trim', 'Polish Chrome and Trim', 'Clean Exhaust Tips', 'Dress Tires', 'Paint Correction [upon request]'],
                    'Interior Detail' => ['Thorough Vacuuming', 'Shampoo Door Panels, Headliner, All Carpets & Mats', 'Clean Seat Rails', 'Clean & Protect All Leather', 'Detailing Dash & Vents', 'Trunk Detail', 'Clean All Windows', 'Minor Stain Cleaning', 'Premium air freshener', 'Interior UV protection', 'Elimination of bad odors caused by pets'],
                ],
                'prices' => [
                    'Cars/Wagons' => 440.00, 'SUV' => 460.00, 'Full Size SUV' => 490.00,
                    'Full Size Truck/Van' => 510.00, 'XL/Lifted Vehicle' => 560.00,
                ]
            ],

            // === HAND SUPER WASH SERVICES ===
            [
                'category' => 'Hand Super Wash',
                'name' => 'Full Super Wash',
                'base_duration_hours' => 1.5,
                'notes' => 'Keeps your vehicle clean and in excellent condition. Ideal for light, everyday dirt.',
                'recommendation' => 'Recommended every 1 to 2 weeks.',
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
                'name' => 'Full Exterior Wash',
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
                'notes' => 'Special wash for vehicles with ceramic coating. Maintains shine and protection without damaging the sealant.',
                'recommendation' => 'Suggested every 2 to 4 weeks to maximize the life of the ceramic coating.',
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
                'recommendation' => 'Recommended every 3-5 months for lasting protection.',
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
                    // CORRECTION: json_encode() is removed because the model already handles it with $casts
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