<x-app-layout>

    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
        <div>
            <h1 class="text-4xl font-bold text-slate-900 dark:text-white tracking-tight mb-2">Perpustakaan Digital</h1>
            <p class="text-slate-600 dark:text-slate-400">Luaskan wawasan pemikiran dan pertajam pikiran</p>
        </div>

        <div class="flex flex-col sm:flex-row items-center gap-4 w-full md:w-auto">
            <x-molecules.search-bar />

            @auth
                @if(Auth::user()->role === 'admin')
                <a href="{{ route('books.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl shadow-lg shadow-indigo-500/20 transition-all hover:-translate-y-0.5 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Upload Buku
                </a>
                @endif
            @endauth
        </div>
    </div>

    <div class="flex gap-3 overflow-x-auto no-scrollbar pb-4 mb-8 border-b border-slate-800/60">
        <x-atoms.badge :href="route('home')" :active="!request('category_id')">
            Semua
        </x-atoms.badge>
        
        @foreach($categories as $cat)
            <x-atoms.badge :href="route('home', ['category_id' => $cat->id])" :active="request('category_id') == $cat->id">
                {{ $cat->name }}
            </x-atoms.badge>
        @endforeach
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
        @forelse($dataBooks as $book)
            <x-organisms.book-card :book="$book" />
        @empty
            <div class="col-span-full flex flex-col items-center justify-center py-24 text-center">
                <h3 class="text-xl font-bold text-slate-200 mb-1">Belum ada buku</h3>
                <p class="text-slate-500 text-sm">Koleksi untuk kategori ini masih kosong.</p>
            </div>
        @endforelse
    </div>
    <div class="mt-10">
        {{ $dataBooks->links() }}
    </div>
    @push('modals')
    <div id="pdfModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-slate-950/90 backdrop-blur-sm" onclick="tutupBuku()"></div>
        <div class="relative w-full h-full flex items-center justify-center p-4 md:p-10">
            <div class="bg-slate-900 border border-slate-800 w-full max-w-6xl h-full md:h-[90vh] rounded-2xl shadow-2xl overflow-hidden flex flex-col" id="modalBox">
                <div class="flex justify-end p-2 bg-slate-900">
                    <button onclick="tutupBuku()" class="text-slate-400 hover:text-red-400 p-2"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                </div>
                <iframe id="pdfFrame" src="" class="w-full flex-1 bg-slate-950"></iframe>
            </div>
        </div>
    </div>
    @endpush

    @push('scripts')
    <script>
        function bukaBuku(url) {
            document.getElementById('pdfModal').classList.remove('hidden');
            document.getElementById('pdfFrame').src = url + "#toolbar=0&view=FitH";
            document.body.style.overflow = 'hidden';
        }
        function tutupBuku() {
            document.getElementById('pdfModal').classList.add('hidden');
            document.getElementById('pdfFrame').src = "";
            document.body.style.overflow = 'auto';
        }
    </script>
    @endpush

</x-app-layout>