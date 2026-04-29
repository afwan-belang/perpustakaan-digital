@props(['value'])
<label {{ $attributes->merge(['class' => 'block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2 transition-colors']) }}>
    {{ $value ?? $slot }}
</label>