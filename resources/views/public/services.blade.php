@extends('public.layout')

@section('content')
<section id="services" class="bg-black text-slate-200 py-16 md:py-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 md:mb-16">
            <h2 class="text-4xl sm:text-5xl font-bold text-sky-400" data-aos="fade-up">
                Our Premium Services
            </h2>
            <p class="mt-4 text-lg text-slate-400 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                Discover our range of professional detailing services tailored to keep your vehicle looking its best.
            </p>
        </div>

        @foreach($categories as $category)
        <div class="mb-16" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
            <h3 class="text-2xl md:text-3xl font-bold text-slate-100 mb-6 flex items-center">
                <span class="bg-sky-500 w-3 h-8 rounded-full mr-3"></span>
                {{ $category->name }}
                @if($category->description)
                <span class="text-sm text-slate-400 font-normal ml-4 mt-1">{{ $category->description }}</span>
                @endif
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($category->services as $service)
                <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-6 hover:border-sky-500/50 transition-all duration-300 group">
                    @if($service->image_path)
                    <div class="mb-4 rounded-lg overflow-hidden">
                        <img src="{{ asset($service->image_path) }}" alt="{{ $service->name }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                    @endif

                    <h4 class="text-xl font-semibold text-slate-100 mb-2 group-hover:text-sky-300 transition-colors">
                        {{ $service->name }}
                    </h4>

                    @if($service->features)
                    <ul class="space-y-1 mb-4">
                        @php
                            // Procesar features según su formato
                            $featuresToShow = [];
                            
                            if (is_string($service->features)) {
                                // Si es string, intentar decodificar JSON
                                $decoded = json_decode($service->features, true);
                                if (is_array($decoded)) {
                                    // Si es un array JSON, extraer todos los items
                                    foreach ($decoded as $categoryFeatures) {
                                        if (is_array($categoryFeatures)) {
                                            $featuresToShow = array_merge($featuresToShow, array_slice($categoryFeatures, 0, 3));
                                        }
                                    }
                                } else {
                                    // Si es string simple, usar como única feature
                                    $featuresToShow = [$service->features];
                                }
                            } elseif (is_array($service->features)) {
                                // Si ya es array, procesar según estructura
                                foreach ($service->features as $key => $value) {
                                    if (is_array($value)) {
                                        $featuresToShow = array_merge($featuresToShow, array_slice($value, 0, 3));
                                    } else {
                                        $featuresToShow[] = $value;
                                    }
                                }
                            }
                            
                            // Limitar a 3 features máximo
                            $featuresToShow = array_slice($featuresToShow, 0, 3);
                        @endphp
                        
                        @foreach($featuresToShow as $feature)
                        <li class="text-sm text-slate-300 flex items-center">
                            <svg class="w-4 h-4 text-sky-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            {{ is_array($feature) ? implode(', ', $feature) : $feature }}
                        </li>
                        @endforeach
                        
                        @if(count($featuresToShow) > 3)
                        <li class="text-sm text-sky-400">+ {{ count($featuresToShow) - 3 }} more features</li>
                        @endif
                    </ul>
                    @endif

                    <div class="mb-4">
                        @php
                            // Obtener precios mínimos y máximos
                            $minPrice = $service->servicePrices->min('price') ?? 0;
                            $maxPrice = $service->servicePrices->max('price') ?? 0;
                        @endphp
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-slate-400">Starting from:</span>
                            <span class="text-xl font-bold text-sky-400">${{ number_format($minPrice) }}</span>
                        </div>
                        
                        @if($minPrice != $maxPrice)
                        <div class="text-xs text-slate-500 text-right">
                            (Up to ${{ number_format($maxPrice) }} for larger vehicles)
                        </div>
                        @endif
                    </div>

                    <div class="mb-4">
                        <div class="flex items-center text-sm text-slate-400">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $service->base_duration_hours }} hours approx.
                        </div>
                    </div>

                    <a href="{{ route('booking.step1', ['service_id' => $service->id]) }}" 
                       class="w-full bg-sky-500 hover:bg-sky-600 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-300 transform hover:scale-105 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Book Now
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach

        @if($categories->isEmpty())
        <div class="text-center py-12">
            <div class="bg-slate-800/50 rounded-xl p-8 max-w-md mx-auto">
                <svg class="w-16 h-16 text-slate-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-xl font-semibold text-slate-300 mb-2">No services available</h3>
                <p class="text-slate-400">Please check back later for our service offerings.</p>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection