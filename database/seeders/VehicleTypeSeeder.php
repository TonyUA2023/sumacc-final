<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VehicleType;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicleTypes = [
            ['name' => 'Cars/Wagons', 'display_order' => 1, 'icon_path' => '/icons/car.svg'],
            ['name' => 'SUV', 'display_order' => 2, 'icon_path' => '/icons/suv.svg'],
            ['name' => 'Full Size SUV', 'display_order' => 3, 'icon_path' => '/icons/full-suv.svg'],
            ['name' => 'Full Size Truck/Van', 'display_order' => 4, 'icon_path' => '/icons/truck.svg'],
            ['name' => 'XL/Lifted Vehicle', 'display_order' => 5, 'icon_path' => '/icons/lifted-truck.svg'],
        ];

        foreach ($vehicleTypes as $type) {
            VehicleType::updateOrCreate(['name' => $type['name']], $type);
        }
    }
}