<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Essential SEO and Title --}}
    <title>SUMACC | Professional Mobile Auto Detailing in Seattle & Pacific Northwest</title>
    <meta name="description" content="SUMACC offers expert high-end mobile auto detailing and car wash services in Seattle, Bellevue, Renton, and surrounding areas. We transform your vehicle with meticulous care and premium products." />
    <meta name="keywords" content="Seattle Auto Detailing, Mobile Car Wash Seattle, Car Detailing Bellevue, SUMACC, Ceramic Coating Renton, Luxury Car Wash, Mobile Auto Spa Pacific Northwest" />
    <meta name="author" content="SUMACC Mobile Auto Detailing" />
    <meta name="robots" content="index,follow" />
    <link rel="canonical" href="{{ url('/') }}" />

    {{-- Google Verification and Analytics --}}
    <meta name="google-site-verification" content="Uz0FLA-2Da98lnyutgJL_-oyJL_SCQfd09Jq4eboAJA" />
    
    {{-- Google Analytics --}}
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-7B9M1NKRDG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'G-7B9M1NKRDG');
    </script>

    {{-- Open Graph / Facebook --}}
    <meta property="og:title" content="SUMACC | Luxury Mobile Auto Detailing in Seattle" />
    <meta property="og:description" content="Premium mobile car detailing delivered to your location. Professional quality and flawless results in Seattle, Bellevue, and the greater Pacific Northwest." />
    <meta property="og:image" content="{{ asset('og-image.jpg') }}" />
    <meta property="og:url" content="{{ url('/') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="SUMACC Mobile Detailing" />
    <meta property="og:locale" content="en_US" />

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="SUMACC | Luxury Mobile Auto Detailing in Seattle" />
    <meta name="twitter:description" content="Premium mobile car detailing delivered to your location. Professional quality and flawless results in Seattle, Bellevue, and the Pacific Northwest." />
    <meta name="twitter:image" content="{{ asset('twitter-card-image.jpg') }}" />

    {{-- Favicon and Theme Color --}}
    <link rel="icon" href="{{ asset('logo/favicon.ico') }}" type="image/ico" />
    <meta name="theme-color" content="#0F172A">

    {{-- Google Fonts - Preload for performance --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

    {{-- Vite Assets (includes Alpine.js and AOS) --}}
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    {{-- Custom Animations --}}
    <style>
        .animate-custom-pulse {
            animation: custom-pulse 2s infinite cubic-bezier(0.4, 0, 0.6, 1);
        }

        @keyframes custom-pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.05); }
        }

        .animate-bounce-custom {
            animation: bounce-custom 1.5s infinite;
        }

        @keyframes bounce-custom {
            0%, 100% { transform: translateY(-8%); animation-timing-function: cubic-bezier(0.8, 0, 1, 1); }
            50% { transform: translateY(0); animation-timing-function: cubic-bezier(0, 0, 0.2, 1); }
        }

        {{-- Prevent FOUC (Flash of Unstyled Content) --}}
        [x-cloak] { 
            display: none !important; 
        }

        {{-- Loading spinner --}}
        .loading-spinner {
            border: 2px solid #f3f3f3;
            border-top: 2px solid #3498db;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>

<body class="bg-black text-slate-300 font-['Lexend_Deca'] antialiased">

    @include('components.header')

    <main id="main-content">
        @yield('content')
    </main>

    @include('components.footer')

    {{-- Floating Action Buttons --}}
    <div class="fixed bottom-5 right-5 md:bottom-8 md:right-8 flex flex-col items-center space-y-4 z-[990]">

        {{-- WhatsApp --}}
        <div class="relative group" data-aos="fade-left" data-aos-delay="500" data-aos-offset="0">
            <a href="https://wa.link/gemzk6" 
               target="_blank" 
               rel="noopener noreferrer" 
               aria-label="Chat on WhatsApp"
               class="flex items-center justify-center p-3 bg-[#25D366] rounded-full shadow-xl hover:shadow-2xl hover:bg-green-500 transition-all duration-300 transform hover:scale-110 active:scale-95 animate-bounce-custom focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-black focus:ring-green-400">
                <img src="{{ asset('SocialNetsIcon/whatssapp.png') }}" alt="WhatsApp" class="w-11 h-11" loading="lazy">
            </a>
            <span class="absolute right-full top-1/2 -translate-y-1/2 mr-3 px-3 py-1.5 bg-slate-700 text-white text-xs font-semibold rounded-md shadow-lg 
                       opacity-0 group-hover:opacity-100 transition-all duration-200 ease-in-out whitespace-nowrap pointer-events-none 
                       hidden md:block">
                Chat on WhatsApp
            </span>
        </div>

        {{-- SMS --}}
        <div class="relative group" data-aos="fade-left" data-aos-delay="700" data-aos-offset="0">
            <a href="sms:+14258761729?body=I'm interested in getting a mobile detailing service for my vehicle. Could you provide more details on your services and pricing?" 
               aria-label="Send SMS"
               class="flex items-center justify-center p-3 bg-orange-500 rounded-full shadow-xl hover:shadow-2xl hover:bg-orange-600 transition-all duration-300 transform hover:scale-110 active:scale-95 animate-bounce-custom"
               style="animation-delay: 0.3s;">
                <img src="{{ asset('SocialNetsIcon/sms.png') }}" alt="SMS" class="w-11 h-11" loading="lazy">
            </a>
            <span class="absolute right-full top-1/2 -translate-y-1/2 mr-3 px-3 py-1.5 bg-slate-700 text-white text-xs font-semibold rounded-md shadow-lg 
                       opacity-0 group-hover:opacity-100 transition-all duration-200 ease-in-out whitespace-nowrap pointer-events-none 
                       hidden md:block">
                Send an SMS
            </span>
        </div>
    </div>

    {{-- Global error handling for debugging --}}
    @if(config('app.debug'))
    <script>
        window.addEventListener('error', function(e) {
            console.error('Global error:', e.error);
        });
        
        window.addEventListener('unhandledrejection', function(e) {
            console.error('Unhandled promise rejection:', e.reason);
        });
    </script>
    @endif

</body>
</html>