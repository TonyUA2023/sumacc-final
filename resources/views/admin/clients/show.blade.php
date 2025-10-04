@extends('layouts.app')

@section('title', 'Client Details')

@section('content')
    <div class="space-y-8 p-4 md:p-6 lg:p-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 space-y-4 sm:space-y-0">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Client Details</h2>
                <p class="text-gray-600 mt-2">View and manage client information</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('admin.clients.edit', $client) }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg flex items-center transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Client
                </a>
                <a href="{{ route('admin.clients.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg flex items-center transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to List
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Client Information -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Info Card -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">First Name</p>
                            <p class="text-sm font-medium text-gray-900">{{ $client->first_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Last Name</p>
                            <p class="text-sm font-medium text-gray-900">{{ $client->last_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="text-sm font-medium text-gray-900">{{ $client->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Phone</p>
                            <p class="text-sm font-medium text-gray-900">{{ $client->phone_number }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Client Since</p>
                            <p class="text-sm font-medium text-gray-900">{{ $client->created_at->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Appointments</p>
                            <p class="text-sm font-medium text-gray-900">{{ $client->appointments->count() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Address Information -->
                @if($client->addresses->count() > 0)
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Address Information</h3>
                        @foreach($client->addresses as $address)
                            <div class="mb-4 last:mb-0">
                                <p class="text-sm font-medium text-gray-900">{{ $address->street_address }}</p>
                                <p class="text-sm text-gray-600">{{ $address->city }}, {{ $address->state }} {{ $address->zip_code }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Recent Appointments -->
            <div class="space-y-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Appointments</h3>
                    
                    @if($client->appointments->count() > 0)
                        <div class="space-y-4">
                            @foreach($client->appointments->take(5) as $appointment)
                                <div class="border-b border-gray-200 pb-4 last:border-b-0 last:pb-0">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ $appointment->servicePrice->service->name ?? 'Unknown Service' }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                {{ $appointment->appointment_datetime->format('M d, Y h:i A') }}
                                            </p>
                                        </div>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            @if($appointment->status == 'confirmed') bg-green-100 text-green-800
                                            @elseif($appointment->status == 'completed') bg-blue-100 text-blue-800
                                            @elseif($appointment->status == 'cancelled') bg-red-100 text-red-800
                                            @else bg-yellow-100 text-yellow-800
                                            @endif">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1">${{ number_format($appointment->final_total, 2) }}</p>
                                </div>
                            @endforeach
                        </div>
                        
                        @if($client->appointments->count() > 5)
                            <div class="mt-4 text-center">
                                <a href="{{ route('admin.clients.history', $client) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    View all appointments
                                </a>
                            </div>
                        @endif
                    @else
                        <p class="text-sm text-gray-500">No appointments found.</p>
                    @endif
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h3>
                    <div class="space-y-2">
                        <a href="#" class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                            Schedule New Appointment
                        </a>
                        <a href="#" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            Send Message
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection