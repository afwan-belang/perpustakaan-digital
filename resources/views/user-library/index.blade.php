<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <div class="mb-10 text-center sm:text-left">
            <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Katalog Buku Perpustakaan</h2>
            <p class="text-slate-600 dark:text-slate-400 mt-2">Jelajahi koleksi buku fisik sekolah kami. Ajukan peminjaman secara online.</p>
        </div>

        <!-- Grid Buku -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($books as $book)
                <a href="{{ route('user.library.show', $book->id) }}" class="group bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col">
                    
                    <!-- Cover Image -->
                    <div class="relative aspect-[3/4] w-full overflow-hidden bg-slate-100 dark:bg-slate-800">
                        @if($book->path_cover)
                            <img src="{{ asset('storage/' . $book->path_cover) }}" alt="{{ $book->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="flex items-center justify-center w-full h-full text-slate-400">Tanpa Cover</div>
                        @endif
                        
                        <!-- Badge Stok -->
                        <div class="absolute top-4 right-4 px-3 py-1 rounded-full text-xs font-bold backdrop-blur-md border {{ $book->stock > 0 ? 'bg-green-500/80 text-white border-green-400' : 'bg-red-500/80 text-white border-red-400' }}">
                            {{ $book->stock > 0 ? 'Stok: ' . $book->stock : 'Habis' }}
                        </div>
                    </div>

                    <!-- Info Buku -->
                    <div class="p-5 flex flex-col flex-grow">
                        @if($book->genre)
                            <span class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-2">{{ $book->genre }}</span>
                        @endif
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white leading-tight mb-1 line-clamp-2">{{ $book->title }}</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">{{ $book->author }}</p>
                        
                        <div class="mt-auto pt-4 border-t border-slate-100 dark:border-slate-800 flex justify-between items-center">
                            <span class="text-xs text-slate-500">{{ $book->pages }} Halaman</span>
                            <span class="text-indigo-600 dark:text-indigo-400 font-medium text-sm group-hover:underline">Lihat Detail &rarr;</span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full py-20 text-center">
                    <p class="text-slate-500 dark:text-slate-400 text-lg">Belum ada koleksi buku fisik saat ini.</p>
                </div>
            @endforelse
        </div>

    </div>
</x-app-layout>