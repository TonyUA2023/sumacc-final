@extends('booking.layout')
@section('currentStep', 5)

@section('booking-content')
<div class="flex flex-col h-full">
    {{-- Header --}}
    <div class="text-center mb-6 flex-shrink-0">
        <h2 class="text-2xl md:text-3xl font-bold text-white mb-2">Your Details</h2>
        <p class="text-slate-400 text-sm">Please provide your information to finalize the booking</p>
    </div>

    <form action="{{ route('booking.storeStep5') }}" method="POST" class="flex flex-col flex-grow">
        @csrf
        <div class="flex-grow overflow-y-auto pr-2 space-y-4">

            {{-- Fila: Nombre y Apellido --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-slate-300 mb-1">First Name</label>
                    <input type="text" id="first_name" name="first_name"
                           value="{{ old('first_name', session('booking.client_data.first_name')) }}"
                           placeholder="e.g., John"
                           required
                           class="w-full bg-slate-800/60 border border-slate-700 text-white rounded-lg p-3 text-sm focus:ring-blue-500 focus:border-blue-500">
                    @error('first_name')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="last_name" class="block text-sm font-medium text-slate-300 mb-1">Last Name</label>
                    <input type="text" id="last_name" name="last_name"
                           value="{{ old('last_name', session('booking.client_data.last_name')) }}"
                           placeholder="e.g., Doe"
                           required
                           class="w-full bg-slate-800/60 border border-slate-700 text-white rounded-lg p-3 text-sm focus:ring-blue-500 focus:border-blue-500">
                    @error('last_name')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Fila: Email y Teléfono --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-300 mb-1">Email Address</label>
                    <input type="email" id="email" name="email"
                           value="{{ old('email', session('booking.client_data.email')) }}"
                           placeholder="e.g., john.doe@example.com"
                           required
                           class="w-full bg-slate-800/60 border border-slate-700 text-white rounded-lg p-3 text-sm focus:ring-blue-500 focus:border-blue-500">
                    @error('email')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="phone_number" class="block text-sm font-medium text-slate-300 mb-1">Phone Number</label>
                    <input type="tel" id="phone_number" name="phone_number"
                           value="{{ old('phone_number', session('booking.client_data.phone_number')) }}"
                           placeholder="e.g., (206) 555-1234"
                           required
                           class="w-full bg-slate-800/60 border border-slate-700 text-white rounded-lg p-3 text-sm focus:ring-blue-500 focus:border-blue-500">
                    @error('phone_number')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Fila: Dirección --}}
            <div>
                <label for="street_address" class="block text-sm font-medium text-slate-300 mb-1">Street Address (Where we'll perform the service)</label>
                <input type="text" id="street_address" name="street_address"
                       value="{{ old('street_address', session('booking.client_data.street_address')) }}"
                       placeholder="e.g., 1234 Pike St"
                       required
                       class="w-full bg-slate-800/60 border border-slate-700 text-white rounded-lg p-3 text-sm focus:ring-blue-500 focus:border-blue-500">
                @error('street_address')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Fila: Ciudad, Estado, Código Postal --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="city" class="block text-sm font-medium text-slate-300 mb-1">City</label>
                    <input type="text" id="city" name="city"
                           value="{{ old('city', session('booking.client_data.city', 'Seattle')) }}"
                           placeholder="e.g., Seattle"
                           required
                           class="w-full bg-slate-800/60 border border-slate-700 text-white rounded-lg p-3 text-sm focus:ring-blue-500 focus:border-blue-500">
                    @error('city')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="state" class="block text-sm font-medium text-slate-300 mb-1">State</label>
                    <input type="text" id="state" name="state"
                           value="{{ old('state', session('booking.client_data.state', 'WA')) }}"
                           placeholder="e.g., WA"
                           required
                           class="w-full bg-slate-800/60 border border-slate-700 text-white rounded-lg p-3 text-sm focus:ring-blue-500 focus:border-blue-500">
                    @error('state')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="zip_code" class="block text-sm font-medium text-slate-300 mb-1">ZIP Code</label>
                    <input type="text" id="zip_code" name="zip_code"
                           value="{{ old('zip_code', session('booking.client_data.zip_code')) }}"
                           placeholder="e.g., 98101"
                           required
                           class="w-full bg-slate-800/60 border border-slate-700 text-white rounded-lg p-3 text-sm focus:ring-blue-500 focus:border-blue-500">
                    @error('zip_code')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

        </div>

        {{-- Botones de Navegación --}}
        <div class="mt-6 pt-6 border-t border-slate-700/30 flex justify-between flex-shrink-0">
            <a href="{{ route('booking.step4') }}" class="bg-slate-700/50 text-slate-300 py-3 px-6 rounded-lg hover:bg-slate-700/70 transition-colors flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Previous
            </a>
            <button type="submit" class="bg-blue-500 text-white py-3 px-8 rounded-lg font-semibold hover:bg-blue-600 transition-colors flex items-center group">
                Continue to Summary
                <svg class="w-5 h-5 ml-2 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
        </div>
    </form>
</div>
@endsection