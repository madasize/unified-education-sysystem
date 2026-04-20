@props(['active'])

@php
$classes = ($active ?? false)
            ? 'bg-gray-800 text-white flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg transition-colors'
            : 'text-gray-300 hover:bg-gray-800 hover:text-white flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg transition-colors';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>