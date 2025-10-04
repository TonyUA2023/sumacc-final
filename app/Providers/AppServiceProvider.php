<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\HeaderController;
use Illuminate\Support\Facades\Schema; // <-- 1. Agregamos esta línea para importar Schema

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 2. Envolvemos la llamada en una condición para verificar si la tabla existe
        // Esto evita que se ejecute durante 'php artisan migrate' en una BD limpia.
        // Asumo que tu consulta también usa la tabla 'services', por eso la incluyo.
        if (Schema::hasTable('service_categories') && Schema::hasTable('services')) {
            // Compartir datos del header con todas las vistas
            HeaderController::shareHeaderData();
        }
    }
}
