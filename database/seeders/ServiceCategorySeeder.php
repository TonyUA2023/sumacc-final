<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;
use Illuminate\Support\Str; // <-- Important: Add the Str helper

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceCategory::create([
            'name' => 'Premium Detailing',
            'slug' => Str::slug('Premium Detailing'), // <-- ADDED
            'description' => 'Comprehensive detailing services to restore and protect your vehicle to a superior standard.',
            'display_order' => 1,
        ]);

        ServiceCategory::create([
            'name' => 'Hand Super Wash',
            'slug' => Str::slug('Hand Super Wash'), // <-- ADDED
            'description' => 'High-quality hand washes for the regular maintenance of your vehicle.',
            'display_order' => 2,
        ]);
    }
}
