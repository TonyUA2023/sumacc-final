<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('service_categories')->onDelete('restrict');
            $table->string('name');
            $table->decimal('base_duration_hours', 4, 2);
            $table->text('notes')->nullable();
            $table->text('recommendation')->nullable();
            $table->json('features')->nullable();
            $table->string('image_path')->nullable()->comment('Ruta a la imagen principal del servicio');

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};