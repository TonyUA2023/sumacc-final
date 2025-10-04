<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\PublicController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Admin\ReportController;

// --- PUBLIC ROUTES ---
Route::get('/', [PublicController::class, 'index'])->name('public.index');
Route::get('/services', [PublicController::class, 'services'])->name('public.services');

// SEO-friendly routes for categories
Route::prefix('car-detailing-services')->group(function () {
    Route::get('/{category}', [PublicController::class, 'servicesByCategory'])
        ->where('category', '[a-z0-9-]+')
        ->name('public.services.category');
});
Route::get('/api/service/premium-interior-detail', [PublicController::class, 'getPremiumInteriorDetailForBooking']);

// New SEO-friendly route for specific services
Route::get('services/{serviceSlug}', [PublicController::class, 'showService'])
    ->where('serviceSlug', '[a-z0-9-]+')
    ->name('public.services.show');

Route::get('/extra-services', [PublicController::class, 'extraServices'])->name('public.extra-services');
Route::get('/contact', [PublicController::class, 'contact'])->name('public.contact');

// New API route to get categories for the modal
Route::get('/api/categories-for-booking', [PublicController::class, 'getCategoriesForBooking']);


// --- BOOKING ROUTES ---
// routes/web.php

// --- BOOKING ROUTES ---
Route::prefix('booking')->name('booking.')->group(function () {
    // Step 1: Muestra el servicio (ya no necesita un método 'create' separado)
    // Se inicia desde una URL como /booking/create?service_id=1
    Route::get('/create', [BookingController::class, 'step1'])->name('step1');

    // Step 2: Muestra y guarda la selección del vehículo
    Route::get('/step2', [BookingController::class, 'step2'])->name('step2');
    Route::post('/store-step2', [BookingController::class, 'storeStep2'])->name('storeStep2');

    // Step 3: Muestra y guarda los servicios extra
    Route::get('/step3', [BookingController::class, 'step3'])->name('step3');
    Route::post('/store-step3', [BookingController::class, 'storeStep3'])->name('storeStep3');

    // Step 4: Muestra y guarda la fecha y hora
    Route::get('/step4', [BookingController::class, 'step4'])->name('step4');
    Route::post('/store-step4', [BookingController::class, 'storeStep4'])->name('storeStep4');
    Route::get('/available-slots', [BookingController::class, 'getAvailableSlots'])->name('availableSlots');

    // Step 5: Muestra y guarda los datos del cliente
    Route::get('/step5', [BookingController::class, 'step5'])->name('step5');
    Route::post('/store-step5', [BookingController::class, 'storeStep5'])->name('storeStep5');

    // Step 6: Muestra el resumen
    Route::get('/step6', [BookingController::class, 'step6'])->name('step6');
    Route::post('/store-step6', [BookingController::class, 'storeStep6'])->name('storeStep6');

    // Final Confirmation Page
    Route::get('/confirmation/{appointment}', [BookingController::class, 'confirmation'])->name('confirmation');
});
Route::get('/api/booking/available-slots', [BookingController::class, 'getAvailableSlots'])->name('booking.getAvailableSlots');

// --- BREEZE AUTHENTICATION ROUTES ---
require __DIR__.'/auth.php';

// --- PROTECTED ROUTES (for authenticated users) ---
Route::middleware(['auth'])->group(function () {
    // Main Dashboard (accessible for all authenticated users)
    Route::get('/dashboard', function () {
        // Redirect based on user role
        if (in_array(auth()->user()->role, ['Admin', 'Manager', 'Staff'])) {
            return redirect()->route('admin.dashboard');
        }
        return view('dashboard');
    })->name('dashboard');
    
    // User profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- ADMIN ROUTES (for admin only) ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Administrative Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Appointment management
    Route::resource('appointments', AppointmentController::class);
    Route::get('appointments/{appointment}/confirm', [AppointmentController::class, 'confirm'])->name('appointments.confirm');
    Route::get('appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');
    
    // Service management
    Route::resource('services', ServiceController::class)->only(['index']);
    Route::post('services/save-service', [ServiceController::class, 'saveService'])->name('services.save-service');
    Route::delete('services/{service}/destroy-service', [ServiceController::class, 'destroyService'])->name('services.destroy-service');
    Route::post('services/save-category', [ServiceController::class, 'saveCategory'])->name('services.save-category');
    Route::delete('services/{category}/destroy-category', [ServiceController::class, 'destroyCategory'])->name('services.destroy-category');
    Route::post('services/save-extra-service', [ServiceController::class, 'saveExtraService'])->name('services.save-extra-service');
    Route::delete('services/{extraService}/destroy-extra-service', [ServiceController::class, 'destroyExtraService'])->name('services.destroy-extra-service');

    Route::post('services/{service}/toggle-status', [ServiceController::class, 'toggleStatus'])->name('services.toggle-status');
    
    // API routes for getting data for edit modals
    Route::get('api/services/{service}', [ServiceController::class, 'getService'])->name('api.services.get');
    Route::get('api/categories/{category}', [ServiceController::class, 'getCategory'])->name('api.categories.get');
    Route::get('api/extra-services/{extraService}', [ServiceController::class, 'getExtraService'])->name('api.extra-services.get');

    // Client management
    Route::resource('clients', ClientController::class);
    Route::get('clients/{client}/history', [ClientController::class, 'history'])->name('clients.history');
    // User management
    Route::resource('users', UserController::class);
    Route::post('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::post('users/{user}/change-role', [UserController::class, 'changeRole'])->name('users.change-role');
    
    // Calendar
    Route::get('calendar', [CalendarController::class, 'index'])->name('calendar');
    Route::get('calendar/events', [CalendarController::class, 'getEvents'])->name('calendar.events');
    Route::post('calendar/events', [CalendarController::class, 'storeEvent'])->name('calendar.events.store');
    Route::put('calendar/events/{event}', [CalendarController::class, 'updateEvent'])->name('calendar.events.update');
    Route::delete('calendar/events/{event}', [CalendarController::class, 'destroyEvent'])->name('calendar.events.destroy');
    
});