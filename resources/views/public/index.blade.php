@extends('public.layout')

@section('content')
{{-- HERO SECTION --}}
<section
  id="hero"
  class="relative h-screen w-full overflow-hidden"
  data-aos="fade-in"
  data-aos-duration="1000"
>
  <div class="absolute inset-0 flex flex-col">
    <div
      class="relative flex-1 overflow-hidden"
      style="clip-path: polygon(0 0, 100% 0, 100% 70%, 0 100%);"
    >
      <img
        src="{{ asset('hero/carCd.webp') }}"
        alt="Imagen 1"
        class="absolute inset-0 w-full h-full object-cover"
      />
    </div>

    <div
      class="relative flex-1 overflow-hidden"
      style="clip-path: polygon(0 15%, 100% 0, 100% 85%, 0 100%);"
    >
      <img
        src="{{ asset('hero/bg-auto-hero.jpg') }}"
        alt="Imagen 2"
        class="absolute inset-0 w-full h-full object-cover"
      />
    </div>

    <div
      class="relative flex-1 overflow-hidden"
      style="clip-path: polygon(0 15%, 100% 0, 100% 100%, 0 100%);"
    >
      <img
        src="{{ asset('hero/carDoble.webp') }}"
        alt="Imagen 3"
        class="absolute inset-0 w-full h-full object-cover"
      />
    </div>
  </div>

  <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-black opacity-85"></div>

  <div
    class="container mx-auto relative z-10 flex flex-col lg:flex-row
           items-center justify-center lg:justify-between h-full px-4
           text-center lg:text-left"
    data-aos="fade-up"
    data-aos-delay="300"
  >
    <div class="lg:w-1/2 xl:w-3/5 space-y-6 lg:pr-10">
      <h1
        class="text-3xl sm:text-4xl md:text-5xl font-extrabold italic
               text-slate-100 leading-snug tracking-normal"
        data-aos="fade-right"
        data-aos-delay="500"
      >
        <span class="block">Premium Hand Wash</span>
        <span class="block">& Detailing</span>
        <span class="block text-sky-400">Deliver Door To Door</span>
      </h1>

      <p
        class="mt-3 text-base md:text-lg text-slate-300 max-w-lg mx-auto lg:mx-0"
        data-aos="fade-right"
        data-aos-delay="700"
      >
        At Sumacc, we bring professional car care right to your home or office.
        Using advanced techniques and premium products, your vehicle will look
        stunning without you lifting a finger.
      </p>

      <div
        class="mt-6 flex flex-col sm:flex-row justify-center lg:justify-start
               space-y-3 sm:space-y-0 sm:space-x-3"
        data-aos="fade-right"
        data-aos-delay="900"
      >
        <a
          href="/services"
          class="px-6 py-2 border-2 border-sky-500 text-sky-400
                 font-semibold uppercase rounded-lg shadow-md transform
                 transition-all duration-300 ease-in-out hover:bg-sky-500
                 hover:text-slate-900 hover:scale-105 hover:shadow-sky-500/30
                 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-opacity-50 text-sm"
          data-aos="zoom-in"
          data-aos-delay="1300"
        >
          Our Services
        </a>
      </div>
    </div>
  </div>
</section>

<section id="service-area" class="bg-black text-slate-200 py-16 md:py-20 border-t border-slate-800">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12 md:mb-16">
      <h2 class="text-4xl sm:text-5xl font-bold text-sky-400" data-aos="fade-up">Our Service Area</h2>
      <p class="mt-4 text-lg text-slate-400 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
        We proudly offer premium mobile detailing throughout Seattle and its surrounding cities.
      </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 md:gap-10 lg:gap-12 max-w-5xl mx-auto">
      @php
      $locations = [
        ['name' => 'Seattle', 'delay' => 100],
        ['name' => 'Bellevue', 'delay' => 150],
        ['name' => 'Redmond', 'delay' => 200],
        ['name' => 'Renton', 'delay' => 250],
        ['name' => 'Kirkland', 'delay' => 300],
        ['name' => 'Lynwood', 'delay' => 350],
        ['name' => 'Nearby Areas', 'delay' => 400]
      ];
      @endphp

      @foreach ($locations as $location)
      <div
        class="flex items-center bg-slate-800/70 border border-slate-700 rounded-xl px-5 py-4 shadow-lg shadow-sky-900/20 space-x-4 hover:shadow-sky-500/30 transition-all duration-300"
        data-aos="fade-up"
        data-aos-delay="{{ $location['delay'] }}"
      >
        <svg class="w-8 h-8 text-sky-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5s-3 1.343-3 3 1.343 3 3 3Zm0 0c-4 0-6 4-6 6h12c0-2-2-6-6-6Z" />
        </svg>
        <span class="text-lg font-semibold text-slate-100">{{ $location['name'] }}</span>
      </div>
      @endforeach
    </div>

    <div class="text-center mt-12 md:mt-16" data-aos="fade-up" data-aos-delay="500">
      <a href="/services"
        class="inline-block px-8 py-3.5 bg-sky-500 text-white text-sm font-semibold uppercase rounded-lg shadow-lg shadow-sky-500/30
               transform transition-all duration-300 ease-in-out
               hover:bg-sky-600 hover:scale-105 active:scale-95">
        Book in Your Area
      </a>
    </div>
  </div>
</section>



<section id="brands" class="bg-black py-16 md:py-20">
  <div class="container mx-auto px-4">
    <div class="text-center mb-10 md:mb-12">
      <h3 class="text-3xl sm:text-4xl font-semibold text-sky-400 mb-4" data-aos="fade-up" data-aos-duration="600">
        WE WORK WITH ALL BRANDS
      </h3>
      <p class="text-slate-400 text-lg max-w-2xl mx-auto" data-aos="fade-up" data-aos-duration="600" data-aos-delay="100">
        From classic rides to modern marvels, we service a diverse range of automotive brands with expertise.
      </p>
    </div>

    <div
      class="relative marquee-container overflow-hidden"
      data-aos="fade-up"
      data-aos-duration="600"
      data-aos-delay="200">
      <div class="flex animate-scroll whitespace-nowrap gap-6">
        @php $brands = ['ford', 'genesis', 'lambo', 'mustang', 'tesla', 'toyota', 'wolsbagen']; @endphp

        @foreach (array_merge($brands, $brands) as $brand)
        <div class="inline-flex items-center justify-center flex-shrink-0 px-4">
          <div class="bg-white/10 border border-white/20 rounded-xl p-4 backdrop-blur-md shadow-md hover:shadow-sky-500/30 transition-all duration-300 ease-in-out">
            <img
              src="{{ asset("marcaAutos/{$brand}.png") }}"
              alt="{{ ucfirst($brand) }}"
              class="h-12 sm:h-14 md:h-16 filter opacity-80 hover:grayscale-0 hover:opacity-100 transform hover:scale-110 transition duration-300 ease-in-out" />
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>


<style>
  .marquee-container {
    -webkit-mask-image: linear-gradient(to right, transparent 0%, black 10%, black 90%, transparent 100%);
    mask-image: linear-gradient(to right, transparent 0%, black 10%, black 90%, transparent 100%);
  }

  .animate-scroll {
    animation: scroll 40s linear infinite;
  }

  @keyframes scroll {
    0% {
      transform: translateX(0);
    }

    100% {
      transform: translateX(-50%);
    }
  }

  .marquee-container:hover .animate-scroll {
    animation-play-state: paused;
  }
</style>

{{-- ================================================
    PRICING SECTION - DISEÑO MINIMALISTA MEJORADO
    ================================================ --}}
<section id="pricing" class="bg-black text-slate-200 py-12 md:py-16">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-10">
      <h2 class="text-2xl sm:text-3xl font-bold text-slate-100 mb-3">
        Our <span class="text-sky-400">Services</span>
      </h2>
      <p class="text-slate-400 text-sm max-w-md mx-auto">
        Quick booking with essential details. Select and book in seconds.
      </p>
    </div>

    @if(count($packages) > 0)
      <div class="space-y-8">
        @foreach ($packages as $package)
          <div>
            {{-- Category Header --}}
            <h3 class="text-lg font-semibold text-slate-100 mb-4 pl-2 border-l-4 border-sky-500">
              {{ $package['name'] }}
            </h3>

            {{-- Services Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
              @foreach ($package['services'] as $service)
                <div class="bg-slate-800/30 border border-slate-700 rounded-lg p-4 hover:border-sky-400/50 transition-all duration-200 group cursor-pointer hover:shadow-lg hover:shadow-sky-900/10"
                     onclick="window.location='{{ route('booking.step1', ['service_id' => $service['id']]) }}'">
                  
                  {{-- Service Image --}}
                  @if(!empty($service['image_path']))
                  <div class="relative h-32 mb-3 rounded overflow-hidden">
                    <img 
                      src="{{ asset($service['image_path']) }}" 
                      alt="{{ $service['name'] }}" 
                      class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 to-transparent"></div>
                    
                    {{-- Exterior/Interior Badges --}}
                    <div class="absolute top-2 left-2 flex gap-1">
                      @if($service['has_exterior'])
                        <span class="bg-blue-500/90 text-white text-xs px-1.5 py-0.5 rounded">EXT</span>
                      @endif
                      @if($service['has_interior'])
                        <span class="bg-emerald-500/90 text-white text-xs px-1.5 py-0.5 rounded">INT</span>
                      @endif
                    </div>
                  </div>
                  @endif

                  {{-- Service Name --}}
                  <h4 class="text-base font-semibold text-slate-100 group-hover:text-sky-300 transition-colors mb-2 line-clamp-1">
                    {{ $service['name'] }}
                  </h4>

                  {{-- Price Badge --}}
                  <div class="flex items-center justify-between mb-2">
                    <div class="bg-sky-900/40 text-sky-300 text-xs font-medium px-2 py-1 rounded">
                      From ${{ number_format($service['min_price'], 0) }}
                    </div>
                    
                    {{-- More Prices Indicator --}}
                    @if($service['has_more_prices'])
                    <div class="text-xs text-slate-400 flex items-center" title="{{ $service['total_vehicle_types'] }} vehicle types available">
                      +{{ $service['total_vehicle_types'] - 2 }} more
                      <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                      </svg>
                    </div>
                    @endif
                  </div>

                  {{-- Vehicle Prices --}}
                  <div class="text-xs text-slate-300 mb-3 font-medium">
                    {{ $service['price_display'] }}
                  </div>

                  {{-- Key Features --}}
                  @if(!empty($service['features']))
                    <ul class="space-y-1 mb-3">
                      @foreach ($service['features'] as $feature)
                        <li class="text-xs text-slate-300 flex items-start">
                          <span class="text-sky-400 mr-1 text-xs">•</span>
                          <span class="flex-1 line-clamp-2">{{ $feature }}</span>
                        </li>
                      @endforeach
                    </ul>
                  @endif

                  {{-- Book Button --}}
                  <button class="w-full bg-sky-500 text-white text-xs font-medium py-2 px-3 rounded hover:bg-sky-600 transition-colors group-hover:bg-sky-600 flex items-center justify-center">
                    Book Now
                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                  </button>
                </div>
              @endforeach
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="text-center py-8">
        <div class="bg-slate-800/50 rounded-lg p-6 max-w-md mx-auto">
          <p class="text-slate-400 text-sm">No services available at the moment.</p>
        </div>
      </div>
    @endif

    {{-- Quick CTA --}}
    <div class="text-center mt-10">
      <p class="text-slate-400 text-sm mb-4">Need a custom solution?</p>
      <div class="flex flex-col sm:flex-row gap-3 justify-center items-center">
        <a href="https://wa.link/gemzk6" target="_blank" class="inline-flex items-center bg-emerald-600 text-white text-sm px-4 py-2 rounded hover:bg-emerald-700 transition-colors">
          <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.87 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.864 3.488"/>
          </svg>
          WhatsApp Quote
        </a>
      </div>
    </div>
  </div>
</section>

<section id="about" class="bg-black text-slate-200 py-16 md:py-20">
  <div class="max-w-7xl mx-auto px-6 lg:px-12 xl:px-8 flex flex-col lg:flex-row items-center gap-12 lg:gap-16">

    <div class="lg:w-1/2 space-y-6 text-center lg:text-left" data-aos="fade-right" data-aos-duration="800">
      <h2 class="text-4xl sm:text-5xl font-bold text-sky-400">About Us</h2>
      <p class="text-lg text-slate-300 font-semibold">
        At <span class="text-slate-100 font-bold">SUMACC</span>, we offer more than just car washing. We focus on perfection and detail.
      </p>
      <p class="text-slate-400 leading-relaxed">
        We take pride in transforming every car that comes to us. Your vehicle is an extension of you, so we ensure it receives meticulous care. We use high-quality products for an exceptional clean and shine that lasts.
      </p>
    </div>

    <div class="lg:w-1/2" data-aos="fade-left" data-aos-duration="800" data-aos-delay="150">
      <img
        src="{{ asset('media/about.jpg') }}"
        alt="Technician detailing a vehicle"
        class="rounded-2xl shadow-2xl shadow-sky-900/30 w-full h-auto object-cover aspect-video lg:aspect-auto" />
    </div>
  </div>
</section>

<section id="why-us" class="bg-black text-slate-200 py-16 md:py-20">
  <div class="max-w-7xl mx-auto px-6 lg:px-12 xl:px-8 flex flex-col-reverse lg:flex-row items-center gap-12 lg:gap-16">

    <div class="lg:w-1/2" data-aos="fade-right" data-aos-duration="800">
      <img
        src="{{ asset('Intern/limpiadoInterior.jpg') }}"
        alt="On-site mobile detailing"
        class="w-full rounded-2xl shadow-2xl shadow-sky-900/30 h-auto object-cover aspect-video lg:aspect-auto" />
    </div>

    <div class="lg:w-1/2 space-y-6 text-center lg:text-left" data-aos="fade-left" data-aos-duration="800" data-aos-delay="150">
      <h2 class="text-4xl sm:text-5xl font-bold text-sky-400">
        We Make Mobile Detailing More Convenient
      </h2>
      <p class="text-slate-400 leading-relaxed">
        Our expert team brings premium hand wash and deep-clean services right to your driveway or office.
        Enjoy a flawless finish without ever leaving your home, saving you time and hassle.
      </p>

      <div class="grid grid-cols-2 gap-6 sm:gap-8 pt-4" data-aos="fade-up" data-aos-delay="300">
        <div class="text-center space-y-2 p-4 bg-gray-900/50 rounded-lg" data-aos="fade-up" data-aos-delay="400">
          <p class="text-5xl font-extrabold text-slate-100">1K+</p>
          <div class="h-1 w-16 bg-sky-500 mx-auto rounded-full"></div>
          <p class="text-slate-400 text-sm font-medium">Satisfied Customers</p>
        </div>
        <div class="text-center space-y-2 p-4 bg-gray-900/50 rounded-lg" data-aos="fade-up" data-aos-delay="500">
          <p class="text-5xl font-extrabold text-slate-100">3+</p>
          <div class="h-1 w-16 bg-sky-500 mx-auto rounded-full"></div>
          <p class="text-slate-400 text-sm font-medium">Years of Experience</p>
        </div>
      </div>
    </div>

  </div>
</section>


<section id="services-gallery" x-data="{
    activeTab: 'wheels',
    showVideoModal: false,
    currentVideoUrl: '',
    playModalVideo() {
        this.showVideoModal = true;
        this.$nextTick(() => {
            if (this.$refs.modalPlayer) {
                this.$refs.modalPlayer.src = this.currentVideoUrl;
                this.$refs.modalPlayer.load();
                this.$refs.modalPlayer.play();
            }
        });
    },
    closeVideoModal() {
        this.showVideoModal = false;
        if (this.$refs.modalPlayer) {
            this.$refs.modalPlayer.pause();
            this.$refs.modalPlayer.src = '';
        }
    }
}" @keydown.escape.window="closeVideoModal()" class="bg-black text-slate-200 py-16 md:py-20">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12 md:mb-16">
      <h2 class="text-4xl sm:text-5xl font-bold text-sky-400 mb-3" data-aos="fade-up">OUR SERVICES</h2>
      <p class="text-xl sm:text-2xl text-slate-300 mb-4" data-aos="fade-up" data-aos-delay="100">Browse our range of professional detailing services.</p>
      <p class="text-md sm:text-lg text-slate-500" data-aos="fade-up" data-aos-delay="200">Select a category to see examples of our meticulous work.</p>
    </div>

    <div class="flex justify-center flex-wrap gap-3 sm:gap-4 mb-12 md:mb-16" data-aos="fade-up" data-aos-delay="300">
      <button @click="activeTab = 'wheels'" :class="activeTab === 'wheels' ? 'bg-sky-500 text-white scale-105 shadow-lg shadow-sky-500/30' : 'bg-slate-800 text-slate-300 hover:bg-slate-700 hover:text-sky-300'" class="px-5 py-2.5 sm:px-6 sm:py-3 rounded-full font-semibold transition-all duration-200 ease-in-out text-sm sm:text-base">
        Wheels
      </button>
      <button @click="activeTab = 'interior'" :class="activeTab === 'interior' ? 'bg-sky-500 text-white scale-105 shadow-lg shadow-sky-500/30' : 'bg-slate-800 text-slate-300 hover:bg-slate-700 hover:text-sky-300'" class="px-5 py-2.5 sm:px-6 sm:py-3 rounded-full font-semibold transition-all duration-200 ease-in-out text-sm sm:text-base">
        Interior Cleaning
      </button>
      <button @click="activeTab = 'exterior'" :class="activeTab === 'exterior' ? 'bg-sky-500 text-white scale-105 shadow-lg shadow-sky-500/30' : 'bg-slate-800 text-slate-300 hover:bg-slate-700 hover:text-sky-300'" class="px-5 py-2.5 sm:px-6 sm:py-3 rounded-full font-semibold transition-all duration-200 ease-in-out text-sm sm:text-base">
        Exterior Cleaning
      </button>
      <button @click="activeTab = 'shampoo'" :class="activeTab === 'shampoo' ? 'bg-sky-500 text-white scale-105 shadow-lg shadow-sky-500/30' : 'bg-slate-800 text-slate-300 hover:bg-slate-700 hover:text-sky-300'" class="px-5 py-2.5 sm:px-6 sm:py-3 rounded-full font-semibold transition-all duration-200 ease-in-out text-sm sm:text-base">
        Full Shampoo
      </button>
      <button @click="activeTab = 'opendoors'" :class="activeTab === 'opendoors' ? 'bg-sky-500 text-white scale-105 shadow-lg shadow-sky-500/30' : 'bg-slate-800 text-slate-300 hover:bg-slate-700 hover:text-sky-300'" class="px-5 py-2.5 sm:px-6 sm:py-3 rounded-full font-semibold transition-all duration-200 ease-in-out text-sm sm:text-base">
        Open Doors
      </button>
    </div>

    <div class="relative">
      <div class="min-h-[360px] md:min-h-[450px] xl:min-h-[480px]">
        <div x-show="activeTab === 'wheels'" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300 absolute inset-0" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 grid-flow-row-dense">
          <div @click="currentVideoUrl = '{{ asset('extern/weels/weels.mp4') }}'; playModalVideo()" class="col-span-2 row-span-2 relative rounded-xl overflow-hidden cursor-pointer group aspect-[16/10] shadow-lg" data-aos="zoom-in-up" data-aos-delay="100">
            <img src="{{ asset('media/wheels1.png') }}" alt="Wheels Detailing Main Video" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
            <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
              <svg class="w-16 h-16 text-sky-300 group-hover:text-sky-200 transform group-hover:scale-110 transition-all duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm14.024-.983a1.125 1.125 0 0 1 0 1.966l-5.625 3.125A1.125 1.125 0 0 1 9 15.125V8.875c0-.87.988-1.406 1.65-.983l5.625 3.125Z" />
              </svg>
            </div>
          </div>
          <img src="{{ asset('extern/weels/lambollanta.jpg') }}" alt="Lamborghini Wheel" class="rounded-xl object-cover w-full aspect-square shadow-md group hover:scale-105 transition-transform duration-300" data-aos="zoom-in-up" data-aos-delay="200">
          <img src="{{ asset('extern/weels/lambofrenos.jpg') }}" alt="Lamborghini Brakes" class="rounded-xl object-cover w-full aspect-square shadow-md group hover:scale-105 transition-transform duration-300" data-aos="zoom-in-up" data-aos-delay="300">
          <img src="{{ asset('extern/weels/llantas.jpg') }}" alt="Clean Tires" class="rounded-xl object-cover w-full aspect-square shadow-md group hover:scale-105 transition-transform duration-300" data-aos="zoom-in-up" data-aos-delay="400">
          <img src="{{ asset('extern/weels/bmwllantas.jpg') }}" alt="BMW Wheels" class="rounded-xl object-cover w-full aspect-square shadow-md group hover:scale-105 transition-transform duration-300" data-aos="zoom-in-up" data-aos-delay="500">
        </div>

        <div x-show="activeTab === 'interior'" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300 absolute inset-0" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 grid-flow-row-dense">
          <div @click="currentVideoUrl = '{{ asset('Intern/video/aspirado.mp4') }}'; playModalVideo()" class="col-span-2 row-span-2 relative rounded-xl overflow-hidden cursor-pointer group aspect-[16/10] shadow-lg" data-aos="zoom-in-up" data-aos-delay="100">
            <img src="{{ asset('media/presentation_video.png') }}" alt="Interior Vacuuming Main Video" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
            <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
              <svg class="w-16 h-16 text-sky-300 group-hover:text-sky-200 transform group-hover:scale-110 transition-all duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm14.024-.983a1.125 1.125 0 0 1 0 1.966l-5.625 3.125A1.125 1.125 0 0 1 9 15.125V8.875c0-.87.988-1.406 1.65-.983l5.625 3.125Z" />
              </svg>
            </div>
          </div>
          <div @click="currentVideoUrl = '{{ asset('Intern/video/limpiezainterior.mp4') }}'; playModalVideo()" class="relative rounded-xl overflow-hidden cursor-pointer group aspect-square shadow-md" data-aos="zoom-in-up" data-aos-delay="200">
            <img src="{{ asset('media/presentation_video.png') }}" alt="Interior Cleaning Sub Video" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
            <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
              <svg class="w-12 h-12 text-sky-300 group-hover:text-sky-200 transform group-hover:scale-110 transition-all duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm14.024-.983a1.125 1.125 0 0 1 0 1.966l-5.625 3.125A1.125 1.125 0 0 1 9 15.125V8.875c0-.87.988-1.406 1.65-.983l5.625 3.125Z" />
              </svg>
            </div>
          </div>
          <img src="{{ asset('Intern/limpiadoInterior.jpg') }}" alt="Cleaned Interior" class="rounded-xl object-cover w-full aspect-square shadow-md group hover:scale-105 transition-transform duration-300" data-aos="zoom-in-up" data-aos-delay="300">
          <img src="{{ asset('Intern/imgInterior.jpg') }}" alt="Detailed Interior Component" class="rounded-xl object-cover w-full aspect-square shadow-md group hover:scale-105 transition-transform duration-300" data-aos="zoom-in-up" data-aos-delay="400">
          <img src="{{ asset('Intern/toyotaInterno.jpg') }}" alt="Toyota Interior" class="rounded-xl object-cover w-full aspect-square shadow-md group hover:scale-105 transition-transform duration-300" data-aos="zoom-in-up" data-aos-delay="500">
        </div>

        <div x-show="activeTab === 'exterior'" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300 absolute inset-0" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 grid-flow-row-dense">
            <div @click="currentVideoUrl = '{{ asset('extern/camioneta-enjuague.mp4') }}'; playModalVideo()" class="col-span-2 row-span-2 relative rounded-xl overflow-hidden cursor-pointer group aspect-[16/10] shadow-lg" data-aos="zoom-in-up" data-aos-delay="100">
                <img src="{{ asset('media/presentation_video.png') }}" alt="Exterior Rinsing Main Video" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                   <svg class="w-16 h-16 text-sky-300 group-hover:text-sky-200 transform group-hover:scale-110 transition-all duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm14.024-.983a1.125 1.125 0 0 1 0 1.966l-5.625 3.125A1.125 1.125 0 0 1 9 15.125V8.875c0-.87.988-1.406 1.65-.983l5.625 3.125Z" /></svg>
                </div>
            </div>
            <img src="{{ asset('extern/lambofin.png') }}" alt="Finished Lamborghini" class="rounded-xl object-cover w-full aspect-square shadow-md group hover:scale-105 transition-transform duration-300" data-aos="zoom-in-up" data-aos-delay="200">
            <img src="{{ asset('extern/bmwfin.png') }}" alt="Finished BMW" class="rounded-xl object-cover w-full aspect-square shadow-md group hover:scale-105 transition-transform duration-300" data-aos="zoom-in-up" data-aos-delay="300">
            <img src="{{ asset('extern/deporivfin.png') }}" alt="Finished Sports Car" class="rounded-xl object-cover w-full aspect-square shadow-md group hover:scale-105 transition-transform duration-300" data-aos="zoom-in-up" data-aos-delay="400">
            <img src="{{ asset('extern/mercedesfin.png') }}" alt="Finished Mercedes" class="rounded-xl object-cover w-full aspect-square shadow-md group hover:scale-105 transition-transform duration-300" data-aos="zoom-in-up" data-aos-delay="500">
        </div>

        <div x-show="activeTab === 'shampoo'" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300 absolute inset-0" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 grid-flow-row-dense">
             <div @click="currentVideoUrl = '{{ asset('extern/tesla-lavado.mp4') }}'; playModalVideo()" class="col-span-2 row-span-2 relative rounded-xl overflow-hidden cursor-pointer group aspect-[16/10] shadow-lg" data-aos="zoom-in-up" data-aos-delay="100">
                <img src="{{ asset('media/presentation_video.png') }}" alt="Tesla Washing Main Video" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                <div class="absolute inset-0 bg-black/30 group-hover:bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                   <svg class="w-16 h-16 text-sky-300 group-hover:text-sky-200 transform group-hover:scale-110 transition-all duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm14.024-.983a1.125 1.125 0 0 1 0 1.966l-5.625 3.125A1.125 1.125 0 0 1 9 15.125V8.875c0-.87.988-1.406 1.65-.983l5.625 3.125Z" /></svg>
                </div>
            </div>
            <img src="{{ asset('during/jeepsinbg.png') }}" alt="Jeep During Shampoo" class="rounded-xl object-cover w-full aspect-square shadow-md group hover:scale-105 transition-transform duration-300" data-aos="zoom-in-up" data-aos-delay="200">
            <img src="{{ asset('during/fullshampoo.png') }}" alt="Full Shampoo Process" class="rounded-xl object-cover w-full aspect-square shadow-md group hover:scale-105 transition-transform duration-300" data-aos="zoom-in-up" data-aos-delay="300">
            <img src="{{ asset('during/autoFullshampoo.png') }}" alt="Car Full Shampoo" class="rounded-xl object-cover w-full aspect-square shadow-md group hover:scale-105 transition-transform duration-300" data-aos="zoom-in-up" data-aos-delay="400">
            <img src="{{ asset('during/shampopersona.png') }}" alt="Technician Shampooing" class="rounded-xl object-cover w-full aspect-square shadow-md group hover:scale-105 transition-transform duration-300" data-aos="zoom-in-up" data-aos-delay="500">
        </div>

        <div x-show="activeTab === 'opendoors'" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300 absolute inset-0" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 grid-flow-row-dense">
            <img src="{{ asset('openDoor/opendoor1.jpg') }}" alt="Open Door View 1" class="col-span-2 md:col-span-1 rounded-xl object-cover w-full aspect-square shadow-md group hover:scale-105 transition-transform duration-300" data-aos="zoom-in-up" data-aos-delay="100">
            <img src="{{ asset('openDoor/porcheopen.jpg') }}" alt="Porsche Open Doors" class="rounded-xl object-cover w-full aspect-square shadow-md group hover:scale-105 transition-transform duration-300" data-aos="zoom-in-up" data-aos-delay="200">
            <img src="{{ asset('openDoor/lamboopendoor.jpg') }}" alt="Lamborghini Open Doors" class="rounded-xl object-cover w-full aspect-square shadow-md group hover:scale-105 transition-transform duration-300" data-aos="zoom-in-up" data-aos-delay="300">
            <img src="{{ asset('openDoor/toyoyaopen.jpg') }}" alt="Toyota Open Doors" class="rounded-xl object-cover w-full aspect-square shadow-md group hover:scale-105 transition-transform duration-300" data-aos="zoom-in-up" data-aos-delay="400">
        </div>
      </div>
    </div>
  </div>

  {{-- Video Modal --}}
  <div x-show="showVideoModal" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/85 backdrop-blur-md flex items-center justify-center z-[9999] p-4" @click="closeVideoModal()">
    <div class="bg-slate-900/70 p-1.5 sm:p-2 rounded-xl shadow-2xl w-full max-w-xl lg:max-w-3xl xl:max-w-4xl border border-slate-700/80" @click.stop>
      <div class="relative aspect-video">
        <video x-ref="modalPlayer" src="" controls class="w-full h-full rounded-lg" playsinline></video>
        <button @click="closeVideoModal()" aria-label="Close video player" class="absolute -top-3.5 -right-3.5 sm:top-1.5 sm:right-1.5 md:-top-2 md:-right-2 text-slate-300 bg-slate-800 rounded-full p-1.5 hover:text-sky-400 focus:outline-none z-10 transition-all duration-200 hover:bg-slate-700">
          <svg class="w-6 h-6 sm:w-7 sm:h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>
</section>

<section id="Case" class="bg-black text-slate-200 py-16 md:py-20">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12 md:mb-16">
      <h3 class="text-4xl sm:text-5xl font-black text-sky-400" data-aos="fade-up">OUR WORKS</h3>
      <div class="w-20 h-1.5 bg-sky-500 mx-auto mt-4 mb-6 rounded-full" data-aos="fade-up" data-aos-delay="100"></div>
      <p class="text-lg text-slate-400 max-w-xl mx-auto" data-aos="fade-up" data-aos-delay="200">
        Witness the stunning transformations we deliver. Hover over images to see the magic.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 xl:gap-10">

      {{-- Caso de Estudio 1: Piso --}}
      <div x-data="{ isAfter: false }" @mouseenter="isAfter = true" @mouseleave="isAfter = false"
        class="relative aspect-[4/3] rounded-xl overflow-hidden shadow-2xl shadow-sky-900/20 group cursor-pointer ring-1 ring-slate-700/50 hover:ring-sky-500/70 transition-shadow"
        data-aos="fade-up" data-aos-anchor-placement="top-bottom">

        <img src="{{ asset('after-before/beforePiso.jpg') }}" alt="Floor Before"
          class="w-full h-full object-cover transition-all duration-700 ease-in-out origin-center"
          :class="{ 'opacity-0 scale-105 blur-sm': isAfter, 'opacity-100 scale-100 blur-none': !isAfter }">

        <img src="{{ asset('after-before/afterPiso3.jpg') }}" alt="Floor After"
          class="absolute inset-0 w-full h-full object-cover transition-all duration-700 ease-in-out origin-center"
          :class="{ 'opacity-100 scale-105 blur-none': isAfter, 'opacity-0 scale-100 blur-sm': !isAfter }">

        <div class="absolute inset-0 p-5 flex flex-col justify-end bg-gradient-to-t from-black/80 via-black/30 to-transparent">
          <h4 class="text-xl font-semibold text-white mb-1 flex items-center">
            Interior Floor Revitalization
            <span class="text-xs px-2.5 py-1 rounded-full ml-3 font-bold transition-all duration-300 ease-in-out"
              :class="isAfter ? 'bg-sky-400 text-slate-900 shadow-md' : 'bg-slate-100 text-slate-700'"
              x-text="isAfter ? 'TRANSFORMED' : 'BEFORE'">
            </span>
          </h4>
          <p x-show="isAfter" x-transition:enter="transition ease-out duration-500 delay-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="text-sm text-sky-200">Grime and wear vanished, revealing a pristine floor.</p>
        </div>
      </div>

      {{-- Caso de Estudio 2: Exterior Frontal --}}
      <div x-data="{ isAfter: false }" @mouseenter="isAfter = true" @mouseleave="isAfter = false"
        class="relative aspect-[4/3] rounded-xl overflow-hidden shadow-2xl shadow-sky-900/20 group cursor-pointer ring-1 ring-slate-700/50 hover:ring-sky-500/70 transition-shadow"
        data-aos="fade-up" data-aos-delay="150" data-aos-anchor-placement="top-bottom">

        <img src="{{ asset('after-before/beforeExtern.jpg') }}" alt="Exterior Front Before"
          class="w-full h-full object-cover transition-all duration-700 ease-in-out origin-center"
          :class="{ 'opacity-0 scale-105 blur-sm': isAfter, 'opacity-100 scale-100 blur-none': !isAfter }">

        <img src="{{ asset('after-before/frontAfter.jpg') }}" alt="Exterior Front After"
          class="absolute inset-0 w-full h-full object-cover transition-all duration-700 ease-in-out origin-center"
          :class="{ 'opacity-100 scale-105 blur-none': isAfter, 'opacity-0 scale-100 blur-sm': !isAfter }">

        <div class="absolute inset-0 p-5 flex flex-col justify-end bg-gradient-to-t from-black/80 via-black/30 to-transparent">
          <h4 class="text-xl font-semibold text-white mb-1 flex items-center">
            Frontal Shine Restoration
            <span class="text-xs px-2.5 py-1 rounded-full ml-3 font-bold transition-all duration-300 ease-in-out"
              :class="isAfter ? 'bg-sky-400 text-slate-900 shadow-md' : 'bg-slate-100 text-slate-700'"
              x-text="isAfter ? 'GLEAMING' : 'BEFORE'">
            </span>
          </h4>
          <p x-show="isAfter" x-transition:enter="transition ease-out duration-500 delay-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="text-sm text-sky-200">Deep gloss and clarity restored to the paintwork.</p>
        </div>
      </div>

      {{-- Caso de Estudio 3: Cabina --}}
      <div x-data="{ isAfter: false }" @mouseenter="isAfter = true" @mouseleave="isAfter = false"
        class="relative aspect-[4/3] rounded-xl overflow-hidden shadow-2xl shadow-sky-900/20 group cursor-pointer ring-1 ring-slate-700/50 hover:ring-sky-500/70 transition-shadow"
        data-aos="fade-up" data-aos-delay="300" data-aos-anchor-placement="top-bottom">

        <img src="{{ asset('after-before/beforePiso2.jpg') }}" alt="Cabin Before"
          class="w-full h-full object-cover transition-all duration-700 ease-in-out origin-center"
          :class="{ 'opacity-0 scale-105 blur-sm': isAfter, 'opacity-100 scale-100 blur-none': !isAfter }">

        <img src="{{ asset('after-before/cabinAfter.jpg') }}" alt="Cabin After"
          class="absolute inset-0 w-full h-full object-cover transition-all duration-700 ease-in-out origin-center"
          :class="{ 'opacity-100 scale-105 blur-none': isAfter, 'opacity-0 scale-100 blur-sm': !isAfter }">

        <div class="absolute inset-0 p-5 flex flex-col justify-end bg-gradient-to-t from-black/80 via-black/30 to-transparent">
          <h4 class="text-xl font-semibold text-white mb-1 flex items-center">
            Cabin Detailing
            <span class="text-xs px-2.5 py-1 rounded-full ml-3 font-bold transition-all duration-300 ease-in-out"
              :class="isAfter ? 'bg-sky-400 text-slate-900 shadow-md' : 'bg-slate-100 text-slate-700'"
              x-text="isAfter ? 'IMPECCABLE' : 'BEFORE'">
            </span>
          </h4>
          <p x-show="isAfter" x-transition:enter="transition ease-out duration-500 delay-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="text-sm text-sky-200">Every nook and cranny cleaned to perfection.</p>
        </div>
      </div>

    </div>

    {{-- Call to Action --}}
    <div class="text-center mt-16 md:mt-20" data-aos="fade-up" data-aos-delay="300">
      <a href="/services"
        class="inline-block px-10 py-4 bg-sky-500 text-white font-semibold uppercase rounded-lg shadow-lg shadow-sky-500/40
               transform transition-all duration-300 ease-in-out
               hover:bg-sky-600 hover:scale-105 hover:shadow-sky-400/60 active:scale-95
               focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 focus:ring-offset-black text-base sm:text-lg">
        Book Your Transformation
      </a>
      <p class="mt-5 text-slate-400">Ready to see your vehicle shine like new? <br class="sm:hidden">Contact us today!</p>
    </div>

  </div>
</section>



<style>
  .line-clamp-1 {
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 1;
  }
  
  .line-clamp-2 {
    overflow: hidden;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
  }
  
  .group:hover {
    transform: translateY(-2px);
    transition: all 0.2s ease;
  }
</style>

<section id="a-la-carte" class="bg-black text-slate-200 py-16 md:py-20 border-t border-slate-800">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-3xl">
    <div class="text-center mb-10 md:mb-12">
      <h2 class="text-3xl sm:text-4xl font-bold text-sky-400" data-aos="fade-up">
        Carte Services
      </h2>
      <p class="mt-3 text-md text-slate-400" data-aos="fade-up" data-aos-delay="100">
        Customize your detailing package with these add-ons.
      </p>
    </div>

    <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-2xl shadow-2xl shadow-sky-900/20 p-6 md:p-8" data-aos="fade-up" data-aos-delay="200">
      <h4 class="text-xl font-semibold text-slate-100 mb-6 text-center sm:text-left">
        Enhance Your Clean (Prices Starting At):
      </h4>
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4">
        <div class="flex justify-between items-center border-b border-slate-700 py-3"><span class="text-slate-200">Aquapel Glass Treatment</span><span class="font-semibold text-sky-400">$30</span></div>
        <div class="flex justify-between items-center border-b border-slate-700 py-3"><span class="text-slate-200">Leather Treatment</span><span class="font-semibold text-sky-400">$30</span></div>
        <div class="flex justify-between items-center border-b border-slate-700 py-3"><span class="text-slate-200">Engine Dress</span><span class="font-semibold text-sky-400">$25</span></div>
        <div class="flex justify-between items-center border-b border-slate-700 py-3"><span class="text-slate-200">Spray Wax</span><span class="font-semibold text-sky-400">$15</span></div>
      </div>
    </div>

    <div class="text-center mt-10 md:mt-12" data-aos="fade-up" data-aos-delay="300">
      <a href="/services"
        class="inline-block px-8 py-3.5 bg-sky-500 text-white uppercase font-bold rounded-lg shadow-lg shadow-sky-500/30
               transform transition-all duration-300 ease-in-out
               hover:bg-sky-600 hover:scale-105 active:scale-95
               focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 focus:ring-offset-black text-base">
        Add to Your Service
      </a>
    </div>
  </div>
</section>


<section id="customer-reviews" class="bg-black text-slate-200 py-16 md:py-20 border-t border-slate-800" x-data="{ current: 0, reviews: 5 }" x-init="setInterval(() => { current = (current + 1) % reviews }, 7000)">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12 md:mb-16">
      <h2 class="text-4xl sm:text-5xl font-bold text-sky-400" data-aos="fade-up">
        What Our Clients Say
      </h2>
      <p class="mt-4 text-lg text-slate-400 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
        We take pride in providing exceptional service. Here's what some of our happy customers have to say about SUMACC.
      </p>
    </div>

    <div class="relative overflow-hidden">
      <div class="flex transition-transform duration-700 ease-in-out"
        :style="'transform: translateX(-' + (current * 100) + '%)'"
        style="width: 500%">
        <template x-for="(review, index) in [
          {
            name: 'Marrisa Mora',
            date: '2 Weeks Ago',
            text: 'My Rav4 had needed a deep clean since I moved to Seattle six months ago. I found Sumacc this morning and reached out to ask about pricing and availability. Super happy I did!'
          },
          {
            name: 'Yung Thach',
            date: '1 Month Ago',
            text: 'I contacted Sumacc on WhatsApp and got a fast reply. He came the same day and did a great job. I just needed one area cleaned where my cat had an accident. No more smell!'
          },
          {
            name: 'Rietta S',
            date: '3 Days Ago',
            text: 'Got my car fully detailed today and it looks amazing. It was a big job and he was very thorough. He arrived on time and I’ve already scheduled our second vehicle for Friday!'
          },
          {
            name: 'H',
            date: '1 Week Ago',
            text: 'Great service! Second time I used them to hand wash my car interior and exterior (first time to get rid of vomit smell as well)... They came to my place on time and they finished in 2 hrs. Car looks and smells great both times.'
          },
          {
            name: 'Lindsay S',
            date: '1 Day Ago',
            text: 'Got me in same day. They did an excellent job restoring my car to a like-new condition despite the many crumbs and spills left by my kids.'
          }
        ]" :key="index">
          <div class="min-w-full px-4">
            <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-2xl shadow-2xl shadow-sky-900/20 p-6 flex flex-col h-full">
              <div class="mb-4">
                <h5 class="font-semibold text-slate-100" x-text="review.name"></h5>
                <p class="text-xs text-slate-500" x-text="review.date"></p>
              </div>
              <div class="flex items-center mb-3">
                <template x-for="i in 5">
                  <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                  </svg>
                </template>
              </div>
              <p class="text-slate-300 leading-relaxed text-sm flex-grow" x-text="review.text"></p>
            </div>
          </div>
        </template>
      </div>
    </div>

    <div class="flex justify-center gap-2 mt-6">
      <template x-for="(dot, i) in reviews" :key="i">
        <button @click="current = i"
          class="w-3 h-3 rounded-full"
          :class="current === i ? 'bg-sky-400' : 'bg-slate-600'"></button>
      </template>
    </div>

    <div class="text-center mt-12 md:mt-16" data-aos="fade-up" data-aos-delay="500">
      <a href="https://g.co/kgs/NJo3rQr" target="_blank" rel="noopener noreferrer"
        class="inline-block px-8 py-3.5 bg-transparent border-2 border-sky-500 text-sky-400 text-sm font-semibold uppercase rounded-lg
               transform transition-all duration-300 ease-in-out
               hover:bg-sky-500 hover:text-black hover:shadow-lg hover:shadow-sky-500/30 active:scale-95">
        Read More Reviews on Google
      </a>
    </div>
  </div>
</section>


<section id="quality-products" class="bg-black text-slate-200 py-16 md:py-20 border-t border-slate-800">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-5xl">
    <div class="text-center mb-10 md:mb-12">
      <h2 class="text-3xl sm:text-4xl font-bold text-sky-400" data-aos="fade-up">
        We Use Quality Products
      </h2>
      <div class="flex items-center justify-center space-x-2 mt-3" data-aos="fade-up" data-aos-delay="100">
        <span class="text-yellow-400 text-2xl">★</span>
        <p class="text-slate-400 text-md">Premium Brands for Your Vehicle's Optimal Care</p>
      </div>
    </div>

    <div class="bg-slate-800/70 backdrop-blur-sm border border-slate-700 rounded-2xl shadow-2xl shadow-sky-900/20 p-6 md:p-8" data-aos="fade-up" data-aos-delay="200">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-6">
        @php
        $products = [
        ['brand' => 'Meguiar’s', 'desc' => 'Excellent for cleaning and protection.'],
        ['brand' => 'Chemical Guys', 'desc' => 'Innovative formulas for detailing and finishes.'],
        ['brand' => 'Griot’s Garage', 'desc' => 'Quality and ease of use in waxes and polishes.'],
        ['brand' => 'Turtle Wax', 'desc' => 'Reliable and affordable with great durability.'],
        ['brand' => 'Sonax', 'desc' => 'Effective in cleaning and paint protection.'],
        ['brand' => 'Adam’s Polishes', 'desc' => 'Premium products ideal for enthusiasts.'],
        ['brand' => '3M', 'desc' => 'Solutions for surface finishing and protection.'],
        ['brand' => 'CarPro', 'desc' => 'Innovative in long-lasting ceramic protection.'],
        ['brand' => 'Gtechniq', 'desc' => 'Long-term ceramic coatings.'],
        ['brand' => 'Rupes', 'desc' => 'High-quality polishing tools.'],
        ['brand' => 'P&S Detail Products', 'desc' => 'Commercial-grade products for professionals.'],
        ['brand' => 'Zaino', 'desc' => 'Durable protection and shine for vehicles.']
        ];
        @endphp

        @foreach ($products as $index => $product)
        <div class="p-1 group" data-aos="fade-up" data-aos-delay="{{ 100 + ($index % 3) * 100 }}">
          <h5 class="text-lg font-semibold text-sky-300 group-hover:text-sky-200 transition-colors">{{ $product['brand'] }}</h5>
          <p class="text-sm text-slate-400 leading-relaxed mt-1">{{ $product['desc'] }}</p>
        </div>
        @endforeach
      </div>
    </div>

    <div class="mt-10 md:mt-12 text-center" data-aos="fade-up" data-aos-delay="300">
      <h3 class="text-2xl font-semibold text-slate-100 mb-2">
        Our Commitment to Quality
      </h3>
      <p class="text-slate-400 max-w-2xl mx-auto leading-relaxed">
        We are dedicated to using only high-quality, industry-leading products that protect your investment and enhance the beauty and shine of your vehicle for lasting results.
      </p>
    </div>
  </div>
</section>

<section id="contact" class="bg-black text-slate-200 py-16 md:py-20 overflow-x-hidden overflow-y-hidden">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12 md:mb-16">
      <h2 class="text-4xl sm:text-5xl font-bold text-sky-400" data-aos="fade-up">Get In Touch</h2>
      <p class="mt-4 text-lg text-slate-400 max-w-xl mx-auto" data-aos="fade-up" data-aos-delay="100">
        We're here to answer your questions or schedule your next premium detailing service.
      </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 xl:gap-12 items-stretch">
      <div class="bg-slate-800/60 backdrop-blur-sm border border-slate-700 rounded-2xl shadow-2xl shadow-sky-900/20 overflow-hidden min-h-[26rem] sm:min-h-[30rem] lg:h-full flex flex-col" data-aos="fade-right" data-aos-duration="800">
        <div class="bg-slate-700/70 py-2">
          <p class="text-center text-sky-300 font-semibold">Renton Office<br><span class="text-sm text-slate-200">11925 SE 175th St, Renton, WA 98058</span></p>
        </div>
        <iframe
          src="https://maps.google.com/maps?q=11925%20SE%20175th%20St%2C%20Renton%2C%20WA%2098058%2C%20United%20States&output=embed"
          class="w-full flex-1 border-0 filter grayscale-[40%] invert-[95%] contrast-[90%]"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          title="Renton Location">
        </iframe>

        <div class="h-px bg-slate-700/50"></div>

        <div class="bg-slate-700/70 py-2">
          <p class="text-center text-sky-300 font-semibold">Bellevue Office<br><span class="text-sm text-slate-200">10621 NE 12th St, Bellevue, WA 98004</span></p>
        </div>
        <iframe
          src="https://maps.google.com/maps?q=10621%20NE%2012th%20St%2C%20Bellevue%2C%20WA%2098004%2C%20United%20States&output=embed"
          class="w-full flex-1 border-0 filter grayscale-[40%] invert-[95%] contrast-[90%]"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"
          title="Bellevue Location">
        </iframe>
      </div>

      <div class="bg-slate-800/60 backdrop-blur-sm border border-slate-700 rounded-2xl shadow-2xl shadow-sky-900/20 p-6 md:p-8 flex flex-col" data-aos="fade-left" data-aos-duration="800" data-aos-delay="150">
        <div>
          <h3 class="text-3xl font-bold text-sky-400 mb-2">Contact Information</h3>
          <p class="mb-6 text-slate-400">Reach out through your preferred channel or send us a message below.</p>

          <div class="space-y-4 mb-6 text-slate-300">
            <a href="mailto:customer@sumacccarwash.com" class="flex items-center group">
              <svg class="w-6 h-6 text-sky-400 group-hover:text-sky-300 mr-3 transition-colors shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
              </svg>
              <span class="group-hover:text-sky-300 transition-colors">customer@sumacccarwash.com</span>
            </a>
            <a href="tel:+14258761729" class="flex items-center group">
              <svg class="w-6 h-6 text-sky-400 group-hover:text-sky-300 mr-3 transition-colors shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.308 1.538a11.037 11.037 0 005.334 5.334l1.538-2.308a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
              </svg>
              <span class="group-hover:text-sky-300 transition-colors">+1 (425) 876-1729</span>
            </a>
          </div>

          <div class="flex space-x-4 mb-8">
            <a href="https://www.facebook.com/profile.php?id=61565425006563" target="_blank" rel="noopener noreferrer" class="text-slate-400 hover:text-sky-400 transition-colors" title="Facebook">
              <img src="SocialNetsIcon/Facebook.png" class="h-6 w-6" alt="">
            </a>
            <a href="https://www.instagram.com/sumacc495/" target="_blank" rel="noopener noreferrer" class="text-slate-400 hover:text-sky-400 transition-colors" title="Instagram">
              <img src="SocialNetsIcon/instagram.png" class="h-6 w-6" alt="">
            </a>
            <a href="https://wa.link/gemzk6" target="_blank" rel="noopener noreferrer" class="text-slate-400 hover:text-sky-400 transition-colors" title="WhatsApp">
              <img src="SocialNetsIcon/whatssapp.png" class="h-6 w-6" alt="">
            </a>
            <a href="https://www.tiktok.com/@sumaccmobiledetailing" target="_blank" rel="noopener noreferrer" class="text-slate-400 hover:text-sky-400 transition-colors" title="TikTok">
              <img src="SocialNetsIcon/tiktok.png" class="h-6 w-6" alt="">
            </a>
          </div>

          <div class="mb-8 pt-6 border-t border-slate-700/50">
            <h4 class="text-xl font-semibold text-slate-100 mb-3">We Proudly Serve:</h4>
            <div class="flex flex-wrap gap-2.5">
              @foreach (['Everett, WA', 'Redmond, WA', 'Seattle, WA', 'Bellevue, WA', 'Kirkland, WA', 'Lynnwood, WA'] as $area)
                <span class="bg-slate-700 text-sky-300 px-3.5 py-1.5 rounded-full text-sm font-medium hover:bg-sky-500 hover:text-white transition-colors cursor-default">{{ $area }}</span>
              @endforeach
            </div>
          </div>
        </div>

        <div class="mb-8">
          <h4 class="text-2xl font-bold text-sky-400 mb-2">Our Locations</h4>
          <div class="text-slate-300 space-y-1">
            <p><span class="font-semibold text-sky-300">Renton:</span> 11925 SE 175th St, Renton, WA 98058</p>
            <p><span class="font-semibold text-sky-300">Bellevue:</span> 10621 NE 12th St, Bellevue, WA 98004</p>
          </div>
        </div>

        <div class="flex-grow flex flex-col">
          <form id="contactForm" class="space-y-5 flex-grow flex flex-col" data-aos="fade-up" data-aos-delay="100">
            <div>
              <label for="contact_name" class="block text-sm font-medium text-slate-300 mb-1.5">Full Name</label>
              <input type="text" name="name" id="contact_name" placeholder="e.g., John Doe" required
                class="w-full bg-slate-700 border-slate-600 rounded-lg px-4 py-3 placeholder-slate-500 text-slate-100 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors">
            </div>
            <div>
              <label for="contact_email" class="block text-sm font-medium text-slate-300 mb-1.5">Email Address</label>
              <input type="email" name="email" id="contact_email" placeholder="you@example.com" required
                class="w-full bg-slate-700 border-slate-600 rounded-lg px-4 py-3 placeholder-slate-500 text-slate-100 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors">
            </div>
            <div>
              <label for="contact_phone" class="block text-sm font-medium text-slate-300 mb-1.5">Phone Number <span class="text-xs text-slate-500">(Optional)</span></label>
              <input type="tel" name="phone" id="contact_phone" placeholder="+1 (555) 123-4567"
                class="w-full bg-slate-700 border-slate-600 rounded-lg px-4 py-3 placeholder-slate-500 text-slate-100 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors">
            </div>
            <div>
              <label for="contact_message" class="block text-sm font-medium text-slate-300 mb-1.5">Your Message</label>
              <textarea name="message" id="contact_message" rows="4" placeholder="Tell us how we can help you..." required
                class="w-full bg-slate-700 border-slate-600 rounded-lg px-4 py-3 placeholder-slate-500 text-slate-100 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors"></textarea>
            </div>
            <div class="mt-auto pt-2">
              <button type="submit"
                class="w-full mt-2 bg-sky-500 text-white uppercase font-bold rounded-lg px-6 py-3.5 hover:bg-sky-600 active:scale-95 transition-all duration-200 shadow-lg shadow-sky-500/30 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2 focus:ring-offset-slate-800">
                Send Message
              </button>
              <p class="text-xs text-slate-500 mt-3 text-center">Alternatively, <a href="https://wa.link/gemzk6" target="_blank" rel="noopener noreferrer" class="text-sky-400 hover:underline font-medium">chat with us on WhatsApp</a>.</p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>



@endsection