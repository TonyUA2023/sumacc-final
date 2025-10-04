<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\Service;
use App\Models\User;
use App\Models\ServiceCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Main statistics
        $stats = [
            'total_appointments' => Appointment::count(),
            'pending_appointments' => Appointment::where('status', 'Pending Confirmation')->count(),
            'completed_appointments' => Appointment::where('status', 'Completed')->count(),
            'cancelled_appointments' => Appointment::where('status', 'Cancelled')->count(),
            'total_clients' => Client::count(),
            'total_services' => Service::where('is_active', true)->count(),
            'total_categories' => ServiceCategory::count(),
            'total_staff' => User::where('role', 'Admin')->orWhere('role', 'Staff')->orWhere('role', 'Manager')->count(),
        ];

        // Recent appointments (last 5)
        $recent_appointments = Appointment::with(['client', 'servicePrice.service'])
            ->orderBy('appointment_datetime', 'desc')
            ->take(5)
            ->get();

        // Today's appointments
        $today_appointments = Appointment::with(['client', 'servicePrice.service'])
            ->whereDate('appointment_datetime', Carbon::today())
            ->orderBy('appointment_datetime', 'asc')
            ->get();

        // Current month's earnings
        $current_month_earnings = Appointment::where('status', 'Completed')
            ->whereMonth('appointment_datetime', Carbon::now()->month)
            ->sum('final_total');

        // Appointments by status (for chart)
        $appointments_by_status = [
            'pending_confirmation' => Appointment::where('status', 'Pending Confirmation')->count(),
            'confirmed' => Appointment::where('status', 'Confirmed')->count(),
            'in_progress' => Appointment::where('status', 'In Progress')->count(),
            'completed' => Appointment::where('status', 'Completed')->count(),
            'cancelled' => Appointment::where('status', 'Cancelled')->count(),
        ];

        // Appointments by month (last 6 months for chart)
        $monthly_appointments = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $count = Appointment::whereYear('appointment_datetime', $month->year)
                ->whereMonth('appointment_datetime', $month->month)
                ->count();
                
            $monthly_appointments[] = [
                'month' => $month->format('M Y'),
                'count' => $count
            ];
        }

        return view('admin.dashboard.index', compact(
            'stats', 
            'recent_appointments', 
            'today_appointments',
            'current_month_earnings',
            'appointments_by_status',
            'monthly_appointments'
        ));
    }
}