<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'DigiLib SMK') }} - Perpustakaan Digital</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        
        /* Animasi Marquee (Magic UI Adapted) */
        @keyframes marquee {
            0% { transform: translateX(0%); }
            100% { transform: translateX(-100%); }
        }
        .animate-marquee {
            display: flex;
            min-width: 100%;
            animation: marquee 25s linear infinite;
        }
        .animate-marquee:hover {
            animation-play-state: paused;
        }
        
        /* Efek Glow Latar Belakang */
        .glow-bg {
            background: radial-gradient(circle at 50% 50%, rgba(99, 102, 241, 0.15) 0%, rgba(255, 255, 255, 0) 50%);
        }
        .dark .glow-bg {
            background: radial-gradient(circle at 50% 50%, rgba(99, 102, 241, 0.1) 0%, rgba(2, 6, 23, 0) 50%);
        }
    </style>
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 antialiased overflow-x-hidden selection:bg-indigo-500 selection:text-white transition-colors duration-300">

    <!-- NAVBAR -->
    <nav class="fixed w-full z-50 top-0 transition-all duration-300 backdrop-blur-md bg-white/70 dark:bg-slate-950/70 border-b border-slate-200/50 dark:border-slate-800/50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-2">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <span class="font-bold text-xl tracking-tight">DigiLib<span class="text-indigo-600 dark:text-indigo-400">SMK</span></span>
                </div>

                <!-- Autentikasi / Link Dashboard -->
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('home') }}" class="text-sm font-semibold bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-full shadow-md shadow-indigo-500/20 transition hover:-translate-y-0.5">Ke Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition">Sign In</a>
                        <a href="{{ route('register') }}" class="text-sm font-semibold bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-full shadow-md shadow-indigo-500/20 transition hover:-translate-y-0.5">Sign Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden min-h-screen flex flex-col justify-center">
        <div class="absolute inset-0 glow-bg pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10 w-full flex flex-col items-center">
            
            <div class="flex flex-col items-center text-center">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-slate-300 dark:border-slate-700 bg-white/50 dark:bg-slate-900/50 backdrop-blur-md mb-8 shadow-sm">
                    <span class="flex w-2 h-2 rounded-full bg-indigo-600 animate-pulse"></span>
                    <span class="text-xs font-semibold text-slate-600 dark:text-slate-300">Sistem Perpustakaan Modern</span>
                </div>

                <h1 class="text-5xl md:text-7xl font-bold tracking-tighter mb-6 bg-clip-text text-transparent bg-gradient-to-b from-slate-900 to-slate-500 dark:from-white dark:to-slate-500">
                    Wawasan Global di<br>Ujung Jari Anda.
                </h1>
                
                <p class="text-lg md:text-xl text-slate-600 dark:text-slate-400 max-w-2xl mb-10 leading-relaxed">
                    Akses ribuan buku digital, materi pembelajaran, dan referensi industri tanpa batas ruang dan waktu. Dirancang khusus untuk masa depan siswa vokasi.
                </p>

                <a href="{{ route('home') }}" class="bg-slate-900 hover:bg-slate-800 dark:bg-white dark:hover:bg-slate-200 text-white dark:text-slate-900 px-8 py-4 rounded-full font-bold text-lg hover:scale-105 transition-all duration-300 shadow-xl shadow-slate-900/20 dark:shadow-white/10 flex items-center gap-2">
                    Mulai Jelajahi
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <!-- <div class="mt-10 relative flex justify-center items-center w-full max-w-[400px] md:max-w-[500px] mx-auto aspect-square">
                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-slate-50 dark:from-slate-950 to-transparent z-10 h-1/2 pointer-events-none"></div>
                <canvas id="cobe" class="w-full h-full" style="transform: translateY(15%);"></canvas>
            </div> -->
            
        </div>
    </main>
    <section class="py-20 relative overflow-hidden bg-white dark:bg-slate-900/50 border-y border-slate-200/50 dark:border-slate-800/50">
        <div class="text-center mb-10">
            <h2 class="text-2xl font-bold text-slate-800 dark:text-slate-200">Dipercaya Oleh Siswa Hebat</h2>
        </div>

        <div class="relative flex overflow-hidden w-full group">
            <div class="absolute inset-y-0 left-0 w-32 bg-gradient-to-r from-white dark:from-slate-950 to-transparent z-10 pointer-events-none"></div>
            <div class="absolute inset-y-0 right-0 w-32 bg-gradient-to-l from-white dark:from-slate-950 to-transparent z-10 pointer-events-none"></div>

            <div class="animate-marquee flex gap-4 pl-4 items-center">
                @php
                    $reviews = [
                        ['name' => 'Budi S.', 'role' => 'XI RPL 1', 'body' => 'Buku Laravelnya sangat lengkap, sangat membantu project UKK saya!'],
                        ['name' => 'Siti A.', 'role' => 'XII TKJ', 'body' => 'UI/UX website ini luar biasa mulus. Membaca PDF jadi tidak membosankan.'],
                        ['name' => 'Reza D.', 'role' => 'X DKV', 'body' => 'Saya menemukan banyak referensi desain yang bagus di kategori seni.'],
                        ['name' => 'Diana P.', 'role' => 'Guru IT', 'body' => 'Platform yang sangat modern dan mudah digunakan oleh seluruh siswa.'],
                    ];
                @endphp

                @for($i = 0; $i < 2; $i++)
                    @foreach($reviews as $review)
                    <figure class="relative w-72 shrink-0 cursor-pointer overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-800/60 bg-slate-50/50 dark:bg-slate-800/20 p-5 hover:bg-slate-100 dark:hover:bg-slate-800/50 transition-colors">
                        <div class="flex flex-row items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold text-sm">
                                {{ substr($review['name'], 0, 1) }}
                            </div>
                            <div class="flex flex-col">
                                <figcaption class="text-sm font-semibold text-slate-900 dark:text-white">{{ $review['name'] }}</figcaption>
                                <p class="text-xs font-medium text-slate-500 dark:text-slate-400">{{ $review['role'] }}</p>
                            </div>
                        </div>
                        <blockquote class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed">"{{ $review['body'] }}"</blockquote>
                    </figure>
                    @endforeach
                @endfor
            </div>
        </div>
    </section>

    <section class="py-24 relative overflow-hidden bg-white dark:bg-slate-900/30 border-t border-slate-200/50 dark:border-slate-800/50">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-slate-800 dark:text-slate-200 tracking-tight">Dipercaya Oleh Siswa Hebat</h2>
            <p class="text-slate-500 dark:text-slate-400 mt-2">Mereka yang telah merasakan kemudahan belajar digital.</p>
        </div>

        <div class="relative flex overflow-hidden w-full group">
            <div class="absolute inset-y-0 left-0 w-16 md:w-32 bg-gradient-to-r from-white dark:from-slate-950 to-transparent z-10 pointer-events-none"></div>
            <div class="absolute inset-y-0 right-0 w-16 md:w-32 bg-gradient-to-l from-white dark:from-slate-950 to-transparent z-10 pointer-events-none"></div>

            <div class="animate-marquee flex gap-4 pl-4 items-center">
                @php
                    $reviews = [
                        ['name' => 'Budi S.', 'role' => 'XI RPL 1', 'body' => 'Buku framework Laravelnya sangat lengkap, sangat membantu project UKK saya!'],
                        ['name' => 'Siti A.', 'role' => 'XII TKJ', 'body' => 'UI/UX website ini luar biasa mulus. Membaca PDF jadi tidak membuat mata cepat lelah.'],
                        ['name' => 'Reza D.', 'role' => 'X DKV', 'body' => 'Saya menemukan banyak referensi desain yang bagus di kategori seni & desain.'],
                        ['name' => 'Diana P.', 'role' => 'Guru IT', 'body' => 'Platform yang sangat modern dan mudah digunakan oleh seluruh ekosistem sekolah.'],
                    ];
                @endphp

                @for($i = 0; $i < 3; $i++)
                    @foreach($reviews as $review)
                    <figure class="relative w-72 md:w-80 shrink-0 cursor-pointer overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-800/60 bg-slate-50/80 dark:bg-slate-800/30 p-6 hover:bg-slate-100 dark:hover:bg-slate-800/70 transition-colors shadow-sm">
                        <div class="flex flex-row items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-500 flex items-center justify-center text-white font-bold text-sm shadow-inner">
                                {{ substr($review['name'], 0, 1) }}
                            </div>
                            <div class="flex flex-col">
                                <figcaption class="text-sm font-semibold text-slate-900 dark:text-white">{{ $review['name'] }}</figcaption>
                                <p class="text-xs font-medium text-slate-500 dark:text-slate-400">{{ $review['role'] }}</p>
                            </div>
                        </div>
                        <blockquote class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed">"{{ $review['body'] }}"</blockquote>
                    </figure>
                    @endforeach
                @endfor
            </div>
        </div>
    </section>

    <section class="py-24 relative max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800 dark:text-slate-200 tracking-tight mb-4">Dirancang Untuk Efisiensi</h2>
            <p class="text-slate-500 dark:text-slate-400 max-w-2xl mx-auto text-lg">Semua alat yang Anda butuhkan untuk pengalaman membaca dan belajar digital yang tak tertandingi.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 auto-rows-[300px]">
            
            <div class="md:col-span-2 relative overflow-hidden rounded-3xl border border-slate-200/60 dark:border-slate-800/60 bg-white/50 dark:bg-slate-900/30 p-8 hover:bg-slate-50 dark:hover:bg-slate-900/50 transition-colors group">
                <div class="absolute top-0 right-0 p-8 opacity-20 dark:opacity-10 group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <div class="relative z-10 flex flex-col h-full justify-end">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-100 dark:bg-indigo-500/20 flex items-center justify-center mb-6 text-indigo-600 dark:text-indigo-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-100 mb-2">Pustaka Tanpa Batas</h3>
                    <p class="text-slate-500 dark:text-slate-400 max-w-md">Ribuan buku dan modul pembelajaran tersusun rapi. Kami menyimpan progres membaca Anda secara otomatis.</p>
                </div>
            </div>

            <div class="md:col-span-1 relative overflow-hidden rounded-3xl border border-slate-200/60 dark:border-slate-800/60 bg-white/50 dark:bg-slate-900/30 p-8 hover:bg-slate-50 dark:hover:bg-slate-900/50 transition-colors group">
                <div class="relative z-10 flex flex-col h-full justify-between">
                    <div class="w-12 h-12 rounded-2xl bg-orange-100 dark:bg-orange-500/20 flex items-center justify-center text-orange-600 dark:text-orange-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100 mb-2">Akses Instan</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Teknologi PDF reader modern yang ringan. Buka buku berat dalam hitungan detik tanpa *lag*.</p>
                    </div>
                </div>
            </div>

            <div class="md:col-span-1 relative overflow-hidden rounded-3xl border border-slate-200/60 dark:border-slate-800/60 bg-white/50 dark:bg-slate-900/30 p-8 hover:bg-slate-50 dark:hover:bg-slate-900/50 transition-colors group">
                <div class="relative z-10 flex flex-col h-full justify-between">
                    <div class="w-12 h-12 rounded-2xl bg-rose-100 dark:bg-rose-500/20 flex items-center justify-center text-rose-600 dark:text-rose-400 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100 mb-2">Koleksi Personal</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Simpan buku yang Anda sukai ke dalam rak virtual pribadi untuk dibaca kembali kapan saja.</p>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2 relative overflow-hidden rounded-3xl border border-slate-200/60 dark:border-slate-800/60 bg-white/50 dark:bg-slate-900/30 p-8 hover:bg-slate-50 dark:hover:bg-slate-900/50 transition-colors group flex items-center">
                <div class="absolute right-0 bottom-0 w-2/3 h-full bg-gradient-to-l from-indigo-50 dark:from-indigo-900/10 to-transparent pointer-events-none"></div>
                
                <div class="relative z-10 w-full md:w-1/2">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-100 dark:bg-emerald-500/20 flex items-center justify-center mb-6 text-emerald-600 dark:text-emerald-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800 dark:text-slate-100 mb-2">Mendukung Segala Perangkat</h3>
                    <p class="text-slate-500 dark:text-slate-400">Desain responsif sepenuhnya. Baca dengan nyaman dari Laptop di laboratorium, Tablet di perpustakaan, atau Smartphone saat di perjalanan.</p>
                </div>
            </div>

        </div>
    </section>

    <footer class="bg-white dark:bg-slate-950 py-8 border-t border-slate-200/50 dark:border-slate-800/50 text-center">
        <p class="text-sm text-slate-500 dark:text-slate-400">
            &copy; {{ date('Y') }} DigiLib SMK. Dibangun untuk kemajuan vokasi.
        </p>
    </footer>

</body>
</html>