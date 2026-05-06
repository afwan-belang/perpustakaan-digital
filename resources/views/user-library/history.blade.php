<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Status Pinjaman Saya</h2>
            <p class="text-slate-600 dark:text-slate-400 mt-2">Pantau status persetujuan dan tenggat pengembalian buku fisik Anda.</p>
        </div>

        <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-slate-200 dark:border-slate-800 rounded-3xl overflow-hidden shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800 text-sm uppercase tracking-wider text-slate-500 font-semibold">
                            <th class="p-5">Judul Buku</th>
                            <th class="p-5">Tgl Pengajuan</th>
                            <th class="p-5">Tenggat Pengembalian</th>
                            <th class="p-5">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-800 text-slate-700 dark:text-slate-300">
                        @forelse ($borrowings as $borrowing)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50">
                                <td class="p-5 font-medium dark:text-white">{{ $borrowing->libraryBook->title }}</td>
                                <td class="p-5">{{ $borrowing->created_at->format('d M Y') }}</td>
                                <td class="p-5 {{ $borrowing->due_date && $borrowing->due_date < now() && $borrowing->status === 'approved' ? 'text-red-500 font-bold' : '' }}">
                                    {{ $borrowing->due_date ? $borrowing->due_date->format('d M Y') : 'Menunggu ACC Admin' }}
                                </td>
                                <td class="p-5">
                                    @if($borrowing->status === 'pending')
                                        <span class="px-3 py-1 bg-amber-100 text-amber-700 text-xs font-bold rounded-full">Diproses</span>
                                    @elseif($borrowing->status === 'approved')
                                        <span class="px-3 py-1 bg-indigo-100 text-indigo-700 text-xs font-bold rounded-full">Sedang Anda Pinjam</span>
                                    @elseif($borrowing->status === 'returned')
                                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">Sudah Dikembalikan</span>
                                    @else
                                        <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-full">Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="p-10 text-center text-slate-500">Anda belum pernah mengajukan peminjaman.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>