@extends('public.layout')

@section('content')
<section id="services-category" class="bg-black text-slate-200 py-10 md:py-12 mt-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="mb-6 text-xs md:text-sm" data-aos="fade-up">
            <ol class="flex items-center space-x-1 text-slate-400">
                <li><a href="{{ route('public.index') }}" class="hover:text-sky-400 transition-colors">Home</a></li>
                <li class="flex items-center">
                    <span class="mx-1">/</span>
                    <a href="{{ route('public.services') }}" class="hover:text-sky-400 transition-colors">Services</a>
                </li>
                <li class="flex items-center">
                    <span class="mx-1">/</span>
                    <span class="text-sky-400">{{ $category->name }}</span>
                </li>
            </ol>
        </nav>

        <div class="relative rounded-xl overflow-hidden mb-8 md:mb-10" data-aos="fade-up" data-aos-delay="100">
            <div class="absolute inset-0 bg-gradient-to-r from-black via-black/70 to-transparent z-10"></div>
            <div class="h-48 md:h-56 w-full bg-slate-800">
                @if($category->image_path)
                <img src="{{ asset($category->image_path) }}" alt="{{ $category->name }}" 
                     class="w-full h-full object-cover">
                @else
                <div class="w-full h-full flex items-center justify-center bg-slate-800">
                    <svg class="w-16 h-16 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                @endif
            </div>
            <div class="absolute bottom-0 left-0 p-4 md:p-6 z-20">
                <h1 class="text-2xl sm:text-3xl font-bold text-white mb-1">{{ $category->name }} Services</h1>
                @if($category->description)
                <p class="text-sm text-slate-300 max-w-2xl">
                    {{ $category->description }}
                </p>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 mb-12">
            @forelse($category->services as $service)
            <div class="service-card bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 border border-slate-700 rounded-xl overflow-hidden transition-all duration-300 group hover:border-sky-500/50 hover:shadow-lg hover:shadow-sky-900/20"
                 data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                
                <div class="flex flex-col lg:flex-row">
                    <div class="lg:w-2/5 relative">
                        <div class="h-48 lg:h-full overflow-hidden">
                            @if($service->image_path)
                            <img src="{{ asset($service->image_path) }}" alt="{{ $service->name }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            @else
                            <div class="w-full h-full bg-gradient-to-br from-slate-800 to-slate-900 flex items-center justify-center">
                                <svg class="w-12 h-12 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            @endif
                        </div>
                        <div class="absolute top-3 right-3 bg-gradient-to-r from-sky-500 to-sky-600 text-white text-xs font-bold px-2 py-1 rounded-full shadow">
                            {{ $service->base_duration_hours }}h
                        </div>
                        <div class="absolute bottom-3 left-3">
                            <span class="bg-sky-900/70 text-sky-300 text-xs font-medium px-2 py-1 rounded-full backdrop-blur-sm">
                                Popular
                            </span>
                        </div>
                    </div>

                    <div class="lg:w-3/5 p-5">
                        <div class="flex flex-col sm:flex-row justify-between items-start mb-4 gap-3">
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-slate-100 group-hover:text-sky-300 transition-colors">
                                    {{ $service->name }}
                                </h3>
                                @if($service->notes)
                                <p class="text-slate-300 mt-1 italic text-xs">"{{ $service->notes }}"</p>
                                @endif
                            </div>
                            <div class="text-right bg-slate-900/50 p-2 rounded-lg border border-slate-700 min-w-[120px]">
                                <div class="text-xs text-slate-400 uppercase tracking-wide">From</div>
                                <div class="text-xl font-bold text-sky-400">${{ number_format($service->servicePrices->min('price')) }}</div>
                            </div>
                        </div>

                        @if($service->recommendation)
                        <div class="bg-sky-900/20 border border-sky-800/30 p-3 rounded-lg mb-4 text-sm">
                            <div class="flex items-start">
                                <svg class="w-4 h-4 text-sky-400 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                <span class="text-slate-300">{{ $service->recommendation }}</span>
                            </div>
                        </div>
                        @endif

                        @if($service->features)
                        <div class="mb-5">
                            <h4 class="text-base font-semibold text-slate-200 mb-3 flex items-center">
                                <svg class="w-4 h-4 text-sky-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Include
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach($service->features as $featureCategory => $features)
                                <div class="bg-slate-900/30 p-3 rounded-md border border-slate-700/50 text-sm">
                                    <h5 class="font-medium text-sky-400 mb-1 flex items-center">
                                        <span class="w-1.5 h-1.5 bg-sky-400 rounded-full mr-2"></span>
                                        {{ $featureCategory }}
                                    </h5>
                                    <ul class="space-y-1">
                                        @foreach($features as $feature)
                                        <li class="text-xs text-slate-300 flex items-start">
                                            <svg class="w-3 h-3 text-sky-400 mr-1.5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>{{ $feature }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        @if($service->servicePrices->count() > 0)
                        <div class="mb-5">
                            <h4 class="text-base font-semibold text-slate-200 mb-3 flex items-center">
                                <svg class="w-4 h-4 text-sky-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Prices by vehicle type

                            </h4>
                            <div class="bg-slate-900/40 rounded-lg overflow-hidden border border-slate-700/50 text-xs">
                                <div class="grid grid-cols-2 md:grid-cols-{{ min($service->servicePrices->count(), 4) }} gap-1 p-2 bg-slate-800/50 border-b border-slate-700/50">
                                    @foreach($service->servicePrices as $price)
                                    <div class="text-center truncate px-1">
                                        <div class="font-semibold text-slate-300">{{ $price->vehicleType->name }}</div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="grid grid-cols-2 md:grid-cols-{{ min($service->servicePrices->count(), 4) }} gap-1 p-2">
                                    @foreach($service->servicePrices as $price)
                                    <div class="text-center">
                                        <div class="text-base font-bold text-sky-400">${{ number_format($price->price, 0) }}</div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="flex flex-col sm:flex-row gap-2">
                            <a href="{{ route('booking.step1', ['service_id' => $service->id]) }}" 
                               class="flex-1 bg-gradient-to-r from-sky-500 to-sky-600 hover:from-sky-600 hover:to-sky-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-300 transform hover:scale-[1.02] flex items-center justify-center shadow shadow-sky-500/20 group/btn text-sm">
                                <svg class="w-4 h-4 mr-1.5 group-hover/btn:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Book Now
                            </a>
                            <button class="bg-slate-800 hover:bg-slate-700 border border-slate-700 text-slate-300 font-medium py-3 px-3 rounded-lg transition-all duration-300 transform hover:scale-[1.02] flex items-center justify-center text-sm sm:order-first sm:w-12">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="sr-only">More Information</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-8" data-aos="fade-up">
                <div class="bg-slate-800/50 rounded-lg p-6 max-w-md mx-auto">
                    <svg class="w-12 h-12 text-slate-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-slate-300 mb-2">No hay servicios en esta categoría</h3>
                    <p class="text-slate-400 text-sm">Consulta nuestras otras categorías de servicios.</p>
                    <a href="{{ route('public.services') }}" class="inline-block mt-3 px-4 py-2 bg-sky-500 text-white rounded-md hover:bg-sky-600 transition-colors text-sm">
                        Ver Todos los Servicios
                    </a>
                </div>
            </div>
            @endforelse
        </div>

        <div class="mt-12 text-center" data-aos="fade-up">
            <h3 class="text-xl font-bold text-slate-100 mb-3">Need a Custom Solution?</h3>
            <p class="text-slate-400 mb-4 max-w-2xl mx-auto text-sm">We offer personalized detailing packages to fit your specific needs and budget.</p>
            <a href="#contact" class="inline-flex items-center px-5 py-2.5 bg-transparent border border-sky-500 text-sky-400 font-semibold rounded-md hover:bg-sky-500 hover:text-white transition-colors text-sm">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.308 1.538a11.037 11.037 0 005.334 5.334l1.538-2.308a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
                Contact Us for a Quote
            </a>
        </div>
    </div>
</section>

<section class="bg-slate-900 py-12 text-slate-200">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-center mb-8">Frequently Asked Questions</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-4xl mx-auto">
            <div class="bg-slate-800/50 p-4 rounded-lg" data-aos="fade-up">
                <h3 class="text-lg font-semibold text-sky-400 mb-2">How long does a typical service take?</h3>
                <p class="text-slate-300 text-sm">Most services take between 2-4 hours depending on the package and vehicle size. We'll give you a specific estimate when you book.</p>
            </div>
            
            <div class="bg-slate-800/50 p-4 rounded-lg" data-aos="fade-up" data-aos-delay="100">
                <h3 class="text-lg font-semibold text-sky-400 mb-2">Do I need to provide anything?</h3>
                <p class="text-slate-300 text-sm">Just access to water and electricity. We bring all our own equipment, supplies, and expertise to make your vehicle look its best.</p>
            </div>
            
            <div class="bg-slate-800/50 p-4 rounded-lg" data-aos="fade-up" data-aos-delay="200">
                <h3 class="text-lg font-semibold text-sky-400 mb-2">What does the basic wash include?</h3>
                <p class="text-slate-300 text-sm">Our basic wash includes an exterior hand wash, drying, wheel cleaning, and interior vacuuming. Add-ons are available for extra protection.</p>
            </div>
            
            <div class="bg-slate-800/50 p-4 rounded-lg" data-aos="fade-up" data-aos-delay="300">
                <h3 class="text-lg font-semibold text-sky-400 mb-2">How often should I detail my car?</h3>
                <p class="text-slate-300 text-sm">We recommend a basic wash every 2-4 weeks and a full detail every 3-6 months to maintain your vehicle's appearance and value.</p>
            </div>
        </div>
    </div>
</section>

<style>
    .service-card {
        transition: all 0.3s ease;
    }
    
    .service-card:hover {
        transform: translateY(-3px);
    }
    
    /* Mejoras de responsive */
    @media (max-width: 640px) {
        .service-card .lg\\:w-2\\/5 {
            width: 100%;
            height: 200px;
        }
        
        .service-card .lg\\:w-3\\/5 {
            width: 100%;
        }
    }
</style>
@endsection