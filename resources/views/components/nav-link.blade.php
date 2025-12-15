@props(['href', 'routeName'])

@php
    $isActive = request()->routeIs($routeName);
    $activeClasses = 'text-blue-600 dark:text-blue-400 text-shadow-active';
    $inactiveClasses = 'hover:text-blue-600 dark:hover:text-blue-400 hover:text-shadow-hover';
@endphp

<a href="{{ $href }}"
    {{ $attributes->class(['transition-colors duration-300', $isActive ? $activeClasses : $inactiveClasses]) }}>
    {{ $slot }}
</a>
