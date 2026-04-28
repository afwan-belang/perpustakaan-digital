<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DigiLib SMK') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-950 text-slate-200 antialiased flex items-center justify-center min-h-screen selection:bg-indigo-500 selection:text-white p-6">
    
    <div class="w-full max-w-md">
        <div class="flex justify-center mb-8">
            <a href="/" class="flex flex-col items-center gap-3 group">
                <div class="bg-indigo-500/10 text-indigo-400 p-4 rounded-2xl group-hover:bg-indigo-500 group-hover:text-white transition-all duration-300 shadow-lg">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <span class="font-bold text-2xl tracking-tight text-white">DigiLib<span class="text-indigo-500">SMK</span></span>
            </a>
        </div>

        <div class="bg-slate-900 border border-slate-800/60 shadow-2xl rounded-3xl p-8">
            {{ $slot }}
        </div>
    </div>

</body>
</html>