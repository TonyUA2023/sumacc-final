<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Suimacc Detailing'))</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Livewire Styles -->
        @livewireStyles
        
        <!-- Font Awesome para íconos -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" xintegrity="sha512-ieo5gqV7I6Jd3Z2m3z3T2W1f8b1Bf/d+s4oPzR+Vz+F4Fz+E+4f8d2z5F+D8C5c6U+k" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Scripts de Vite -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @stack('styles')
    </head>
    <body class="font-sans antialiased bg-gray-100">
        <div class="flex h-screen">
            @include('admin.partials.sidebar')

            <div class="flex-1 flex flex-col overflow-hidden">
                @include('admin.partials.header')

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                    <div class="container mx-auto">
                        @isset($header)
                            <div class="mb-6">
                                <h2 class="text-2xl font-bold text-gray-800">{{ $header }}</h2>
                                <x-breadcrumbs />
                            </div>
                        @endisset

                        @if (session('status'))
                            <div class="alert alert-success mb-6 p-4 bg-green-100 text-green-700 rounded-lg">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        @if (session('error'))
                            <div class="alert alert-error mb-6 p-4 bg-red-100 text-red-700 rounded-lg">
                                {{ session('error') }}
                            </div>
                        @endif

                        @yield('content')
                        
                    </div>
                </main>
            </div>
        </div>

        <!-- Livewire Scripts -->
        @livewireScripts
        
        @stack('scripts')
    </body>
</html>
