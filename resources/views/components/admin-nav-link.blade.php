@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-4 py-3 text-white bg-blue-700 rounded-lg transition-colors duration-200'
            : 'flex items-center px-4 py-3 text-blue-200 hover:text-white hover:bg-blue-800 rounded-lg transition-colors duration-200';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>