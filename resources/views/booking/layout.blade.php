{{-- resources/views/booking/layout.blade.php --}}
@extends('public.layout')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 to-black py-4 mt-16">
    <div class="container mx-auto px-4 max-w-5xl min-h-[calc(100vh-7rem)] flex flex-col">
        {{-- Progress Bar --}}
        <div class="mb-4 flex-shrink-0">
            <div class="flex justify-between items-center">
                @php
                    $steps = [
                        '1' => 'Service',
                        '2' => 'Vehicle',
                        '3' => 'Extras',
                        '4' => 'Date & Time',
                        '5' => 'Details',
                        '6' => 'Confirm'
                    ];
                    $currentStep = $currentStep ?? 1;
                    $totalSteps = count($steps);
                @endphp
                
                @foreach($steps as $stepNumber => $stepName)
                    <div class="text-center flex-1 relative">
                        <div class="w-8 h-8 mx-auto rounded-full flex items-center justify-center 
                                    {{ $currentStep >= $stepNumber ? 'bg-blue-500 text-white' : 'bg-slate-700 text-slate-400' }} 
                                    transition-colors mb-1 text-xs relative z-10">
                            {{ $stepNumber }}
                        </div>
                        <span class="text-xs text-slate-300 hidden xs:block">{{ $stepName }}</span>
                    </div>
                    @if(!$loop->last)
                        <div class="flex-1 flex items-center">
                            <div class="w-full h-0.5 bg-slate-700"></div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        {{-- Content --}}
        <div class="bg-slate-800/40 border border-slate-700/50 rounded-xl p-4 md:p-6 backdrop-blur-sm shadow-2xl shadow-blue-900/10 flex-grow overflow-hidden">
            <div class="h-full flex flex-col">
                @yield('booking-content')
            </div>
        </div>
    </div>
</div>
@endsection