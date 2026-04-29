<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-8 text-center">
        <h2 class="text-2xl font-bold text-white mb-2">Selamat Datang Kembali!</h2>
        <p class="text-slate-400 text-sm">Silakan masuk ke akun Anda untuk melanjutkan.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <x-atoms.label for="email" value="Email Address" />
            <x-atoms.text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Masukkan email Anda..." />
            <x-atoms.input-error :messages="$errors->get('email')" />
        </div>

        <div>
            <x-atoms.label for="password" value="Password" />
            <x-atoms.text-input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            <x-atoms.input-error :messages="$errors->get('password')" />
        </div>

        <button type="submit" class="w-full flex justify-center items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-indigo-500/30 transition-all hover:-translate-y-0.5">
            Masuk Sekarang
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
        </button>
    </form>
</x-guest-layout>