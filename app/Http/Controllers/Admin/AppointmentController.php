<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\ServicePrice;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the appointments.
     */
    public function index()
    {
        $appointments = Appointment::with(['client', 'servicePrice.service', 'servicePrice.vehicleType'])
            ->orderBy('appointment_datetime', 'desc')
            ->paginate(15);
        
        // Citas para el calendario (formato FullCalendar)
        $events = Appointment::all()->map(function($appointment) {
            $statusColor = 'gray';
            switch ($appointment->status) {
                case 'Pending Confirmation':
                    $statusColor = '#FBBF24'; // Yellow
                    break;
                case 'Confirmed':
                    $statusColor = '#3B82F6'; // Blue
                    break;
                case 'In Progress':
                    $statusColor = '#6366F1'; // Indigo
                    break;
                case 'Completed':
                    $statusColor = '#10B981'; // Green
                    break;
                case 'Cancelled':
                    $statusColor = '#EF4444'; // Red
                    break;
            }

            return [
                'title' => $appointment->servicePrice->service->name . ' - ' . $appointment->client->first_name,
                'start' => Carbon::parse($appointment->appointment_datetime)->toIso8601String(),
                'end' => Carbon::parse($appointment->appointment_datetime)->addMinutes($appointment->estimated_duration_minutes)->toIso8601String(),
                'color' => $statusColor,
                'url' => route('admin.appointments.edit', $appointment->id),
            ];
        });

        return view('admin.appointments.index', compact('appointments', 'events'));
    }

    /**
     * Show the form for creating a new appointment.
     */
    public function create()
    {
        $clients = Client::all();
        $servicePrices = ServicePrice::with('service', 'vehicleType')->get();
        return view('admin.appointments.create', compact('clients', 'servicePrices'));
    }

    /**
     * Store a newly created appointment in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'service_price_id' => 'required|exists:service_prices,id',
            'appointment_datetime' => 'required|date',
            'estimated_duration_minutes' => 'required|integer',
            'client_notes' => 'nullable|string|max:1000',
        ]);
        
        // Aquí podrías agregar lógica para calcular base_price y final_total
        $servicePrice = ServicePrice::find($validatedData['service_price_id']);
        $validatedData['base_price'] = $servicePrice->price;
        $validatedData['final_total'] = $servicePrice->price; // Por ahora, igual que el precio base
        $validatedData['status'] = 'Confirmed';
        $validatedData['timezone'] = 'America/Lima'; // Ejemplo
        $validatedData['client_address_id'] = Client::find($validatedData['client_id'])->addresses()->first()->id; // Asume una dirección por cliente
        
        $appointment = Appointment::create($validatedData);

        return redirect()->route('admin.appointments.index')->with('success', 'Appointment created successfully.');
    }

    /**
     * Show the form for editing the specified appointment.
     */
    public function edit(Appointment $appointment)
    {
        $clients = Client::all();
        $servicePrices = ServicePrice::with('service', 'vehicleType')->get();
        return view('admin.appointments.edit', compact('appointment', 'clients', 'servicePrices'));
    }

    /**
     * Update the specified appointment in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'service_price_id' => 'required|exists:service_prices,id',
            'appointment_datetime' => 'required|date',
            'estimated_duration_minutes' => 'required|integer',
            'status' => ['required', Rule::in(['Pending Confirmation', 'Confirmed', 'In Progress', 'Completed', 'Cancelled'])],
            'client_notes' => 'nullable|string|max:1000',
            'final_total' => 'nullable|numeric',
        ]);

        $appointment->update($validatedData);

        return redirect()->route('admin.appointments.index')->with('success', 'Appointment updated successfully.');
    }

    /**
     * Remove the specified appointment from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('admin.appointments.index')->with('success', 'Appointment deleted successfully.');
    }
}