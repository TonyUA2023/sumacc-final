<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\PublicController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar las rutas web para tu aplicación. Estas
| rutas son cargadas por el RouteServiceProvider y todas ellas
| serán asignadas al grupo de middleware "web".
|
*/

// --- RUTAS PÚBLICAS ---
// La ruta principal '/' ahora apunta al método 'index' del controlador.
Route::get('/', [PublicController::class, 'index'])->name('public.index');

Route::get('/services', [PublicController::class, 'services'])->name('public.services');
Route::get('/extra-services', [PublicController::class, 'extraServices'])->name('public.extra-services');
Route::get('/contact', [PublicController::class, 'contact'])->name('public.contact');

// Aquí irían tus otras rutas (por ejemplo, para el panel de administración).
