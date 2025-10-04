<header
  x-data="{ scrolled: false, open: false, activeSection: '', hoveredLink: '' }"
  x-init="
    window.addEventListener('scroll', () => { scrolled = window.pageYOffset > 50 });
    let sections = document.querySelectorAll('section[id]');
    window.addEventListener('scroll', () => {
      let current = '';
      sections.forEach(section => {
        const sectionTop = section.offsetTop - 100;
        if (pageYOffset >= sectionTop) {
          current = '#' + section.getAttribute('id');
        }
      });
      activeSection = current;
    }, { passive: true });
  "
  :class="scrolled ? 'bg-black/80 shadow-xl backdrop-blur-lg py-3' : 'bg-transparent py-4'"
  class="fixed top-0 w-full z-[999] transition-all duration-300 ease-in-out"
  data-aos="fade-down" data-aos-duration="700"
>
  <div class="container mx-auto flex items-center justify-between px-4 sm:px-6 transition-all duration-300 ease-in-out">

    {{-- Logo --}}
    <a
      href="{{ route('public.index') }}"
      class="flex items-center gap-2"
      data-aos="fade-right"
      data-aos-delay="100"
      data-aos-duration="700"
    >
      <img
        src="{{ asset('logo/logoSumacc.png') }}"
        alt="SUMACC Logo"
        class="h-6 w-6 md:h-10 md:w-10 transition-all duration-300"
      />
      <div class="flex flex-col leading-tight">
        <span class="text-xl md:text-2xl font-extrabold text-sky-500">SUMACC</span>
        <span
          class="text-xs font-medium text-slate-300 mt-0"
          :class="scrolled ? 'text-slate-400' : 'text-slate-300'"
        >
          Luxe Mobile Wash LLC
        </span>
      </div>
    </a>

    {{-- Nav Desktop --}}
    <nav class="hidden md:flex items-center gap-6 lg:gap-8 uppercase font-medium tracking-wider">
      {{-- Home --}}
      <a
        href="{{ route('public.index') }}"
        @mouseenter="hoveredLink = '#hero'"
        @mouseleave="hoveredLink = ''"
        class="relative text-sm group transition-colors duration-200"
        :class="scrolled
          ? (activeSection === '#hero' ? 'text-sky-400' : 'text-slate-200 hover:text-sky-300')
          : (activeSection === '#hero' ? 'text-sky-400' : 'text-slate-100 hover:text-white')"
        data-aos="fade-down" data-aos-duration="700" data-aos-delay="200"
      >
        <span>Home</span>
        <span
          class="absolute left-0 -bottom-1.5 h-0.5 bg-sky-400 transition-all duration-300 ease-out"
          :style="(activeSection === '#hero' || hoveredLink === '#hero') ? 'width: 100%' : 'width: 0%'"
        ></span>
      </a>

      {{-- Categorías de Servicios --}}
      @foreach($headerData['serviceCategories'] as $index => $category)
      @php
        $categoryId = 'category-' . $category->id;
      @endphp
      <a
        href="{{ route('public.services.category', $category->slug) }}"
        @mouseenter="hoveredLink = '{{ $categoryId }}'"
        @mouseleave="hoveredLink = ''"
        class="relative text-sm group transition-colors duration-200"
        :class="scrolled
          ? (activeSection === '#services' ? 'text-sky-400' : 'text-slate-200 hover:text-sky-300')
          : (activeSection === '#services' ? 'text-sky-400' : 'text-slate-100 hover:text-white')"
        data-aos="fade-down" data-aos-duration="700" data-aos-delay="{{ 250 + ($index * 50) }}"
      >
        <span>{{ $category->name }}</span>
        <span
          class="absolute left-0 -bottom-1.5 h-0.5 bg-sky-400 transition-all duration-300 ease-out"
          :style="(hoveredLink === '{{ $categoryId }}') ? 'width: 100%' : 'width: 0%'"
        ></span>
      </a>
      @endforeach

      {{-- Contact --}}
      <a
        href="/#contact"
        @mouseenter="hoveredLink = '#contact'"
        @mouseleave="hoveredLink = ''"
        class="relative text-sm group transition-colors duration-200"
        :class="scrolled
          ? (activeSection === '#contact' ? 'text-sky-400' : 'text-slate-200 hover:text-sky-300')
          : (activeSection === '#contact' ? 'text-sky-400' : 'text-slate-100 hover:text-white')"
        data-aos="fade-down" data-aos-duration="700" data-aos-delay="{{ 350 + (count($headerData['serviceCategories']) * 50) }}"
      >
        <span>Contact</span>
        <span
          class="absolute left-0 -bottom-1.5 h-0.5 bg-sky-400 transition-all duration-300 ease-out"
          :style="(activeSection === '#contact' || hoveredLink === '#contact') ? 'width: 100%' : 'width: 0%'"
        ></span>
      </a>
    </nav>

    {{-- CTA Desktop - Book Now --}}
    <div class="hidden lg:flex items-center">
      <a
        href="{{ route('public.services') }}"
        class="py-2.5 px-6 rounded-full text-sm font-bold transition-all transform duration-300 ease-in-out shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-black bg-emerald-500 hover:bg-emerald-400 text-white hover:scale-105 ring-emerald-500"
        data-aos="fade-left" data-aos-duration="700" data-aos-delay="400"
      >
        Book Now
      </a>
    </div>

    {{-- Hamburger Mobile --}}
    <button
      @click="open = !open"
      class="md:hidden focus:outline-none z-20"
      :class="open || !scrolled ? 'text-white' : 'text-slate-200'"
      aria-label="Open menu"
    >
      <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" :d="open ? 'M6 18L18 6M6 6l12 12' : 'M4 6h16M4 12h16M4 18h16'" />
      </svg>
    </button>
  </div>

  {{-- Mobile Menu --}}
  <div
    x-show="open"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform -translate-y-full"
    x-transition:enter-end="opacity-100 transform translate-y-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform -translate-y-full"
    class="md:hidden absolute top-0 inset-x-0 min-h-screen bg-black/95 backdrop-blur-lg pt-[calc(var(--header-height,4rem)+2rem)] pb-8"
    @click.away="open = false"
    style="--header-height: 4rem;"
    x-cloak
  >
    <ul class="flex flex-col items-center gap-y-5 text-center uppercase text-base tracking-wider">
      {{-- Home --}}
      <li x-show="open"
          x-transition:enter="transition ease-out duration-300"
          :style="{ transitionDelay: '50ms' }"
          x-transition:enter-start="opacity-0 transform translate-y-3"
          x-transition:enter-end="opacity-100 transform translate-y-0"
          class="w-full">
        <a 
          href="{{ route('public.index') }}"
          class="block font-medium py-2 transition-colors duration-200"
          :class="activeSection === '#hero' ? 'text-sky-400' : 'text-slate-200 hover:text-sky-300'"
          @click="open = false"
        >
          Home
        </a>
      </li>

      {{-- Categorías de Servicios - Versión móvil --}}
      @foreach($headerData['serviceCategories'] as $index => $category)
      <li x-show="open"
          x-transition:enter="transition ease-out duration-300"
          :style="{ transitionDelay: '{{ 100 + ($index * 75) }}ms' }"
          x-transition:enter-start="opacity-0 transform translate-y-3"
          x-transition:enter-end="opacity-100 transform translate-y-0"
          class="w-full">
        <a 
          href="{{ route('public.services.category', $category->slug) }}"
          class="block font-medium py-2 transition-colors duration-200 text-slate-200 hover:text-sky-300"
          @click="open = false"
        >
          {{ $category->name }}
        </a>
      </li>
      @endforeach

      {{-- Contact --}}
      <li x-show="open"
          x-transition:enter="transition ease-out duration-300"
          :style="{ transitionDelay: '{{ 200 + (count($headerData['serviceCategories']) * 75) }}ms' }"
          x-transition:enter-start="opacity-0 transform translate-y-3"
          x-transition:enter-end="opacity-100 transform translate-y-0"
          class="w-full">
        <a 
          href="/#contact"
          class="block font-medium py-2 transition-colors duration-200"
          :class="activeSection === '#contact' ? 'text-sky-400' : 'text-slate-200 hover:text-sky-300'"
          @click="open = false"
        >
          Contact
        </a>
      </li>

      {{-- CTA Button for Mobile --}}
      @php
        $finalDelay = 250 + (count($headerData['serviceCategories']) * 75);
      @endphp
      <li x-show="open"
          x-transition:enter="transition ease-out duration-300"
          :style="{ transitionDelay: '{{ $finalDelay }}ms' }"
          x-transition:enter-start="opacity-0 transform translate-y-3"
          x-transition:enter-end="opacity-100 transform translate-y-0"
          class="pt-4">
        <a
          href="{{ route('public.services') }}"
          class="py-3 px-8 rounded-full font-bold bg-emerald-500 hover:bg-emerald-400 text-white transition-all transform hover:scale-105 duration-300 ease-in-out mx-auto"
          @click="open = false"
        >
          Book Now
        </a>
      </li>
    </ul>
  </div>
</header>