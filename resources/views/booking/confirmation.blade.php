@extends('public.layout')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 to-black py-12 mt-20">
    <div class="container mx-auto px-4 max-w-2xl">
        <div class="bg-slate-800/40 border border-slate-700/50 rounded-2xl p-6 md:p-8 text-center backdrop-blur-sm shadow-2xl shadow-blue-900/10">
            
            <div class="w-20 h-20 bg-emerald-500/10 rounded-full flex items-center justify-center mx-auto mb-6 border border-emerald-500/20">
                <svg class="w-10 h-10 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>

            <h2 class="text-3xl font-bold text-white mb-4">Final Step: Confirm Your Booking</h2>
            <p class="text-slate-400 mb-8">Your appointment is reserved! Please send us the summary below to finalize the confirmation.</p>

            {{-- RESUMEN DETALLADO DE LA CITA --}}
            <div class="bg-slate-900/50 rounded-xl p-4 md:p-6 mb-8 text-left border border-slate-700/30 space-y-6">
                
                {{-- Fecha y Hora --}}
                <div>
                    <h4 class="text-sm font-semibold text-blue-400 mb-2">APPOINTMENT</h4>
                    <div class="flex justify-between items-center">
                        <span class="text-slate-300">Date & Time</span>
                        <span class="text-white font-bold text-right">{{ $appointment->appointment_datetime->format('l, F j, Y') }}<br>{{ $appointment->appointment_datetime->format('g:i A') }}</span>
                    </div>
                </div>

                {{-- Servicio y Vehículo --}}
                <div>
                    <h4 class="text-sm font-semibold text-blue-400 mb-2">SERVICE DETAILS</h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-slate-400">Service:</span>
                            <span class="text-white font-medium">{{ $appointment->servicePrice->service->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">Vehicle Type:</span>
                            <span class="text-white font-medium">{{ $appointment->servicePrice->vehicleType->name }}</span>
                        </div>
                    </div>
                </div>
                
                {{-- Extras (si existen) --}}
                @if($appointment->extraServices->isNotEmpty())
                <div>
                    <h4 class="text-sm font-semibold text-blue-400 mb-2">EXTRA SERVICES</h4>
                    <div class="space-y-2 text-sm">
                        @foreach($appointment->extraServices as $extra)
                        <div class="flex justify-between">
                            <span class="text-slate-400">{{ $extra->name }}</span>
                            <span class="text-white font-medium">+${{ number_format($extra->pivot->price_at_booking, 2) }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Información del Cliente --}}
                <div>
                    <h4 class="text-sm font-semibold text-blue-400 mb-2">YOUR INFORMATION</h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-slate-400">Name:</span>
                            <span class="text-white font-medium">{{ $appointment->client->first_name }} {{ $appointment->client->last_name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">Address:</span>
                            <span class="text-white font-medium text-right">{{ $appointment->address->street_address }}, {{ $appointment->address->city }}</span>
                        </div>
                    </div>
                </div>

                {{-- Total --}}
                <div class="border-t border-slate-700 pt-4">
                    <div class="flex justify-between items-center text-lg">
                        <span class="font-semibold text-white">TOTAL</span>
                        <span class="font-bold text-blue-400">${{ number_format($appointment->final_total, 2) }}</span>
                    </div>
                </div>
            </div>

            {{-- PREPARACIÓN DE MENSAJES PARA WHATSAPP Y SMS --}}
            @php
                $summaryText = "I'm confirming my new appointment!\n\n"
                             . "Service: " . $appointment->servicePrice->service->name . "\n"
                             . "Vehicle: " . $appointment->servicePrice->vehicleType->name . "\n"
                             . "Date: " . $appointment->appointment_datetime->format('D, M j, Y \a\t g:i A') . "\n"
                             . "Address: " . $appointment->address->street_address . ", " . $appointment->address->city . "\n"
                             . "Client: " . $appointment->client->first_name . " " . $appointment->client->last_name . "\n"
                             . "Total: $" . number_format($appointment->final_total, 2);

                if ($appointment->extraServices->isNotEmpty()) {
                    $extrasList = "\nExtras:\n";
                    foreach ($appointment->extraServices as $extra) {
                        $extrasList .= "- " . $extra->name . "\n";
                    }
                    $summaryText .= $extrasList;
                }
                
                // URL para WhatsApp
                $whatsappUrl = "https://wa.me/14258761729?text=" . urlencode($summaryText);
                
                // URL para SMS (funciona en móviles)
                $smsUrl = "sms:+14258761729?&body=" . urlencode($summaryText);
            @endphp

            <p class="text-slate-400 mb-8">Choose your preferred method to send the summary:</p>

            {{-- BOTONES DE ACCIÓN PARA WHATSAPP Y SMS --}}
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                
                {{-- Botón de WhatsApp --}}
                <a href="{{ $whatsappUrl }}" target="_blank"
                   class="flex-1 bg-emerald-600 text-white py-3 px-6 rounded-xl hover:bg-emerald-700 transition-colors flex items-center justify-center text-lg font-semibold">
                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.864 3.488"/></svg>
                    Confirm via WhatsApp
                </a>
                
                {{-- Botón de SMS --}}
                <a href="{{ $smsUrl }}" target="_blank"
                   class="flex-1 bg-sky-600 text-white py-3 px-6 rounded-xl hover:bg-sky-700 transition-colors flex items-center justify-center text-lg font-semibold">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    Confirm via SMS
                </a>
            </div>
        </div>
    </div>
</div>
@endsection