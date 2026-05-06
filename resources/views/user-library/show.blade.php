<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- Tombol Kembali -->
        <a href="{{ route('user.library.index') }}" class="inline-flex items-center gap-2 text-indigo-600 dark:text-indigo-400 hover:underline mb-8 font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Katalog
        </a>

        <!-- Notifikasi Sistem (Penting untuk Limit & Sukses) -->
        @if(session('success'))
            <div class="mb-8 p-4 bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-300 rounded-2xl flex items-center gap-3 shadow-sm">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-8 p-4 bg-red-100 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-300 rounded-2xl flex items-center gap-3 shadow-sm">
                <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p class="font-medium">{{ session('error') }}</p>
            </div>
        @endif

        <!-- Card Utama -->
        <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-slate-200 dark:border-slate-800 rounded-3xl p-8 lg:p-12 shadow-xl">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                
                <!-- Sisi Kiri: Cover -->
                <div class="lg:col-span-4">
                    <div class="rounded-2xl overflow-hidden shadow-2xl bg-slate-100 dark:bg-slate-800 aspect-[3/4]">
                        @if($book->path_cover)
                            <img src="{{ asset('storage/' . $book->path_cover) }}" alt="Cover {{ $book->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="flex items-center justify-center w-full h-full text-slate-400 font-medium">Tanpa Cover</div>
                        @endif
                    </div>
                </div>

                <!-- Sisi Kanan: Detail & Aksi -->
                <div class="lg:col-span-8 flex flex-col">
                    
                    <div class="flex flex-wrap gap-3 mb-4">
                        <span class="px-3 py-1 text-xs font-bold uppercase tracking-wider bg-indigo-100 dark:bg-indigo-900/40 text-indigo-700 dark:text-indigo-300 rounded-full border border-indigo-200 dark:border-indigo-800">
                            {{ $book->genre ?? 'Umum' }}
                        </span>
                        <span class="px-3 py-1 text-xs font-bold uppercase tracking-wider bg-amber-100 dark:bg-amber-900/40 text-amber-700 dark:text-amber-300 rounded-full border border-amber-200 dark:border-amber-800">
                            Buku Fisik
                        </span>
                    </div>

                    <h1 class="text-4xl lg:text-5xl font-extrabold text-slate-900 dark:text-white leading-tight mb-2">{{ $book->title }}</h1>
                    <p class="text-xl text-slate-600 dark:text-slate-400 font-medium mb-8">Karya: <span class="text-slate-900 dark:text-slate-200">{{ $book->author }}</span></p>

                    <!-- Info Grid -->
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-6 mb-8 p-6 bg-slate-50 dark:bg-slate-950/50 rounded-2xl border border-slate-200 dark:border-slate-800">
                        <div>
                            <p class="text-sm text-slate-500 dark:text-slate-400 mb-1">Penerbit</p>
                            <p class="font-semibold text-slate-900 dark:text-white">{{ $book->publisher }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500 dark:text-slate-400 mb-1">Tahun Terbit</p>
                            <p class="font-semibold text-slate-900 dark:text-white">{{ $book->published_year }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500 dark:text-slate-400 mb-1">Tebal</p>
                            <p class="font-semibold text-slate-900 dark:text-white">{{ $book->pages }} Halaman</p>
                        </div>
                    </div>

                    <!-- Sinopsis -->
                    <div class="mb-10 flex-grow">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-3">Sinopsis Buku</h3>
                        <div class="prose dark:prose-invert max-w-none text-slate-600 dark:text-slate-300 leading-relaxed">
                            <p>{{ $book->description ?: 'Belum ada deskripsi untuk buku ini.' }}</p>
                        </div>
                    </div>

                    <!-- Area Aksi & Form Peminjaman -->
                    <div class="pt-8 border-t border-slate-200 dark:border-slate-800">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                            
                            <div>
                                <p class="text-sm text-slate-500 dark:text-slate-400 mb-1">Status Ketersediaan</p>
                                <p class="text-lg font-semibold dark:text-white">
                                    Stok: <span class="{{ $book->stock > 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }} text-2xl ml-1">{{ $book->stock }}</span> Buku
                                </p>
                            </div>

                            <!-- Form Ajukan Pinjaman -->
                            <form action="{{ route('user.library.borrow', $book->id) }}" method="POST" class="w-full sm:w-auto">
                                @csrf
                                <button type="submit" 
                                    @disabled($book->stock < 1) 
                                    class="w-full sm:w-auto px-8 py-4 rounded-xl font-bold text-white transition-all shadow-md flex justify-center items-center gap-2 {{ $book->stock > 0 ? 'bg-indigo-600 hover:bg-indigo-700 shadow-indigo-500/30 hover:-translate-y-0.5' : 'bg-slate-400 dark:bg-slate-700 cursor-not-allowed opacity-70' }}">
                                    
                                    @if($book->stock > 0)
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                        Ajukan Pinjaman
                                    @else
                                        Stok Sedang Kosong
                                    @endif

                                </button>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</x-app-layout>