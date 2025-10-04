<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Essential SEO and Title --}}
    <title>SUMACC | Mobile Auto Detailing in Seattle & Pacific Northwest | Book Now</title>
    <meta name="description" content="SUMACC offers expert mobile auto detailing and car wash services in Seattle, Bellevue, Renton, and the Pacific Northwest. Premium care, flawless results. Book your appointment today!" />
    <meta name="keywords" content="Seattle Auto Detailing, Mobile Car Wash Seattle, Car Detailing Bellevue, SUMACC, Ceramic Coating Renton, Mobile Auto Spa, Pacific Northwest" />
    <meta name="author" content="SUMACC Mobile Auto Detailing" />
    <link rel="canonical" href="{{ url('/') }}" />

    {{-- Standard Robots Tag (Implied 'index,follow' is default, but explicit for safety) --}}
    <meta name="robots" content="index,follow" />

    {{-- Favicon and Theme Color (Ensure 'logo/sumacc-logo.svg' is the correct path) --}}
    <link rel="icon" href="{{ asset('logo/logoSumacc.png') }}" type="image/png" />
    <link rel="shortcut icon" href="{{ asset('logo/favicon.ico') }}" type="image/x-icon" />
    <meta name="theme-color" content="#0F172A">


    {{-- Open Graph (Facebook/LinkedIn) - Key tags only --}}
    <meta property="og:title" content="SUMACC | Luxury Mobile Auto Detailing in Seattle" />
    <meta property="og:description" content="Premium mobile car detailing delivered to your location. Professional quality and flawless results in Seattle and the greater Pacific Northwest." />
    <meta property="og:image" content="{{ asset('og-image.jpg') }}" />
    <meta property="og:url" content="{{ url('/') }}" />
    <meta property="og:type" content="website" />

    {{-- Twitter Card - Key tags only --}}
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="SUMACC | Luxury Mobile Auto Detailing in Seattle" />
    <meta name="twitter:image" content="{{ asset('twitter-card-image.jpg') }}" />

    {{-- Google Analytics (Keep this if you need it) --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-7B9M1NKRDG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-7B9M1NKRDG');
    </script>
    {{-- Google Verification (Keep this if necessary, but can be done via Search Console file upload too) --}}
    <meta name="google-site-verification" content="Uz0FLA-2Da98lnyutgJL_-oyJL_SCQfd09Jq4eboAJA" />


    {{-- Google Fonts - Preload for performance --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

    {{-- Vite Assets (includes Alpine.js and AOS) --}}
    @vite([
    'resources/css/app.css',
    'resources/js/app.js'
    ])

    {{-- Custom Animations & FOUC Prevention (Essential for design) --}}
    <style>
        .animate-custom-pulse {
            animation: custom-pulse 2s infinite cubic-bezier(0.4, 0, 0.6, 1);
        }

        @keyframes custom-pulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.8;
                transform: scale(1.05);
            }
        }

        .animate-bounce-custom {
            animation: bounce-custom 1.5s infinite;
        }

        @keyframes bounce-custom {

            0%,
            100% {
                transform: translateY(-8%);
                animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
            }

            50% {
                transform: translateY(0);
                animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
            }
        }

        /* Prevent FOUC (Flash of Unstyled Content) */
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-black text-slate-300 font-['Lexend_Deca'] antialiased" x-data="{ showBookingModal: false, categories: [] }">

    @include('components.header')

    <main id="main-content">
        @yield('content')
    </main>

    @include('components.footer')

    {{-- Main Booking Pop-up button and Contact buttons --}}
    <div class="fixed bottom-6 right-6 z-50 flex flex-col items-end space-y-3">
        {{-- Botón de "Book Now" que redirige al usuario al selector de servicios --}}
        <a href="#" @click.prevent="showBookingModal = true; if (categories.length === 0) { fetch('/api/categories-for-booking').then(response => response.json()).then(data => categories = data).catch(e => console.error('Error fetching categories:', e)); }" class="flex items-center justify-center w-auto px-6 py-3 rounded-full bg-emerald-500 text-white shadow-lg hover:bg-emerald-600 transition-all transform hover:scale-105 group relative animate-custom-pulse">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            <span class="font-bold uppercase text-sm md:text-base">Book Now</span>
        </a>

        {{-- Botón de SMS --}}
        <a href="sms:+14258761729" class="flex items-center justify-center w-14 h-14 rounded-full bg-emerald-500 text-white shadow-lg hover:bg-emerald-600 transition-all group relative">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            <span class="absolute right-full mr-2 px-2 py-1 bg-emerald-500 text-white text-xs rounded whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity shadow-lg">
                Text Us
            </span>
        </a>

        {{-- Botón de WhatsApp --}}
        <a href="https://wa.link/gemzk6" target="_blank" class="flex items-center justify-center w-14 h-14 rounded-full bg-emerald-500 text-white shadow-lg hover:bg-emerald-600 transition-all group relative">
            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.87 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.864 3.488" />
            </svg>
            <span class="absolute right-full mr-2 px-2 py-1 bg-emerald-500 text-white text-xs rounded whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity shadow-lg">
                Chat with us
            </span>
        </a>
    </div>

    {{-- Booking Categories Modal (Kept for functionality) --}}
    <div x-show="showBookingModal" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" class="fixed inset-0 z-[10000] flex items-center justify-center p-4">
        <div @click="showBookingModal = false" class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>
        <div @click.stop class="relative bg-slate-900 border border-slate-700 rounded-2xl shadow-2xl p-6 md:p-10 w-full max-w-md mx-auto transform transition-transform duration-300 ease-out">
            <button @click="showBookingModal = false" class="absolute top-4 right-4 text-slate-400 hover:text-white transition-colors duration-200">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <h3 class="text-3xl md:text-4xl font-extrabold text-white mb-6 text-center">Select a Service Category</h3>
            <div x-show="categories.length === 0" class="text-center text-white py-8">
                <p>Loading categories...</p>
            </div>
            <div x-show="categories.length > 0" class="flex flex-col items-center gap-4">
                <template x-for="category in categories" :key="category.id">
                    {{-- The route name 'public.services.category' is used to generate the URL --}}
                    <a :href="`{{ url('/car-detailing-services') }}/${category.slug}`" @click="showBookingModal = false" class="group w-full max-w-sm flex flex-col items-center text-center p-6 border border-slate-700 rounded-xl hover:bg-slate-800 transition-colors duration-200 ease-in-out transform hover:-translate-y-1">
                        <div class="w-16 h-16 rounded-full bg-slate-800 flex items-center justify-center mb-4 transition-all group-hover:bg-sky-500">
                            <svg class="w-10 h-10 text-slate-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h10M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-white mb-2" x-text="category.name"></h4>
                        <p class="text-xs text-slate-400" x-text="category.description"></p>
                    </a>
                </template>
            </div>
        </div>
    </div>
</body>

</html>