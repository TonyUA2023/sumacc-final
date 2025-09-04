<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicle_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->unsignedInteger('display_order')->default(0);
            $table->string('icon_path')->nullable()->comment('Ruta al ícono SVG o imagen del vehículo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicle_types');
    }
};