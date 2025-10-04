@extends('layouts.app')

@section('title', 'Create Appointment')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Create New Appointment</h2>
    
    <form action="{{ route('admin.appointments.store') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label for="client_id" class="block text-gray-700 font-medium mb-2">Client</label>
            <select name="client_id" id="client_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->first_name }} {{ $client->last_name }} ({{ $client->email }})</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-4">
            <label for="service_price_id" class="block text-gray-700 font-medium mb-2">Service</label>
            <select name="service_price_id" id="service_price_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @foreach ($servicePrices as $servicePrice)
                    <option value="{{ $servicePrice->id }}">{{ $servicePrice->service->name }} ({{ $servicePrice->vehicleType->name }} - ${{ $servicePrice->price }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="appointment_datetime" class="block text-gray-700 font-medium mb-2">Date and Time</label>
            <input type="datetime-local" name="appointment_datetime" id="appointment_datetime" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
        </div>
        
        <div class="mb-4">
            <label for="estimated_duration_minutes" class="block text-gray-700 font-medium mb-2">Estimated Duration (minutes)</label>
            <input type="number" name="estimated_duration_minutes" id="estimated_duration_minutes" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
        </div>
        
        <div class="mb-6">
            <label for="client_notes" class="block text-gray-700 font-medium mb-2">Client Notes</label>
            <textarea name="client_notes" id="client_notes" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
        </div>
        
        <div class="flex items-center justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Create Appointment</button>
        </div>
    </form>
</div>
@endsection