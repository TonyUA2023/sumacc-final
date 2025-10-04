@extends('booking.layout')
@section('currentStep', 3)

@section('booking-content')
<div class="flex flex-col h-full">
    {{-- Header --}}
    <div class="text-center mb-6 flex-shrink-0">
        <h2 class="text-2xl md:text-3xl font-bold text-white mb-2">Add Extra Services</h2>
        <p class="text-slate-400 text-sm">Enhance your detailing experience (optional)</p>
    </div>

    <form action="{{ route('booking.storeStep3') }}" method="POST" class="flex flex-col flex-grow">
        @csrf
        <div class="flex-grow overflow-y-auto pr-2">
            @php
                $selectedExtras = session('booking.extra_services', []);
            @endphp
            
            {{-- Contenedor de la cuadrícula responsiva y minimalista --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

                @forelse($extraServices as $extra)
                {{-- Cada label es un "botón" seleccionable --}}
                <label class="group relative flex items-center justify-between cursor-pointer rounded-lg border p-4 transition-all duration-200
                               {{-- Estilos base (sin seleccionar) --}}
                               bg-slate-800/40 border-slate-700/60 
                               {{-- Estilos al pasar el mouse --}}
                               hover:border-blue-500
                               {{-- Estilos cuando está seleccionado (cambio de color) --}}
                               has-[:checked]:bg-blue-600 has-[:checked]:border-blue-500 has-[:checked]:ring-2 has-[:checked]:ring-blue-500/50">
                    
                    {{-- El checkbox real, oculto pero funcional --}}
                    <input type="checkbox" name="extra_services[]" value="{{ $extra->id }}"
                           class="sr-only"
                           {{ in_array($extra->id, $selectedExtras) ? 'checked' : '' }}>

                    {{-- Nombre del Servicio --}}
                    <span class="font-semibold text-white transition-colors group-has-[:checked]:text-white">
                        {{ $extra->name }}
                    </span>

                    {{-- Precio del Servicio --}}
                    <span class="font-bold text-blue-400 transition-colors group-has-[:checked]:text-white">
                        +${{ number_format($extra->price, 2) }}
                    </span>

                </label>
                @empty
                <div class="md:col-span-2 text-center py-10 text-slate-400">
                    <p>No extra services are available at the moment.</p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- Botones de Navegación --}}
        <div class="mt-6 pt-6 border-t border-slate-700/30 flex justify-between flex-shrink-0">
            <a href="{{ route('booking.step2') }}" class="bg-slate-700/50 text-slate-300 py-3 px-6 rounded-lg hover:bg-slate-700/70 transition-colors flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Previous
            </a>
            <button type="submit" class="bg-blue-500 text-white py-3 px-8 rounded-lg font-semibold hover:bg-blue-600 transition-colors flex items-center group">
                Continue to Date & Time
                <svg class="w-5 h-5 ml-2 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </button>
        </div>
    </form>
</div>
@endsection