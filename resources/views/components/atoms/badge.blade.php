@props(['active' => false, 'href' => '#'])

@php
    $classes = $active 
                ? 'shrink-0 px-4 py-2 rounded-full text-sm font-medium transition-all bg-indigo-500 text-white shadow-lg shadow-indigo-500/20' 
                : 'shrink-0 px-4 py-2 rounded-full text-sm font-medium transition-all bg-slate-900 text-slate-400 hover:bg-slate-800 hover:text-slate-200';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>