<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointment_extra_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->constrained()->onDelete('cascade');
            $table->foreignId('extra_service_id')->constrained()->onDelete('restrict');
            $table->decimal('price_at_booking', 10, 2);

            // Evita que se añada el mismo servicio extra dos veces a la misma cita
            // SOLUCIÓN: Se añade un nombre corto y personalizado para el índice único
            $table->unique(
                ['appointment_id', 'extra_service_id'],
                'appt_extra_service_unique' // <-- Nombre corto para evitar el error
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_extra_services');
    }
};