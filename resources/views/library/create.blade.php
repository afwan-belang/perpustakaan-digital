<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- Header Form -->
        <div class="mb-8">
            <a href="{{ route('library.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline flex items-center gap-2 mb-4 font-medium text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar Buku
            </a>
            <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Tambah Buku Fisik Baru</h2>
            <p class="text-slate-600 dark:text-slate-400 mt-2">Masukkan detail informasi buku cetak untuk didata ke dalam inventaris perpustakaan.</p>
        </div>

        <!-- Form Container (Glassmorphism) -->
        <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border border-slate-200 dark:border-slate-800 rounded-3xl p-8 shadow-xl">
            <!-- PENTING: enctype="multipart/form-data" wajib agar bisa upload gambar cover -->
            <form action="{{ route('library.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Grid Baris 1: Judul & Penulis -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Judul Buku <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-950 px-4 py-2.5 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-colors">
                        @error('title') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="author" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Nama Penulis <span class="text-red-500">*</span></label>
                        <input type="text" name="author" id="author" value="{{ old('author') }}" required class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-950 px-4 py-2.5 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-colors">
                        @error('author') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Grid Baris 2: Penerbit, Tahun, Halaman -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="publisher" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Penerbit <span class="text-red-500">*</span></label>
                        <input type="text" name="publisher" id="publisher" value="{{ old('publisher') }}" required class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-950 px-4 py-2.5 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-colors">
                        @error('publisher') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="published_year" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Tahun Terbit <span class="text-red-500">*</span></label>
                        <input type="number" name="published_year" id="published_year" value="{{ old('published_year') }}" placeholder="Contoh: 2024" required class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-950 px-4 py-2.5 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-colors">
                        @error('published_year') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="pages" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Tebal Halaman <span class="text-red-500">*</span></label>
                        <input type="number" name="pages" id="pages" value="{{ old('pages') }}" placeholder="Jumlah halaman" required class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-950 px-4 py-2.5 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-colors">
                        @error('pages') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Grid Baris 3: Genre & Stok -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="genre" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Genre / Kategori</label>
                        <input type="text" name="genre" id="genre" value="{{ old('genre') }}" placeholder="Misal: Sains, Novel, Sejarah" class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-950 px-4 py-2.5 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-colors">
                        @error('genre') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="stock" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Jumlah Stok Fisik <span class="text-red-500">*</span></label>
                        <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}" min="0" required class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-950 px-4 py-2.5 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-colors">
                        @error('stock') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Baris 4: Deskripsi -->
                <div>
                    <label for="description" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Sinopsis / Deskripsi Buku</label>
                    <textarea name="description" id="description" rows="4" class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-950 px-4 py-2.5 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-colors">{{ old('description') }}</textarea>
                    @error('description') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Baris 5: Upload Cover -->
                <div>
                    <label for="cover" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Upload Gambar Cover Buku</label>
                    <input type="file" name="cover" id="cover" accept="image/*" class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-950 px-4 py-2 text-slate-900 dark:text-white focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 dark:file:bg-indigo-900/50 dark:file:text-indigo-300 hover:file:bg-indigo-100 dark:hover:file:bg-indigo-900/80 transition-all cursor-pointer">
                    <p class="mt-1 text-xs text-slate-500">Format: JPG, PNG (Maksimal 2MB).</p>
                    @error('cover') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <!-- Tombol Submit -->
                <div class="pt-4 border-t border-slate-200 dark:border-slate-800 flex justify-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl font-bold shadow-md shadow-indigo-500/30 transition hover:-translate-y-0.5">
                        Simpan Data Buku
                    </button>
                </div>

            </form>
        </div>

    </div>
</x-app-layout>