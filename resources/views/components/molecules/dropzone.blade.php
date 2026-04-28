@props(['name', 'id', 'accept', 'label', 'maxSize', 'icon'])

<div>
    <x-atoms.label :value="$label" />
    <div class="relative group">
        <label for="{{ $id }}" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-slate-700 rounded-xl cursor-pointer hover:bg-slate-800 hover:border-indigo-500 transition-all duration-300">
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <div class="text-slate-500 group-hover:text-indigo-400 transition mb-2">
                    {!! $icon !!}
                </div>
                <p class="text-sm text-slate-400"><span class="font-semibold text-indigo-400">Klik upload</span> atau drag & drop</p>
                <p class="text-xs text-slate-500 mt-1" id="{{ $id }}_filename">{{ $maxSize }}</p>
            </div>
            <input id="{{ $id }}" name="{{ $name }}" type="file" class="hidden" accept="{{ $accept }}" onchange="updateFilename(this, '{{ $id }}_filename')" {{ $attributes }} />
        </label>
    </div>
</div>