@props(['active' => false, 'href' => '#'])

@php
    $classes = $active 
                ? 'shrink-0 px-4 py-2 rounded-full text-sm font-medium transition-all bg-indigo-600 dark:bg-indigo-500 text-white shadow-md shadow-indigo-500/20' 
                : 'shrink-0 px-4 py-2 rounded-full text-sm font-medium transition-all bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-slate-200 border border-slate-200 dark:border-slate-800/60 shadow-sm dark:shadow-none';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>