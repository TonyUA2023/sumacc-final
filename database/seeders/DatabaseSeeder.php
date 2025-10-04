<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // El orden es crucial para que las llaves foráneas funcionen
        $this->call([
            ExtraServiceSeeder::class      // Al final, ya que depende de los anteriores
        ]);
    }
}