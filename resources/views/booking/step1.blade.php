@extends('booking.layout')
@section('currentStep', 1)

@section('booking-content')
<div class="flex flex-col h-full">
    <div class="text-center mb-6 flex-shrink-0">
        <h2 class="text-2xl md:text-3xl font-bold text-white mb-2">Service Details</h2>
        <p class="text-slate-400 text-sm">Review the details of your selected service</p>
    </div>

    {{-- Contenedor principal que se convierte en grid en pantallas grandes --}}
    <div class="flex-grow overflow-y-auto pr-2 lg:grid lg:grid-cols-2 lg:gap-8 lg:overflow-visible">
        
        {{-- Columna 1: Imagen y Duración --}}
        <div class="mb-6 lg:mb-0">
            @if($service->image_path)
            <div class="rounded-xl overflow-hidden mb-4 border border-slate-700/30">
                <img src="{{ asset($service->image_path) }}" alt="{{ $service->name }}" class="w-full object-cover aspect-[4/3]" loading="lazy">
            </div>
            @endif

            @if($service->base_duration_hours)
            <div class="text-slate-300 text-sm flex items-center bg-slate-800/20 border border-slate-700/30 rounded-lg p-3">
                <svg class="w-4 h-4 text-blue-400 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span><strong class="font-medium text-white">Approximate Duration:</strong> {{ $service->base_duration_hours }} hour{{ $service->base_duration_hours > 1 ? 's' : '' }}</span>
            </div>
            @endif
        </div>

        {{-- Columna 2: Título, Categoría y Características (con su propio scroll en LG) --}}
        <div class="lg:max-h-[calc(100vh-280px)] lg:overflow-y-auto lg:pr-4">
            <div class="flex items-start justify-between mb-4">
                <h3 class="text-xl font-semibold text-white">{{ $service->name }}</h3>
                <span class="bg-blue-500/20 text-blue-300 text-xs px-3 py-1 rounded-full whitespace-nowrap ml-4">
                    {{ $service->category->name }}
                </span>
            </div>

            @if($service->features && is_array($service->features) && count($service->features) > 0)
            <div class="mb-4">
                <h4 class="text-blue-400 font-medium mb-3 text-sm">Service Includes:</h4>
                <div class="space-y-3">
                    @foreach($service->features as $categoryName => $items)
                    <div class="bg-slate-800/20 border border-slate-700/30 rounded-lg p-3">
                        <h5 class="text-white font-medium mb-2 flex items-center text-sm">
                            <svg class="w-4 h-4 text-blue-400 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            {{ $categoryName }}
                        </h5>
                        <ul class="space-y-2 ml-1">
                            @foreach((array)$items as $item)
                            <li class="text-slate-300 text-sm flex items-start">
                                <span class="text-blue-400 mr-2">•</span>
                                <span>{{ $item }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- Botón de navegación --}}
    <div class="mt-6 pt-6 border-t border-slate-700/30 flex justify-end flex-shrink-0">
        <a href="{{ route('booking.step2') }}" class="w-full sm:w-auto bg-blue-500 text-white py-3 px-8 rounded-lg font-semibold hover:bg-blue-600 transition-colors flex items-center justify-center group">
            Select Your Vehicle
            <svg class="w-5 h-5 ml-2 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </a>
    </div>
</div>
@endsection