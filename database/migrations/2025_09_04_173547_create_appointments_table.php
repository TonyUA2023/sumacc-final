<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('restrict');
            $table->foreignId('client_address_id')->constrained();
            $table->foreignId('service_price_id')->constrained();
            $table->dateTime('appointment_datetime');
            $table->unsignedInteger('estimated_duration_minutes');
            $table->string('timezone');
            $table->enum('status', ['Pending Confirmation', 'Confirmed', 'In Progress', 'Completed', 'Cancelled'])
                  ->default('Pending Confirmation');
            $table->decimal('base_price', 10, 2);
            $table->decimal('final_total', 10, 2)->nullable();
            $table->text('client_notes')->nullable();
            $table->text('internal_notes')->nullable();

            // Trazabilidad del admin (referencia a la tabla users)
            $table->foreignId('created_by_admin_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by_admin_id')->nullable()->constrained('users')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};