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
        Schema::create('appointment_status_history', function (Blueprint $table) {
            $table->id();

            // Llave foránea a la cita. Se añade un índice para búsquedas rápidas.
            $table->foreignId('appointment_id')->constrained()->onDelete('cascade');

            // Se usa ENUM para asegurar la integridad de los datos.
            // Define aquí todos los posibles estados que tu aplicación manejará.
            $statuses = ['Requested', 'Confirmed', 'On Way', 'In Progress', 'Completed', 'Cancelled', 'No Show'];
            $table->enum('old_status', $statuses)->nullable()->comment('Estado anterior de la cita');
            $table->enum('new_status', $statuses)->comment('Nuevo estado de la cita');
            
            // Trazabilidad del admin que realizó el cambio.
            // El índice mejora el rendimiento al filtrar por administrador.
            $table->foreignId('changed_by_admin_id')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null');
            
            // La marca de tiempo del cambio. useCurrent() establece la hora automáticamente.
            $table->timestamp('changed_at')->useCurrent();

            // Índices para optimizar las consultas
            $table->index('appointment_id');
            $table->index('changed_by_admin_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_status_history');
    }
};