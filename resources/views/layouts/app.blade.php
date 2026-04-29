<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DigiLib SMK') }}</title>

    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }
        
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        /* Premium Scrollbar Design (No Layout Shift) */
        .auto-hide-scroll { scrollbar-gutter: stable; }
        .auto-hide-scroll::-webkit-scrollbar { width: 14px; }
        .auto-hide-scroll::-webkit-scrollbar-track { background: transparent; }
        .auto-hide-scroll::-webkit-scrollbar-thumb {
            background-color: transparent; 
            border: 4px solid transparent; 
            background-clip: padding-box;
            border-radius: 9999px;
            transition: background-color 0.3s ease; 
        }

        .show-scroll .auto-hide-scroll::-webkit-scrollbar-thumb { background-color: #cbd5e1; }
        .dark.show-scroll .auto-hide-scroll::-webkit-scrollbar-thumb { background-color: #334155; }

        .show-scroll .auto-hide-scroll::-webkit-scrollbar-thumb:hover,
        .show-scroll .auto-hide-scroll::-webkit-scrollbar-thumb:active { background-color: #94a3b8; }
        
        .dark.show-scroll .auto-hide-scroll::-webkit-scrollbar-thumb:hover,
        .dark.show-scroll .auto-hide-scroll::-webkit-scrollbar-thumb:active { background-color: #6366f1; }

        /* Firefox Fallback */
        .auto-hide-scroll { scrollbar-width: thin; scrollbar-color: transparent transparent; transition: scrollbar-color 0.3s ease; }
        .show-scroll .auto-hide-scroll { scrollbar-color: #cbd5e1 transparent; }
        .dark.show-scroll .auto-hide-scroll { scrollbar-color: #334155 transparent; }
    </style>
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-200 antialiased overflow-hidden flex h-screen selection:bg-indigo-500 selection:text-white transition-colors duration-300">

    <x-organisms.sidebar />

    <main class="flex-1 h-full overflow-y-auto auto-hide-scroll relative">
        <div class="max-w-7xl mx-auto px-6 lg:px-10 py-10">
            {{ $slot }}
        </div>
    </main>

    @stack('modals')
    @stack('scripts')

    <script>
        // 1. LOGIKA DETEKSI SUDUT KANAN (SCROLLBAR)
        document.addEventListener('mousemove', (e) => {
            if (window.innerWidth - e.clientX < 35) {
                document.documentElement.classList.add('show-scroll');
            } else {
                document.documentElement.classList.remove('show-scroll');
            }
        });

        // 2. LOGIKA TEMA (DARK/LIGHT MODE)
        window.toggleTheme = function() {
            const html = document.documentElement;
            html.classList.toggle('dark');
            
            if (html.classList.contains('dark')) {
                localStorage.theme = 'dark';
            } else {
                localStorage.theme = 'light';
            }
            updateIcon();
        };

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

        // Cukup perbarui icon saat halaman selesai dimuat (Tema sudah ditentukan di <head>)
        document.addEventListener('DOMContentLoaded', updateIcon);
    </script>
</body>
</html>