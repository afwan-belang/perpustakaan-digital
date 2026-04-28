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
            <div class="flex justify-between items-center mb-2">
                <x-atoms.label for="password" value="Password" class="!mb-0" />
                @if (Route::has('password.request'))
                    <a class="text-sm font-medium text-indigo-400 hover:text-indigo-300 transition-colors" href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                @endif
            </div>
            <x-atoms.text-input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            <x-atoms.input-error :messages="$errors->get('password')" />
        </div>

        <div class="flex items-center">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" class="rounded border-slate-700 bg-slate-950 text-indigo-500 shadow-sm focus:ring-indigo-500 focus:ring-offset-slate-900 transition-all" name="remember">
                <span class="ms-2 text-sm text-slate-400 group-hover:text-slate-300 transition-colors">Ingat Saya</span>
            </label>
        </div>

        <button type="submit" class="w-full flex justify-center items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-indigo-500/30 transition-all hover:-translate-y-0.5">
            Masuk Sekarang
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
        </button>
    </form>
</x-guest-layout>