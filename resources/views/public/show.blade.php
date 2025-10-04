@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="md:flex">
            {{-- Service Image Section --}}
            <div class="md:w-1/2">
                <img class="w-full h-auto object-cover" src="{{ asset($service->image_path) }}" alt="{{ $service->name }}">
            </div>

            {{-- Service Details and Features Section --}}
            <div class="md:w-1/2 p-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $service->name }}</h1>
                <p class="text-lg text-gray-600 mb-4">{{ $service->category->name }}</p>

                <div class="mb-4">
                    <h2 class="text-xl font-semibold text-gray-700">Service Details</h2>
                    <ul class="list-disc list-inside mt-2 text-gray-600">
                        <li>**Duration:** {{ $service->base_duration_hours }} hours</li>
                        @if($service->notes)
                            <li>**Notes:** {{ $service->notes }}</li>
                        @endif
                        @if($service->recommendation)
                            <li>**Recommendation:** {{ $service->recommendation }}</li>
                        @endif
                    </ul>
                </div>

                <div class="mb-4">
                    <h2 class="text-xl font-semibold text-gray-700">Features</h2>
                    @foreach($service->features as $groupName => $features)
                        <h3 class="text-md font-medium text-gray-800 mt-4">{{ $groupName }}</h3>
                        <ul class="list-disc list-inside ml-4 mt-2 text-gray-600">
                            @foreach($features as $feature)
                                <li>{{ $feature }}</li>
                            @endforeach
                        </ul>
                    @endforeach
                </div>
                
                <div class="mt-6">
                    <h2 class="text-xl font-semibold text-gray-700">Pricing</h2>
                    <p class="text-2xl text-green-600 font-bold">
                        ${{ number_format($service->min_price, 2) }} - ${{ number_format($service->max_price, 2) }}
                    </p>
                    <p class="text-sm text-gray-500 mt-1">Prices vary by vehicle type.</p>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Related Services Section --}}
    @if($relatedServices->count() > 0)
    <div class="mt-12">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Other Services You Might Like</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($relatedServices as $relatedService)
                <a href="{{ route('public.services.show', \Illuminate\Support\Str::slug($relatedService->name)) }}" class="block bg-white shadow-lg rounded-lg overflow-hidden transform hover:scale-105 transition-transform duration-200">
                    <img class="w-full h-48 object-cover" src="{{ asset($relatedService->image_path) }}" alt="{{ $relatedService->name }}">
                    <div class="p-4">
                        <h3 class="text-xl font-bold text-gray-800">{{ $relatedService->name }}</h3>
                        <p class="text-gray-600 mt-2">{{ $relatedService->category->name }}</p>
                        <p class="text-green-600 font-semibold mt-1">
                            From ${{ number_format($relatedService->min_price, 2) }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection