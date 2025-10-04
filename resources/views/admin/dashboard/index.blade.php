@extends('layouts.app')

@section('title', 'Admin Dashboard - Suimacc Detailing')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6 stats-card">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-600">Total Appointments</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['total_appointments'] }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 stats-card">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-600">Pending Confirmation</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['pending_appointments'] }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 stats-card">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-600">Completed</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['completed_appointments'] }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 stats-card">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-red-100 text-red-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-600">Cancelled</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['cancelled_appointments'] }}</p>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6 stats-card">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-600">Total Clients</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['total_clients'] }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 stats-card">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-600">Active Services</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['total_services'] }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 stats-card">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-pink-100 text-pink-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-600">Categories</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['total_categories'] }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 stats-card">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-teal-100 text-teal-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-600">Staff</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $stats['total_staff'] }}</p>
            </div>
        </div>
    </div>
</div>

---

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Appointment Distribution by Status</h3>
        <div class="h-64">
            <canvas id="statusChart"></canvas>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Appointment Trend (Last 6 Months)</h3>
        <div class="h-64">
            <canvas id="monthlyChart"></canvas>
        </div>
    </div>
</div>

---

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">Today's Appointments</h3>
            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                {{ $today_appointments->count() }} appointments
            </span>
        </div>
        <div class="divide-y divide-gray-200">
            @forelse($today_appointments as $appointment)
            <div class="px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="font-medium text-gray-900">{{ $appointment->client->first_name }} {{ $appointment->client->last_name }}</h4>
                        <p class="text-sm text-gray-600">{{ $appointment->servicePrice->service->name }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($appointment->appointment_datetime)->format('H:i') }}</p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                            {{ $appointment->status == 'Completed' ? 'bg-green-100 text-green-800' : 
                               ($appointment->status == 'Pending Confirmation' ? 'bg-yellow-100 text-yellow-800' : 
                               ($appointment->status == 'Confirmed' ? 'bg-blue-100 text-blue-800' : ($appointment->status == 'In Progress' ? 'bg-indigo-100 text-indigo-800' : 'bg-gray-100 text-gray-800'))) }}">
                            {{ $appointment->status }}
                        </span>
                    </div>
                </div>
            </div>
            @empty
            <div class="px-6 py-8 text-center text-gray-500">
                <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <p class="mt-4">No appointments scheduled for today</p>
            </div>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Financial Summary</h3>
        <div class="space-y-4">
            <div class="flex justify-between items-center p-4 bg-green-50 rounded-lg">
                <div>
                    <h4 class="font-medium text-green-800">Current Month's Earnings</h4>
                    <p class="text-sm text-green-600">Total from completed services</p>
                </div>
                <span class="text-2xl font-bold text-green-800">${{ number_format($current_month_earnings, 2) }}</span>
            </div>
            
            <div class="flex justify-between items-center p-4 bg-blue-50 rounded-lg">
                <div>
                    <h4 class="font-medium text-blue-800">Average Appointments per Day</h4>
                    <p class="text-sm text-blue-600">This month</p>
                </div>
                <span class="text-2xl font-bold text-blue-800">
                    {{ number_format($stats['total_appointments'] / max(1, date('j')), 1) }}
                </span>
            </div>
            
            <div class="flex justify-between items-center p-4 bg-purple-50 rounded-lg">
                <div>
                    <h4 class="font-medium text-purple-800">Average Ticket</h4>
                    <p class="text-sm text-purple-600">Value per service</p>
                </div>
                <span class="text-2xl font-bold text-purple-800">
                    ${{ number_format($current_month_earnings / max(1, $stats['completed_appointments']), 2) }}
                </span>
            </div>
        </div>
    </div>
</div>

---

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <h3 class="text-lg font-semibold text-gray-800">Recent Appointments</h3>
        <a href="{{ route('admin.appointments.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
            View All →
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($recent_appointments as $appointment)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">
                                    {{ substr($appointment->client->first_name, 0, 1) }}{{ substr($appointment->client->last_name, 0, 1) }}
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $appointment->client->first_name }} {{ $appointment->client->last_name }}</div>
                                <div class="text-sm text-gray-500">{{ $appointment->client->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $appointment->servicePrice->service->name }}</div>
                        <div class="text-sm text-gray-500">{{ $appointment->servicePrice->vehicleType->name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($appointment->appointment_datetime)->format('d/m/Y') }}</div>
                        <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($appointment->appointment_datetime)->format('H:i') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $appointment->status == 'Completed' ? 'bg-green-100 text-green-800' : 
                               ($appointment->status == 'Pending Confirmation' ? 'bg-yellow-100 text-yellow-800' : 
                               ($appointment->status == 'Confirmed' ? 'bg-blue-100 text-blue-800' : ($appointment->status == 'In Progress' ? 'bg-indigo-100 text-indigo-800' : 'bg-gray-100 text-gray-800'))) }}">
                            {{ $appointment->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        ${{ number_format($appointment->final_total, 2) }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        No recent appointments
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Appointment status chart
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        const statusChart = new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Pending Confirmation', 'Confirmed', 'In Progress', 'Completed', 'Cancelled'],
                datasets: [{
                    data: [
                        {{ $appointments_by_status['pending_confirmation'] }},
                        {{ $appointments_by_status['confirmed'] }},
                        {{ $appointments_by_status['in_progress'] }},
                        {{ $appointments_by_status['completed'] }},
                        {{ $appointments_by_status['cancelled'] }}
                    ],
                    backgroundColor: [
                        '#FBBF24', // Yellow for Pending
                        '#3B82F6', // Blue for Confirmed
                        '#6366F1', // Indigo for In Progress
                        '#10B981', // Green for Completed
                        '#EF4444'  // Red for Cancelled
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Monthly appointments chart
        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        const monthlyChart = new Chart(monthlyCtx, {
            type: 'line',
            data: {
                labels: @json(array_column($monthly_appointments, 'month')),
                datasets: [{
                    label: 'Appointments',
                    data: @json(array_column($monthly_appointments, 'count')),
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderColor: '#3B82F6',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
@endsection