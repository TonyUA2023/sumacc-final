@extends('layouts.app')

@section('title', 'Edit Appointment')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Appointment</h2>
    
    <form action="{{ route('admin.appointments.update', $appointment->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label for="client_id" class="block text-gray-700 font-medium mb-2">Client</label>
            <select name="client_id" id="client_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}" @if($client->id == $appointment->client_id) selected @endif>{{ $client->first_name }} {{ $client->last_name }} ({{ $client->email }})</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-4">
            <label for="service_price_id" class="block text-gray-700 font-medium mb-2">Service</label>
            <select name="service_price_id" id="service_price_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                @foreach ($servicePrices as $servicePrice)
                    <option value="{{ $servicePrice->id }}" @if($servicePrice->id == $appointment->service_price_id) selected @endif>{{ $servicePrice->service->name }} ({{ $servicePrice->vehicleType->name }} - ${{ $servicePrice->price }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="appointment_datetime" class="block text-gray-700 font-medium mb-2">Date and Time</label>
            <input type="datetime-local" name="appointment_datetime" id="appointment_datetime" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ \Carbon\Carbon::parse($appointment->appointment_datetime)->format('Y-m-d\TH:i') }}" required>
        </div>
        
        <div class="mb-4">
            <label for="estimated_duration_minutes" class="block text-gray-700 font-medium mb-2">Estimated Duration (minutes)</label>
            <input type="number" name="estimated_duration_minutes" id="estimated_duration_minutes" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ $appointment->estimated_duration_minutes }}" required>
        </div>

        <div class="mb-4">
            <label for="status" class="block text-gray-700 font-medium mb-2">Status</label>
            <select name="status" id="status" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="Pending Confirmation" @if($appointment->status == 'Pending Confirmation') selected @endif>Pending Confirmation</option>
                <option value="Confirmed" @if($appointment->status == 'Confirmed') selected @endif>Confirmed</option>
                <option value="In Progress" @if($appointment->status == 'In Progress') selected @endif>In Progress</option>
                <option value="Completed" @if($appointment->status == 'Completed') selected @endif>Completed</option>
                <option value="Cancelled" @if($appointment->status == 'Cancelled') selected @endif>Cancelled</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="final_total" class="block text-gray-700 font-medium mb-2">Final Total</label>
            <input type="number" name="final_total" id="final_total" step="0.01" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ $appointment->final_total }}">
        </div>
        
        <div class="mb-6">
            <label for="client_notes" class="block text-gray-700 font-medium mb-2">Client Notes</label>
            <textarea name="client_notes" id="client_notes" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ $appointment->client_notes }}</textarea>
        </div>
        
        <div class="flex items-center justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Update Appointment</button>
        </div>
    </form>
</div>
@endsection