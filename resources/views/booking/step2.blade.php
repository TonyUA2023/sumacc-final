@extends('booking.layout')
@section('currentStep', 2)

@section('booking-content')
<div class="flex flex-col h-full">
    {{-- Header --}}
    <div class="text-center mb-6 flex-shrink-0">
        <h2 class="text-2xl md:text-3xl font-bold text-white mb-2">Select Your Vehicle Type</h2>
        <p class="text-slate-400 text-sm">Choose an option to continue to the next step</p>
    </div>

    <form id="vehicle-form" action="{{ route('booking.storeStep2') }}" method="POST" class="flex flex-col flex-grow">
        @csrf
        
        {{-- Container for selection options and loading overlay --}}
        <div id="vehicle-selection-container" class="relative flex-grow overflow-y-auto pr-2">
            
            {{-- A more compact, list-style grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                @forelse($service->servicePrices as $price)
                    <label class="group relative flex cursor-pointer items-center rounded-lg border border-slate-700/60 bg-slate-800/40 p-4 transition-all duration-200 hover:border-blue-500/50 has-[:checked]:border-blue-500 has-[:checked]:bg-blue-900/20 has-[:checked]:ring-2 has-[:checked]:ring-blue-500/50">
                        
                        {{-- Vehicle Icon --}}
                        @if($price->vehicleType->icon_path)
                        <div class="mr-4 flex-shrink-0">
                            <img src="{{ asset($price->vehicleType->icon_path) }}" alt="{{ $price->vehicleType->name }}" class="h-10 w-10 object-contain transition-all duration-300 filter grayscale brightness-200 group-hover:filter-none group-has-[:checked]:filter-none">
                        </div>
                        @endif
                        
                        {{-- Vehicle Name & Price --}}
                        <div class="flex-grow">
                            <p class="font-semibold text-white transition-colors group-hover:text-blue-300">
                                {{ $price->vehicleType->name }}
                            </p>
                            <p class="text-sm font-bold text-blue-400">
                                ${{ number_format($price->price, 2) }}
                            </p>
                        </div>

                        {{-- Hidden Radio Input --}}
                        <input type="radio" name="vehicle_type_id" value="{{ $price->vehicleType->id }}" 
                               class="absolute opacity-0" required
                               {{ session('booking.vehicle_type_id') == $price->vehicleType->id ? 'checked' : '' }}>

                        {{-- Custom Radio Button Visual --}}
                        <div class="ml-4 flex h-5 w-5 flex-shrink-0 items-center justify-center rounded-full border-2 border-slate-600 transition-colors group-has-[:checked]:border-blue-500 group-has-[:checked]:bg-blue-500">
                           <div class="h-2 w-2 rounded-full bg-slate-800/40 transition-transform group-has-[:checked]:scale-100 scale-0"></div>
                        </div>

                    </label>
                @empty
                    <div class="col-span-full py-10 text-center text-slate-400">
                        <p>No vehicle prices have been configured for this service.</p>
                    </div>
                @endforelse
            </div>

            {{-- Loading Overlay --}}
            <div id="loading-overlay" class="absolute inset-0 bg-slate-900/80 flex-col items-center justify-center text-center hidden">
                <svg class="mb-4 h-8 w-8 animate-spin text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <p class="font-medium text-white">Preparing next step...</p>
            </div>

        </div>

        {{-- Navigation Button --}}
        <div class="mt-6 flex-shrink-0 border-t border-slate-700/30 pt-6">
            <a href="{{ route('booking.step1') }}" class="flex items-center rounded-lg bg-slate-700/50 py-3 px-6 text-slate-300 transition-colors hover:bg-slate-700/70">
                <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Previous
            </a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('vehicle-form');
    const radioButtons = document.querySelectorAll('input[name="vehicle_type_id"]');
    const loadingOverlay = document.getElementById('loading-overlay');

    radioButtons.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.checked) {
                // La línea que deshabilitaba los botones ha sido eliminada.
                
                // Mostrar la capa de carga
                if (loadingOverlay) {
                    loadingOverlay.classList.remove('hidden');
                    loadingOverlay.classList.add('flex');
                }
                
                // Enviar el formulario después de un breve instante
                setTimeout(() => {
                    form.submit();
                }, 400);
            }
        });
    });
});
</script>
@endsection