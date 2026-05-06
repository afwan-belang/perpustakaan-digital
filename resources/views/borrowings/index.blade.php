<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Log Peminjaman Fisik</h2>
                <p class="text-slate-600 dark:text-slate-400 mt-2">
                    {{ Auth::user()->role === 'admin' ? 'Kelola semua sirkulasi buku fisik perpustakaan.' : 'Pantau status dan tenggat waktu buku yang Anda pinjam.' }}
                </p>
            </div>
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
                            @if(Auth::user()->role === 'admin')
                                <th class="p-5">Peminjam</th>
                            @endif
                            <th class="p-5">Tgl Pinjam</th>
                            <th class="p-5">Tenggat Waktu</th>
                            <th class="p-5">Status</th>
                            @if(Auth::user()->role === 'admin')
                                <th class="p-5">Aksi Admin</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-800 text-slate-700 dark:text-slate-300">
                        @forelse ($borrowings as $borrow)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                <td class="p-5 font-medium dark:text-white">{{ $borrow->book->title }}</td>
                                @if(Auth::user()->role === 'admin')
                                    <td class="p-5">{{ $borrow->user->name }}</td>
                                @endif
                                <td class="p-5">{{ $borrow->borrow_date->format('d M Y') }}</td>
                                <td class="p-5">
                                    <span class="{{ $borrow->due_date < now() && !$borrow->returned_at ? 'text-red-600 dark:text-red-400 font-bold' : '' }}">
                                        {{ $borrow->due_date->format('d M Y') }}
                                    </span>
                                </td>
                                <td class="p-5">
                                    @if($borrow->status === 'returned')
                                        <span class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-xs font-bold rounded-full border border-green-200 dark:border-green-800">Selesai</span>
                                    @else
                                        <span class="px-3 py-1 bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 text-xs font-bold rounded-full border border-amber-200 dark:border-amber-800">Dipinjam</span>
                                    @endif
                                </td>
                                @if(Auth::user()->role === 'admin')
                                    <td class="p-5">
                                        @if(!$borrow->returned_at)
                                            <form action="{{ route('borrowings.return', $borrow->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-sm bg-slate-900 dark:bg-white hover:bg-slate-800 dark:hover:bg-slate-200 text-white dark:text-slate-900 px-4 py-2 rounded-lg font-semibold transition">
                                                    Terima Buku
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-sm text-slate-400 italic">Dikembalikan tgl {{ $borrow->returned_at->format('d/m/y') }}</span>
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-10 text-center text-slate-500 dark:text-slate-400">
                                    Belum ada data peminjaman buku fisik.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>