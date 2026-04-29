<x-app-layout>
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-slate-900 dark:text-white tracking-tight mb-2">Koleksi Favorit</h1>
        <p class="text-slate-600 dark:text-slate-400">Buku-buku pilihan yang Anda simpan untuk dibaca kembali.</p>
    </div>

    @if($dataBooks->count() > 0)
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach($dataBooks as $book)
                <x-organisms.book-card :book="$book" />
            @endforeach
        </div>

        <div class="mt-10">
            {{ $dataBooks->links() }}
        </div>
    @else
        <div class="flex flex-col items-center justify-center py-20 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800/60 rounded-3xl mt-8">
            <svg class="w-20 h-20 text-slate-300 dark:text-slate-700 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
            <h3 class="text-xl font-bold text-slate-700 dark:text-slate-300">Belum ada buku favorit</h3>
            <p class="text-slate-500 mt-2 text-center max-w-md">Jelajahi pustaka kami dan klik icon hati pada buku untuk menambahkannya ke koleksi ini.</p>
            <a href="{{ route('home') }}" class="mt-6 px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-medium transition-all shadow-lg shadow-indigo-500/30 hover:-translate-y-0.5">Jelajahi Buku</a>
        </div>
    @endif
</x-app-layout>