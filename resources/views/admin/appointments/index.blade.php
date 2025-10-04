@extends('layouts.app')

@section('title', 'Appointments Management')

@section('content')
<div class="min-h-screen bg-gray-100 p-4 sm:p-6 lg:p-8">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-4 md:space-y-0 mb-8">
            <h1 class="text-4xl font-extrabold text-gray-900">
                <i class="fas fa-calendar-check text-blue-600 mr-3"></i>Gestión de Citas
            </h1>
            <a href="{{ route('admin.appointments.create') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                <i class="fas fa-plus mr-2 -ml-1"></i>
                Nueva Cita
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm p-5 mb-6 border border-gray-200">
            <div class="flex flex-col md:flex-row md:items-center gap-4">
                <div class="flex-1">
                    <input type="text" placeholder="Buscar citas por cliente o servicio..." class="w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                </div>
                <div class="flex items-center space-x-2">
                    <select class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                        <option value="">Todos los estados</option>
                        <option value="pending">Pendiente de Confirmación</option>
                        <option value="confirmed">Confirmada</option>
                        <option value="in_progress">En Progreso</option>
                        <option value="completed">Completada</option>
                        <option value="cancelled">Cancelada</option>
                    </select>
                    <button class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 bg-gray-50 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-200">
                        <i class="fas fa-filter mr-2"></i>
                        Filtrar
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Cliente y Servicio
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider hidden sm:table-cell">
                                Fecha y Hora
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Estado
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider hidden md:table-cell">
                                Total
                            </th>
                            <th class="relative px-6 py-4">
                                <span class="sr-only">Acciones</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        {{-- Asegúrate de que el controlador ordene por appointment_datetime DESC para que las últimas citas aparezcan primero --}}
                        @forelse ($appointments as $appointment)
                        <tr class="hover:bg-blue-50/50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-md hidden sm:flex">
                                        {{ substr($appointment->client->first_name, 0, 1) }}{{ substr($appointment->client->last_name, 0, 1) }}
                                    </div>
                                    <div class="ml-0 sm:ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $appointment->client->first_name }} {{ $appointment->client->last_name }}</div>
                                        <div class="text-xs text-gray-500">{{ $appointment->servicePrice->service->name }}</div>
                                        <div class="text-xs text-gray-400 sm:hidden">
                                            {{ \Carbon\Carbon::parse($appointment->appointment_datetime)->format('d/m/Y H:i') }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap hidden sm:table-cell">
                                <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($appointment->appointment_datetime)->format('d/m/Y') }}</div>
                                <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($appointment->appointment_datetime)->format('H:i') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusColor = 'gray';
                                    switch ($appointment->status) {
                                        case 'Pending Confirmation': $statusColor = 'yellow'; break;
                                        case 'Confirmed': $statusColor = 'blue'; break;
                                        case 'In Progress': $statusColor = 'indigo'; break;
                                        case 'Completed': $statusColor = 'green'; break;
                                        case 'Cancelled': $statusColor = 'red'; break;
                                    }
                                @endphp
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{$statusColor}}-100 text-{{$statusColor}}-800">
                                    {{ $appointment->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 hidden md:table-cell">
                                ${{ number_format($appointment->final_total, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end items-center space-x-2">
                                    <a href="{{ route('admin.appointments.edit', $appointment->id) }}" class="text-indigo-600 hover:text-indigo-800 p-2 rounded-full hover:bg-gray-100 transition-colors duration-200" title="Editar">
                                        <i class="fas fa-edit w-4 h-4"></i>
                                    </a>
                                    <form action="{{ route('admin.appointments.destroy', $appointment->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 p-2 rounded-full hover:bg-gray-100 transition-colors duration-200" title="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar esta cita?');">
                                            <i class="fas fa-trash-alt w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-500 italic">
                                <i class="fas fa-calendar-times text-4xl text-gray-300 mb-4"></i>
                                <p>No se encontraron citas.</p>
                                <a href="{{ route('admin.appointments.create') }}" class="mt-2 inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                    Crear la primera cita
                                    <i class="fas fa-arrow-right w-4 h-4 ml-2"></i>
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $appointments->links() }}
            </div>
        </div>
    </div>
</div>
@endsection