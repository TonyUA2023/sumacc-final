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
        Schema::create('users', function (Blueprint $table) {
            // Columnas estándar de Laravel
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // Columnas personalizadas basadas en tu modelo User
            $table->enum('role', ['Admin', 'Manager', 'Staff'])->default('Admin');
            $table->boolean('is_active')->default(true);
            
            // Columna estándar para la funcionalidad "Recordarme"
            $table->rememberToken();
            
            // Columnas estándar created_at y updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};