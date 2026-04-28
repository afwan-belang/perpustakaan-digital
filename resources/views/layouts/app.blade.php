<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'DigiLib SMK') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-200 antialiased overflow-hidden flex h-screen selection:bg-indigo-500 transition-colors duration-300">

    <x-organisms.sidebar />

    <main class="flex-1 h-full overflow-y-auto relative">
        <div class="max-w-7xl mx-auto px-6 lg:px-10 py-10">
            {{ $slot }}
        </div>
    </main>

    @stack('modals')
    @stack('scripts')

    <script>
        // 1. Fungsi Utama (Didaftarkan ke window agar PASTI terbaca oleh onclick)
        window.toggleTheme = function() {
            const html = document.documentElement;
            
            // Paksa membalik class 'dark'
            html.classList.toggle('dark');
            
            // Simpan pilihan ke memori browser
            if (html.classList.contains('dark')) {
                localStorage.theme = 'dark';
            } else {
                localStorage.theme = 'light';
            }
            
            // Update ikon
            updateIcon();
        };

        // 2. Fungsi Update Ikon
        function updateIcon() {
            const isDark = document.documentElement.classList.contains('dark');
            const sun = document.getElementById('iconSun');
            const moon = document.getElementById('iconMoon');
            
            if (sun && moon) {
                if (isDark) {
                    sun.classList.remove('hidden');
                    moon.classList.add('hidden');
                } else {
                    sun.classList.add('hidden');
                    moon.classList.remove('hidden');
                }
            }
        }

        // 3. Setel tema saat halaman pertama kali dibuka
        document.addEventListener('DOMContentLoaded', () => {
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
            updateIcon();
        });
    </script>
</body>
</html>