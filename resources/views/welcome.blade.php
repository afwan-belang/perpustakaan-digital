<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class', // PENTING: Ini mengaktifkan mode toggle manual
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none;  scrollbar-width: none; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 dark:bg-slate-900 dark:text-slate-200 transition-colors duration-300">

    <nav class="bg-white/90 dark:bg-slate-900/90 backdrop-blur-md shadow-sm sticky top-0 z-40 border-b border-slate-200 dark:border-slate-700 transition-colors duration-300">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <div class="bg-indigo-600 text-white p-2 rounded-lg shadow-lg shadow-indigo-500/30">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <span class="font-bold text-xl tracking-tight text-slate-800 dark:text-white">DigiLib<span class="text-indigo-600 dark:text-indigo-400">SMK</span></span>
                    </a>
                </div>

                <div class="hidden md:flex items-center gap-4">
                    
                    <a href="{{ route('home') }}" 
                       class="text-sm font-medium transition {{ !request('category_id') ? 'text-indigo-600 dark:text-indigo-400 font-bold' : 'text-slate-600 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400' }}">
                        Beranda
                    </a>

                    <div class="relative group">
                        <button class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition group-hover:text-indigo-600 dark:group-hover:text-indigo-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                            <span>Katalog Buku</span>
                            <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <div class="absolute top-full left-0 mt-1 w-56 bg-white dark:bg-slate-800 rounded-xl shadow-xl border border-slate-100 dark:border-slate-700 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-left z-50">
                            <div class="absolute -top-2 left-6 w-4 h-4 bg-white dark:bg-slate-800 border-t border-l border-slate-100 dark:border-slate-700 transform rotate-45"></div>
                            <div class="py-2">
                                <div class="px-4 py-2 text-xs font-bold text-slate-400 uppercase tracking-wider">Pilih Kategori</div>
                                <a href="{{ route('home') }}" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-indigo-50 dark:hover:bg-slate-700 hover:text-indigo-600 dark:hover:text-indigo-400 transition">Semua Kategori</a>
                                @foreach($categories as $cat)
                                <a href="{{ route('home', ['category_id' => $cat->id]) }}" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-indigo-50 dark:hover:bg-slate-700 hover:text-indigo-600 dark:hover:text-indigo-400 transition flex justify-between items-center">
                                    {{ $cat->name }}
                                    @if(request('category_id') == $cat->id) <svg class="w-4 h-4 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> @endif
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="h-6 w-px bg-slate-300 dark:bg-slate-700 mx-2"></div>

                    <button onclick="toggleTheme()" class="p-2 rounded-full text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition focus:outline-none">
    <svg id="iconSun" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
    <svg id="iconMoon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
</button>

<div class="ml-4 pl-4 border-l border-slate-200 dark:border-slate-700 flex items-center gap-3">
    <div class="hidden md:block text-right">
        <div class="text-sm font-bold text-slate-700 dark:text-slate-200">{{ Auth::user()->name }}</div>
        <div class="text-xs text-slate-500 dark:text-slate-400 capitalize">{{ Auth::user()->role }}</div>
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="text-slate-400 hover:text-red-500 transition" title="Logout">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
        </button>
    </form>
</div>

                    @if(Auth::user()->role === 'admin')
    <a href="{{ route('books.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white text-sm font-medium rounded-lg shadow transition transform hover:-translate-y-0.5">
        + Upload Buku
    </a>
@endif
                </div>

                <div class="flex items-center gap-4 md:hidden">
                    <button onclick="toggleTheme()" class="p-2 rounded-full text-slate-500 dark:text-slate-400">
                        <svg id="iconSunMobile" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <svg id="iconMoonMobile" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    </button>

                    <button onclick="toggleMobileMenu()" class="text-slate-500 hover:text-indigo-600 dark:text-slate-400 dark:hover:text-indigo-400 focus:outline-none">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobileMenu" class="hidden md:hidden bg-white dark:bg-slate-900 border-t border-slate-100 dark:border-slate-800 pb-4 shadow-lg">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ !request('category_id') ? 'bg-indigo-50 dark:bg-slate-800 text-indigo-700 dark:text-indigo-400' : 'text-slate-600 dark:text-slate-400' }}">Semua Kategori</a>
                @foreach($categories as $cat)
                    <a href="{{ route('home', ['category_id' => $cat->id]) }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request('category_id') == $cat->id ? 'bg-indigo-50 dark:bg-slate-800 text-indigo-700 dark:text-indigo-400' : 'text-slate-600 dark:text-slate-400' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
                <a href="{{ route('books.create') }}" class="block w-full text-center mt-4 px-4 py-3 bg-indigo-600 dark:bg-indigo-500 text-white rounded-lg font-bold shadow">
                    + Upload Buku Baru
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 min-h-screen">
        
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 dark:text-white transition-colors duration-300">
                    {{ request('category_id') ? $categories->where('id', request('category_id'))->first()->name : 'Jelajahi Pustaka' }}
                </h1>
                <p class="text-slate-500 dark:text-slate-400 mt-1 transition-colors duration-300">Temukan wawasan baru dari koleksi buku digital kami.</p>
            </div>
        </div>

        @if(session('success'))
        <div class="mb-6 bg-green-50 dark:bg-green-900/30 border-l-4 border-green-500 p-4 rounded-r shadow-sm flex justify-between items-center">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700 dark:text-green-300">{{ session('success') }}</p>
                </div>
            </div>
        </div>
        @endif

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @forelse($dataBooks as $book)
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                <!-- Mulai -->
               <div class="relative aspect-[3/4] bg-slate-200 dark:bg-slate-700 overflow-hidden cursor-pointer" 
                     onclick="bukaBuku('{{ asset('storage/' . $book->file_pdf) }}')">
                    
                    @if($book->cover_image)
                        <img src="{{ asset('storage/' . $book->cover_image) }}" 
                             alt="{{ $book->title }}" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    @else
                        <div class="flex items-center justify-center h-full text-slate-400 font-medium">No Cover</div>
                    @endif

                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-60 group-hover:opacity-80 transition-opacity"></div>
                    
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <button class="bg-white/20 backdrop-blur-sm border border-white/50 text-white px-4 py-1 rounded-full text-xs font-semibold hover:bg-white hover:text-indigo-600 transition">
                            Baca Buku
                        </button>
                    </div>
                </div>
            


<!-- selesai -->
                <div class="p-4">
                    <h3 class="font-bold text-slate-800 dark:text-white text-lg leading-snug line-clamp-2 min-h-[3rem] transition-colors duration-300" title="{{ $book->title }}">
                        {{ $book->title }}
                    </h3>
                    <p class="text-slate-500 dark:text-slate-400 text-sm mt-1 mb-4 transition-colors duration-300">{{ $book->author }}</p>

                    @if(Auth::user()->role === 'admin')
    <div class="flex items-center justify-between pt-3 border-t border-slate-100 dark:border-slate-700">
        <a href="{{ route('books.edit', $book->id) }}" class="text-slate-400 dark:text-slate-500 hover:text-yellow-600 dark:hover:text-yellow-500 transition flex items-center text-xs font-medium">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
            Edit
        </a>

        <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Hapus buku ini selamanya?');">
            @csrf @method('DELETE')
            <button type="submit" class="text-slate-400 dark:text-slate-500 hover:text-red-600 dark:hover:text-red-500 transition flex items-center text-xs font-medium">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                Hapus
            </button>
        </form>
    </div>
@endif
                </div>
            </div>
            @empty
            <div class="col-span-full flex flex-col items-center justify-center py-20 text-center">
                <div class="bg-slate-100 dark:bg-slate-800 p-6 rounded-full mb-4 transition-colors duration-300">
                    <svg class="w-16 h-16 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-700 dark:text-slate-300">Belum ada buku</h3>
                <p class="text-slate-500 dark:text-slate-500 mt-2">Jadilah yang pertama mengupload buku di kategori ini.</p>
                <a href="{{ route('books.create') }}" class="mt-6 inline-block bg-indigo-600 text-white px-6 py-2 rounded-full font-bold hover:bg-indigo-700 transition">
                    Upload Sekarang
                </a>
            </div>
            @endforelse
        </div>
    </main>

    <footer class="bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 py-8 mt-12 transition-colors duration-300">
        <div class="container mx-auto px-4 text-center text-slate-500 dark:text-slate-400 text-sm">
            &copy; {{ date('Y') }} DigiLib SMK - Dibuat dengan Laravel & Tailwind.
        </div>
    </footer>

    <div id="pdfModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-sm transition-opacity" onclick="tutupBuku()"></div>
        
        <div class="relative w-full h-full flex items-center justify-center p-4">
            <div class="bg-white dark:bg-slate-800 w-full max-w-6xl h-[90vh] rounded-2xl shadow-2xl overflow-hidden flex flex-col animate-bounce-in">
                <div class="flex justify-between items-center p-4 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900">
                    <span class="font-bold text-slate-700 dark:text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        Mode Membaca
                    </span>
                    <button onclick="tutupBuku()" class="text-slate-400 hover:text-red-500 dark:text-slate-400 dark:hover:text-red-400 transition rounded-full p-1 hover:bg-red-50 dark:hover:bg-red-900/30">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <iframe id="pdfFrame" src="" class="w-full flex-1 bg-slate-100 dark:bg-slate-900"></iframe>
            </div>
        </div>
    </div>

    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        function updateIcons() {
            const isDark = document.documentElement.classList.contains('dark');
            const suns = document.querySelectorAll('#iconSun, #iconSunMobile');
            const moons = document.querySelectorAll('#iconMoon, #iconMoonMobile');
            
            if (isDark) {
                suns.forEach(el => el.classList.remove('hidden'));
                moons.forEach(el => el.classList.add('hidden'));
            } else {
                suns.forEach(el => el.classList.add('hidden'));
                moons.forEach(el => el.classList.remove('hidden'));
            }
        }

        updateIcons();

        function toggleTheme() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            }
            updateIcons();
        }

        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }

        function bukaBuku(url) {
            document.getElementById('pdfFrame').src = url + "#toolbar=0&view=FitH";
            document.getElementById('pdfModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden'; 
        }

        function tutupBuku() {
            document.getElementById('pdfModal').classList.add('hidden');
            document.getElementById('pdfFrame').src = "";
            document.body.style.overflow = 'auto'; 
        }
    </script>
</body>
</html>