@props(['book'])

<div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800/60 rounded-2xl p-5 flex flex-col hover:bg-slate-50 dark:hover:bg-slate-800/80 hover:border-indigo-300 dark:hover:border-slate-700 transition-all duration-300 group cursor-pointer" onclick="bukaBuku('{{ asset('storage/' . $book->file_pdf) }}')">
    
    <div class="w-full aspect-[3/4] bg-slate-100 dark:bg-slate-950 rounded-xl mb-5 overflow-hidden shadow-sm dark:shadow-md relative flex items-center justify-center">
        @if($book->cover_image)
            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
        @else
            <span class="text-slate-400 dark:text-slate-600 text-sm font-medium">No Cover</span>
        @endif
        
        <div class="absolute inset-0 bg-slate-900/40 dark:bg-slate-950/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
            <span class="bg-white/90 dark:bg-white/10 border border-white/20 text-indigo-600 dark:text-white px-4 py-1.5 rounded-full text-xs font-bold tracking-wide shadow-lg">
                Buka PDF
            </span>
        </div>
    </div>

    <div class="flex-1 flex flex-col justify-between">
        <div>
            <h3 class="font-bold text-slate-800 dark:text-slate-100 text-base leading-snug line-clamp-2 mb-1 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                {{ $book->title }}
            </h3>
            <p class="text-slate-500 dark:text-slate-400 text-sm line-clamp-1">{{ $book->author }}</p>
        </div>

        @auth
            @if(Auth::user()->role === 'admin')
            <div class="flex items-center gap-3 pt-4 mt-4 border-t border-slate-100 dark:border-slate-800/80">
                <object class="flex-1">
                    <a href="{{ route('books.edit', $book->id) }}" class="flex items-center justify-center gap-1 text-slate-500 dark:text-slate-400 hover:text-yellow-600 dark:hover:text-yellow-500 transition-colors text-xs font-medium bg-slate-50 dark:bg-slate-950 hover:bg-slate-100 dark:hover:bg-slate-900 py-1.5 rounded-lg w-full">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        Edit
                    </a>
                </object>
                
                <object class="flex-1">
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Hapus buku ini selamanya?');" class="w-full">
                        @csrf @method('DELETE')
                        <button type="submit" class="flex items-center justify-center gap-1 text-slate-500 dark:text-slate-400 hover:text-red-600 dark:hover:text-red-500 transition-colors text-xs font-medium bg-slate-50 dark:bg-slate-950 hover:bg-slate-100 dark:hover:bg-slate-900 py-1.5 rounded-lg w-full">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Hapus
                        </button>
                    </form>
                </object>
            </div>
            @endif
        @endauth
    </div>
</div>