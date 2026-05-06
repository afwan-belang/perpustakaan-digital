<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Inventaris Perpustakaan Fisik</h2>
                <p class="text-slate-600 dark:text-slate-400 mt-2">Kelola data buku cetak dan pantau jumlah stok yang tersedia.</p>
            </div>
            <a href="{{ route('library.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-bold shadow-md shadow-indigo-500/30 transition hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Buku Cetak
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-300 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 text-sm uppercase tracking-wider text-slate-500 dark:text-slate-400 font-semibold">
                            <th class="p-5">Judul Buku</th>
                            <th class="p-5">Penerbit & Tahun</th>
                            <th class="p-5">Genre</th>
                            <th class="p-5">Stok Fisik</th>
                            <th class="p-5">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-800 text-slate-700 dark:text-slate-300">
                        @forelse ($books as $book)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                <td class="p-5">
                                    <p class="font-bold text-slate-900 dark:text-white">{{ $book->title }}</p>
                                    <p class="text-sm text-slate-500">Oleh: {{ $book->author }}</p>
                                </td>
                                <td class="p-5">
                                    <p class="font-medium">{{ $book->publisher }}</p>
                                    <p class="text-sm text-slate-500">{{ $book->published_year }} • {{ $book->pages }} Halaman</p>
                                </td>
                                <td class="p-5">
                                    <span class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400 text-xs font-bold rounded-full border border-indigo-200 dark:border-indigo-800">
                                        {{ $book->genre ?? '-' }}
                                    </span>
                                </td>
                                <td class="p-5">
                                    <span class="font-bold text-lg {{ $book->stock > 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                        {{ $book->stock }}
                                    </span>
                                </td>
                                <td class="p-5">
                                    <form action="{{ route('library.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus buku ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 font-semibold text-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-10 text-center text-slate-500 dark:text-slate-400">
                                    Belum ada data buku fisik. Silakan tambah buku baru.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>