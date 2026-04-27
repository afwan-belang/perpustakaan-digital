<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Buku: {{ $book->title }}</h2>

        <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Judul Buku</label>
                <input type="text" name="title" value="{{ $book->title }}" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Penulis</label>
                <input type="text" name="author" value="{{ $book->author }}" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Kategori</label>
                <select name="category_id" class="w-full border rounded px-3 py-2 bg-white" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $book->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Ganti Cover (Kosongkan jika tidak ubah)</label>
                <input type="file" name="cover_image" accept="image/*" class="w-full border rounded px-3 py-2 bg-gray-50">
                <p class="text-xs text-gray-500 mt-1">Cover saat ini: <a href="{{ asset('storage/'.$book->cover_image) }}" target="_blank" class="text-blue-500">Lihat</a></p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Ganti PDF (Kosongkan jika tidak ubah)</label>
                <input type="file" name="file_pdf" accept="application/pdf" class="w-full border rounded px-3 py-2 bg-gray-50">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Deskripsi Singkat</label>
                <textarea name="description" rows="3" class="w-full border rounded px-3 py-2">{{ $book->description }}</textarea>
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-700">Batal</a>
                <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded font-bold hover:bg-yellow-600 transition">
                    Update Buku
                </button>
            </div>
        </form>
    </div>
</body>
</html>