<x-app-layout>
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight mb-2">Edit Buku</h1>
            <p class="text-slate-600 dark:text-slate-400">Perbarui informasi untuk buku: <span class="text-indigo-600 dark:text-indigo-400 font-semibold">{{ $book->title }}</span></p>
        </div>

        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800/60 rounded-2xl p-6 md:p-8 shadow-sm dark:shadow-xl transition-colors">
            <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 rounded-xl p-4 mb-6">
                        <x-atoms.input-error :messages="$errors->all()" />
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-atoms.label for="title" value="Judul Buku" />
                        <x-atoms.text-input id="title" name="title" type="text" value="{{ $book->title }}" required autofocus />
                    </div>
                    <div>
                        <x-atoms.label for="author" value="Nama Penulis" />
                        <x-atoms.text-input id="author" name="author" type="text" value="{{ $book->author }}" required />
                    </div>
                </div>

                <div>
                    <x-atoms.label for="category_id" value="Kategori" />
                    <div class="relative">
                        <select name="category_id" id="category_id" class="w-full appearance-none px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300 shadow-sm dark:shadow-none" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" class="text-slate-900 dark:text-slate-200" {{ $book->category_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-500">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>

                <div>
                    <x-atoms.label for="description" value="Deskripsi Singkat" />
                    <x-atoms.textarea id="description" name="description" rows="3">{{ $book->description }}</x-atoms.textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-slate-200 dark:border-slate-800">
                    <div>
                        <x-molecules.dropzone 
                            id="cover_upload" name="cover_image" accept="image/*" label="Ganti Cover (Opsional)" maxSize="Max 10MB"
                            icon='<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>'
                        />
                        @if($book->cover_image)
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">Cover saat ini terpasang. Upload baru untuk mengganti.</p>
                        @endif
                    </div>

                    <div>
                        <x-molecules.dropzone 
                            id="pdf_upload" name="file_pdf" accept="application/pdf" label="Ganti PDF (Opsional)" maxSize="Max 150MB"
                            icon='<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>'
                        />
                         @if($book->file_pdf)
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">File PDF saat ini terpasang. Upload baru untuk mengganti.</p>
                        @endif
                    </div>
                </div>

                <div class="pt-6 flex justify-end gap-4">
                    <a href="{{ route('home') }}" class="px-6 py-3 rounded-xl font-semibold text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors">Batal</a>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl font-semibold shadow-lg shadow-indigo-500/30 transition-all hover:-translate-y-0.5">
                        Update Buku
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        function updateFilename(input, targetId) {
            const fileName = input.files[0]?.name;
            const target = document.getElementById(targetId);
            if (fileName) {
                target.innerText = fileName;
                target.classList.add("text-indigo-600", "dark:text-indigo-400", "font-bold");
                target.classList.remove("text-slate-500");
            } else {
                target.innerText = targetId === 'cover_upload_filename' ? 'Max 10MB' : 'Max 150MB';
                target.classList.remove("text-indigo-600", "dark:text-indigo-400", "font-bold");
                target.classList.add("text-slate-500");
            }
        }
    </script>
    @endpush
</x-app-layout>