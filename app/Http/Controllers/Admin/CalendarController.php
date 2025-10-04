<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Carbon\Carbon;

class CalendarController extends Controller
{
    /**
     * Muestra la vista principal del calendario.
     */
    public function index()
    {
        return view('admin.calendar.index');
    }

    /**
     * Obtiene los eventos del calendario (citas) en formato JSON.
     */
    public function getEvents(Request $request)
    {
        // FullCalendar envía un rango de fechas.
        // Usamos whereBetween para filtrar las citas.
        $start = Carbon::parse($request->input('start'))->startOfDay();
        $end = Carbon::parse($request->input('end'))->endOfDay();
        
        $appointments = Appointment::with(['client', 'servicePrice.service'])
            ->whereBetween('appointment_datetime', [$start, $end])
            ->get();
        
        // Mapeamos los datos de las citas a un formato compatible con FullCalendar.
        $events = $appointments->map(function($appointment) {
            $statusColor = '#6B7280'; // Default gray for unknown status

            // Asignamos colores según el estado de la cita.
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

            // Calculamos la hora de finalización
            $endDatetime = Carbon::parse($appointment->appointment_datetime)
                               ->addMinutes($appointment->estimated_duration_minutes);

            return [
                'id' => $appointment->id,
                'title' => $appointment->servicePrice->service->name . ' - ' . $appointment->client->first_name,
                'start' => $appointment->appointment_datetime->toIso8601String(),
                'end' => $endDatetime->toIso8601String(),
                'color' => $statusColor,
                'url' => route('admin.appointments.edit', $appointment->id),
            ];
        });

        return response()->json($events);
    }
}