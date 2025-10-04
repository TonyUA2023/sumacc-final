@extends('booking.layout')
@section('currentStep', 6)

@section('booking-content')
<div class="flex flex-col h-full">
    {{-- Header --}}
    <div class="text-center mb-6 flex-shrink-0">
        <h2 class="text-2xl md:text-3xl font-bold text-white mb-2">Review Your Booking</h2>
        <p class="text-slate-400 text-sm">Please confirm the details below are correct before finalizing.</p>
    </div>

    <form action="{{ route('booking.storeStep6') }}" method="POST" class="flex flex-col flex-grow">
        @csrf
        <div class="flex-grow overflow-y-auto pr-2">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Columna Principal de Detalles (ocupa 2/3 en pantallas grandes) --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Sección de Fecha y Hora --}}
                    <div>
                        <h3 class="text-lg font-semibold text-white border-b border-slate-700/50 pb-2 mb-3">Appointment Details</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-slate-400">Date:</span>
                                <span class="text-white font-medium">{{ $appointmentDateTime->format('l, F j, Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-400">Time:</span>
                                <span class="text-white font-medium">{{ $appointmentDateTime->format('g:i A') }} (Seattle Time)</span>
                            </div>
                        </div>
                    </div>

                    {{-- Sección del Servicio --}}
                    <div>
                        <h3 class="text-lg font-semibold text-white border-b border-slate-700/50 pb-2 mb-3">Service Details</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-slate-400">Service:</span>
                                <span class="text-white font-medium">{{ $service->name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-400">Vehicle Type:</span>
                                <span class="text-white font-medium">{{ $vehicleType->name }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Sección de Extras --}}
                    @if($extraServices->isNotEmpty())
                    <div>
                        <h3 class="text-lg font-semibold text-white border-b border-slate-700/50 pb-2 mb-3">Extra Services</h3>
                        <div class="space-y-2 text-sm">
                            @foreach($extraServices as $extra)
                            <div class="flex justify-between">
                                <span class="text-slate-400">{{ $extra->name }}</span>
                                <span class="text-white font-medium">+${{ number_format($extra->price, 2) }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Sección de Datos del Cliente --}}
                    <div>
                        <h3 class="text-lg font-semibold text-white border-b border-slate-700/50 pb-2 mb-3">Your Information</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-slate-400">Name:</span>
                                <span class="text-white font-medium">{{ session('booking.client_data.first_name') }} {{ session('booking.client_data.last_name') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-400">Email:</span>
                                <span class="text-white font-medium">{{ session('booking.client_data.email') }}</span>
                            </div>
                             <div class="flex justify-between">
                                <span class="text-slate-400">Phone:</span>
                                <span class="text-white font-medium">{{ session('booking.client_data.phone_number') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-400">Address:</span>
                                <span class="text-white font-medium text-right">{{ session('booking.client_data.street_address') }},<br>{{ session('booking.client_data.city') }}, {{ session('booking.client_data.state') }} {{ session('booking.client_data.zip_code') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Instrucciones Especiales --}}
                    <div>
                         <label for="special_instructions" class="block text-lg font-semibold text-white mb-2">Special Instructions (Optional)</label>
                         <textarea name="special_instructions" id="special_instructions" rows="3" class="w-full bg-slate-800/60 border border-slate-700 text-white rounded-lg p-3 text-sm focus:ring-blue-500 focus:border-blue-500" placeholder="e.g., Please avoid using tire shine, my dog will be in the backyard, etc."></textarea>
                    </div>

                </div>

                {{-- Columna del Resumen de Precio (ocupa 1/3 en pantallas grandes) --}}
                <div class="lg:col-span-1">
                    <div class="bg-slate-800/40 border border-slate-700/30 rounded-lg p-4 sticky top-4">
                        <h3 class="text-lg font-semibold text-white border-b border-slate-700/50 pb-2 mb-4">Price Summary</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-slate-300">{{ $vehicleType->name }} Service</span>
                                <span>${{ number_format($basePrice, 2) }}</span>
                            </div>
                            @if($extraServices->isNotEmpty())
                                <div class="flex justify-between">
                                    <span class="text-slate-300">Extras</span>
                                    <span>${{ number_format($extraServices->sum('price'), 2) }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="mt-4 pt-4 border-t border-slate-700/50">
                            <div class="flex justify-between items-center text-lg font-bold">
                                <span class="text-white">Total</span>
                                <span class="text-blue-400">${{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Botones de Navegación --}}
        <div class="mt-6 pt-6 border-t border-slate-700/30 flex justify-between flex-shrink-0">
            <a href="{{ route('booking.step5') }}" class="bg-slate-700/50 text-slate-300 py-3 px-6 rounded-lg hover:bg-slate-700/70 transition-colors flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Previous
            </a>
            <button type="submit" class="bg-emerald-500 text-white py-3 px-8 rounded-lg font-semibold hover:bg-emerald-600 transition-colors flex items-center group">
                Confirm & Book Now
                <svg class="w-5 h-5 ml-2 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </button>
        </div>
    </form>
</div>
@endsection