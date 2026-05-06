<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Sirkulasi & Antrean Peminjaman</h2>
            <p class="text-slate-600 dark:text-slate-400 mt-2">Kelola pengajuan peminjaman siswa dan konfirmasi pengembalian buku fisik.</p>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 dark:bg-green-900/30 border border-green-200 text-green-800 dark:text-green-300 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 text-sm uppercase tracking-wider text-slate-500 font-semibold">
                            <th class="p-5">Siswa</th>
                            <th class="p-5">Judul Buku</th>
                            <th class="p-5">Status</th>
                            <th class="p-5">Tenggat Waktu</th>
                            <th class="p-5">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-800 text-slate-700 dark:text-slate-300">
                        @forelse ($borrowings as $borrowing)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50">
                                <td class="p-5 font-medium dark:text-white">{{ $borrowing->user->name }}</td>
                                <td class="p-5">{{ $borrowing->libraryBook->title }}</td>
                                <td class="p-5">
                                    @if($borrowing->status === 'pending')
                                        <span class="px-3 py-1 bg-amber-100 text-amber-700 text-xs font-bold rounded-full">Menunggu ACC</span>
                                    @elseif($borrowing->status === 'approved')
                                        <span class="px-3 py-1 bg-indigo-100 text-indigo-700 text-xs font-bold rounded-full">Sedang Dipinjam</span>
                                    @elseif($borrowing->status === 'returned')
                                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">Dikembalikan</span>
                                    @else
                                        <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-full">Ditolak</span>
                                    @endif
                                </td>
                                <td class="p-5 text-sm">
                                    {{ $borrowing->due_date ? $borrowing->due_date->format('d M Y') : '-' }}
                                </td>
                                <td class="p-5">
                                    <div class="flex gap-2">
                                        @if($borrowing->status === 'pending')
                                            <form action="{{ route('admin.borrowings.approve', $borrowing->id) }}" method="POST">
                                                @csrf <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1.5 rounded-lg text-sm font-semibold">Terima</button>
                                            </form>
                                            <form action="{{ route('admin.borrowings.reject', $borrowing->id) }}" method="POST">
                                                @csrf <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-sm font-semibold">Tolak</button>
                                            </form>
                                        @elseif($borrowing->status === 'approved')
                                            <form action="{{ route('admin.borrowings.return', $borrowing->id) }}" method="POST">
                                                @csrf <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded-lg text-sm font-semibold">Tandai Dikembalikan</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="p-10 text-center text-slate-500">Belum ada aktivitas peminjaman.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>