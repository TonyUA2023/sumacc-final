<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ExtraService;
use App\Models\VehicleType;
use App\Models\Client;
use App\Models\ClientAddress;
use App\Models\Appointment;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use DateTimeZone;
use Exception;

class BookingController extends Controller
{
    /**
     * Paso 1: Muestra los detalles del servicio seleccionado.
     */
    public function step1(Request $request)
    {
        if ($request->has('service_id')) {
            Session::forget('booking');
        }

        $serviceId = $request->input('service_id') ?? Session::get('booking.service_id');
        if (!$serviceId) {
            return redirect()->route('public.services')->with('error', 'Please select a service to start.');
        }

        $service = Service::with(['servicePrices.vehicleType', 'category'])
                         ->where('id', $serviceId)
                         ->where('is_active', true)
                         ->firstOrFail();

        if ($service->features && !is_array($service->features)) {
            $service->features = json_decode($service->features, true) ?? [];
        }

        Session::put('booking.service_id', $service->id);
        return view('booking.step1', ['service' => $service]);
    }

    /**
     * Paso 2: Muestra el formulario para seleccionar el tipo de vehículo.
     */
    public function step2()
    {
        $serviceId = Session::get('booking.service_id');
        if (!$serviceId) {
            return redirect()->route('public.services')->with('error', 'Please select a service first.');
        }

        $service = Service::with('servicePrices.vehicleType')->findOrFail($serviceId);
        return view('booking.step2', ['service' => $service]);
    }

    /**
     * Paso 2: Guarda la selección del tipo de vehículo en la sesión.
     */
    public function storeStep2(Request $request)
    {
        $request->validate(['vehicle_type_id' => 'required|exists:vehicle_types,id']);
        Session::put('booking.vehicle_type_id', $request->vehicle_type_id);
        Session::forget('booking.extra_services');
        return redirect()->route('booking.step3');
    }

    /**
     * Paso 3: Muestra el formulario para añadir servicios extra.
     */
    public function step3()
    {
        if (!Session::has('booking.vehicle_type_id')) {
            return redirect()->route('booking.step2')->with('error', 'Please select a vehicle type first.');
        }
        $extraServices = ExtraService::where('is_active', true)->orderBy('name')->get();
        return view('booking.step3', ['extraServices' => $extraServices]);
    }

    /**
     * Paso 3: Guarda la selección de servicios extra en la sesión.
     */
    public function storeStep3(Request $request)
    {
        $request->validate(['extra_services' => 'nullable|array']);
        $extraServiceIds = $request->input('extra_services', []);
        Session::put('booking.extra_services', $extraServiceIds);
        return redirect()->route('booking.step4');
    }

    /**
     * Paso 4: Muestra el calendario para seleccionar fecha y hora.
     */
    public function step4()
    {
        if (!Session::has('booking.vehicle_type_id')) {
            return redirect()->route('booking.step2');
        }
        // Se pasa la fecha local del servidor para la validación del calendario
        $todayForCalendar = Carbon::now()->format('Y-m-d');
        return view('booking.step4_datetime', ['todayInSeattle' => $todayForCalendar]);
    }

    /**
     * Paso 4: Guarda la fecha y hora seleccionada en la sesión.
     */
    public function storeStep4(Request $request)
    {
        $request->validate([
            'selected_date' => 'required|date_format:Y-m-d',
            'selected_time' => 'required|date_format:H:i'
        ]);

        // Simplemente combinamos la fecha y hora en un string. Sin conversiones.
        $dateTimeString = $request->selected_date . ' ' . $request->selected_time;
        Session::put('booking.datetime', $dateTimeString);

        return redirect()->route('booking.step5');
    }

    /**
     * Paso 5: Muestra el formulario para los datos del cliente.
     */
    public function step5()
    {
        if (!Session::has('booking.datetime')) {
            return redirect()->route('booking.step4')->with('error', 'Please select a date and time first.');
        }
        return view('booking.step5_details');
    }

    /**
     * Paso 5: Guarda los datos del cliente en la sesión.
     */
    public function storeStep5(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10'
        ]);
        Session::put('booking.client_data', $validatedData);
        return redirect()->route('booking.step6');
    }

    /**
     * Paso 6: Muestra el resumen completo de la reserva.
     */
    public function step6()
    {
        $bookingData = Session::get('booking');
        if (!isset($bookingData['client_data'])) {
            return redirect()->route('booking.step5')->with('error', 'Please complete your details first.');
        }

        $service = Service::with('servicePrices')->findOrFail($bookingData['service_id']);
        $vehicleType = VehicleType::find($bookingData['vehicle_type_id']);
        $extraServices = ExtraService::whereIn('id', $bookingData['extra_services'] ?? [])->get();
        $servicePrice = $service->servicePrices->where('vehicle_type_id', $bookingData['vehicle_type_id'])->first();
        
        $basePrice = $servicePrice->price ?? 0;
        $extrasTotal = $extraServices->sum('price');
        $total = $basePrice + $extrasTotal;

        // Leemos el string de la sesión y lo convertimos a un objeto Carbon. Sin zona horaria.
        $appointmentDateTime = Carbon::parse($bookingData['datetime']);

        return view('booking.step6_summary', [
            'service' => $service,
            'vehicleType' => $vehicleType,
            'extraServices' => $extraServices,
            'basePrice' => $basePrice,
            'total' => $total,
            'appointmentDateTime' => $appointmentDateTime,
        ]);
    }

    /**
     * Paso 6: Procesa y guarda la cita en la base de datos.
     */
    public function storeStep6(Request $request)
    {
        $bookingData = Session::get('booking');
        if (!$bookingData) {
            return redirect()->route('public.services')->with('error', 'Your session has expired. Please start the booking process again.');
        }

        try {
            $service = Service::with('servicePrices')->findOrFail($bookingData['service_id']);
            $clientData = $bookingData['client_data'];
            
            $client = Client::firstOrCreate(
                ['email' => $clientData['email']],
                ['first_name' => $clientData['first_name'], 'last_name' => $clientData['last_name'], 'phone_number' => $clientData['phone_number']]
            );

            $address = ClientAddress::create([
                'client_id' => $client->id,
                'street_address' => $clientData['street_address'],
                'city' => $clientData['city'],
                'state' => $clientData['state'],
                'zip_code' => $clientData['zip_code']
            ]);
            
            // Leemos el string de la sesión. Sin conversiones.
            $appointmentDateTime = Carbon::parse($bookingData['datetime']);

            $servicePrice = $service->servicePrices->where('vehicle_type_id', $bookingData['vehicle_type_id'])->first();
            if (!$servicePrice) throw new Exception('Service price could not be determined.');

            $extraServices = ExtraService::whereIn('id', $bookingData['extra_services'] ?? [])->get();
            $total = $servicePrice->price + $extraServices->sum('price');

            $appointment = Appointment::create([
                'client_id' => $client->id,
                'client_address_id' => $address->id,
                'service_price_id' => $servicePrice->id,
                'appointment_datetime' => $appointmentDateTime, // Se guarda el objeto Carbon directamente
                'timezone' => 'N/A', // Ya no es relevante
                'estimated_duration_minutes' => ($service->base_duration_hours * 60) + $extraServices->sum('estimated_duration_minutes'),
                'status' => 'Pending Confirmation',
                'base_price' => $servicePrice->price,
                'final_total' => $total,
                'client_notes' => $request->input('special_instructions', '')
            ]);

            if ($extraServices->isNotEmpty()) {
                foreach ($extraServices as $extra) {
                    $appointment->extraServices()->attach($extra->id, ['price_at_booking' => $extra->price]);
                }
            }

            Session::forget('booking');
            return redirect()->route('booking.confirmation', $appointment->id);
        } catch (Exception $e) {
            return back()->with('error', 'An unexpected error occurred while processing your booking. Please try again.');
        }
    }

    /**
     * Muestra la página de confirmación final.
     */
    public function confirmation($appointmentId)
    {
        $appointment = Appointment::with([
            'client', 
            'address', 
            'servicePrice.service', 
            'servicePrice.vehicleType',
            'extraServices'
        ])->findOrFail($appointmentId);
        
        // No se necesita ninguna conversión. La hora se muestra tal como se guardó.
        return view('booking.confirmation', compact('appointment'));
    }
    
    /**
     * API: Devuelve los horarios disponibles para una fecha específica (AJAX).
     */
    public function getAvailableSlots(Request $request)
    {
        $request->validate(['date' => 'required|date_format:Y-m-d']);
        $date = $request->input('date');
        
        $checkDate = Carbon::createFromFormat('Y-m-d', $date)->startOfDay();
        
        $availableSlots = [];
        $now = Carbon::now();

        for ($hour = 7; $hour <= 22; $hour++) {
            $slotDateTime = $checkDate->copy()->setTime($hour, 0, 0);
            
            if ($slotDateTime->gt($now)) {
                // La consulta a la BD ahora es una comparación de strings
                $isBooked = Appointment::where('appointment_datetime', $slotDateTime->format('Y-m-d H:i:s'))->exists();
                if (!$isBooked) {
                    $availableSlots[] = sprintf('%02d:00', $hour);
                }
            }
        }
        
        return response()->json($availableSlots);
    }

    /**
     * Función privada para validar si un slot específico está disponible.
     */
    private function isSlotAvailable(Carbon $datetime): bool
    {
        if ($datetime->lte(Carbon::now())) return false;
        
        return !Appointment::where('appointment_datetime', $datetime->format('Y-m-d H:i:s'))->exists();
    }
}