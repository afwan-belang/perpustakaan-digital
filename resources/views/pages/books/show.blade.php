<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- Notifikasi Sukses/Error -->
        @if(session('success'))
            <div class="mb-8 p-4 bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-300 rounded-2xl flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif
        @if(session('error'))
            <div class="mb-8 p-4 bg-red-100 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-300 rounded-2xl flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p class="font-medium">{{ session('error') }}</p>
            </div>
        @endif

        <!-- Card Detail Buku (Glassmorphism) -->
        <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-3xl border border-slate-200 dark:border-slate-800 p-8 lg:p-12 shadow-2xl">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                
                <!-- Sisi Kiri: Cover Buku -->
                <div class="col-span-1">
                    @if($book->path_cover)
                        <img src="{{ asset('storage/' . $book->path_cover) }}" alt="Cover {{ $book->title }}" class="w-full rounded-2xl shadow-lg object-cover aspect-[3/4]">
                    @else
                        <div class="w-full rounded-2xl bg-slate-200 dark:bg-slate-800 aspect-[3/4] flex items-center justify-center">
                            <span class="text-slate-400 dark:text-slate-500 font-medium">Tanpa Cover</span>
                        </div>
                    @endif
                </div>

                <!-- Sisi Kanan: Informasi & Aksi -->
                <div class="col-span-1 lg:col-span-2 space-y-6">
                    <h1 class="text-4xl font-bold text-slate-900 dark:text-white">{{ $book->title }}</h1>
                    
                    <!-- Badges Info -->
                    <div class="flex flex-wrap gap-3">
                        <span class="px-4 py-1.5 text-sm font-semibold bg-indigo-100 dark:bg-indigo-900/40 text-indigo-700 dark:text-indigo-300 rounded-full border border-indigo-200 dark:border-indigo-800">
                            {{ $book->genre ?? 'Kategori Umum' }}
                        </span>
                        <span class="px-4 py-1.5 text-sm font-semibold {{ $book->type === 'physical' ? 'bg-amber-100 dark:bg-amber-900/40 text-amber-700 dark:text-amber-300 border-amber-200 dark:border-amber-800' : 'bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300 border-emerald-200 dark:border-emerald-800' }} rounded-full border">
                            {{ $book->type === 'physical' ? 'Buku Fisik' : 'Buku Digital' }}
                        </span>
                    </div>

                    <div class="prose dark:prose-invert max-w-none text-slate-600 dark:text-slate-300">
                        <p class="leading-relaxed">{{ $book->description }}</p>
                    </div>

                    <!-- Area Aksi (Dinamis berdasarkan Tipe Buku) -->
                    <div class="mt-8 pt-8 border-t border-slate-200 dark:border-slate-800">
                        @if($book->type === 'physical')
                            <!-- Info Stok & Form Pinjam -->
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between bg-slate-50 dark:bg-slate-950 p-6 rounded-2xl border border-slate-200 dark:border-slate-800 gap-4">
                                <div>
                                    <p class="text-sm text-slate-500 dark:text-slate-400 mb-1">Status Ketersediaan</p>
                                    <p class="text-lg font-semibold dark:text-white">
                                        Stok Tersisa: <span class="{{ $book->stock > 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }} text-2xl ml-1">{{ $book->stock }}</span>
                                    </p>
                                </div>
                                <form action="{{ route('borrowings.store', $book->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                        @disabled($book->stock < 1) 
                                        class="w-full sm:w-auto px-8 py-3.5 rounded-xl font-bold text-white transition-all shadow-md {{ $book->stock > 0 ? 'bg-indigo-600 hover:bg-indigo-700 shadow-indigo-500/30 hover:-translate-y-0.5' : 'bg-slate-400 dark:bg-slate-700 cursor-not-allowed opacity-70' }}">
                                        {{ $book->stock > 0 ? 'Pinjam Buku Ini' : 'Stok Sedang Kosong' }}
                                    </button>
                                </form>
                            </div>
                        @else
                            <!-- Tombol Baca Digital -->
                            @if($book->path_pdf)
                                <a href="{{ asset('storage/' . $book->path_pdf) }}" target="_blank" class="inline-flex items-center justify-center gap-2 px-8 py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-bold transition-all shadow-md shadow-indigo-500/30 hover:-translate-y-0.5">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                    Baca PDF Sekarang
                                </a>
                            @else
                                <p class="text-slate-500 italic">File PDF belum tersedia.</p>
                            @endif
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>