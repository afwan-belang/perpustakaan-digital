<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-bold text-white mb-2">Buat Akun Baru</h2>
        <p class="text-slate-400 text-sm">Bergabunglah untuk mulai membaca koleksi kami.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <div>
            <x-atoms.label for="name" value="Nama Lengkap" />
            <x-atoms.text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Masukkan nama Anda..." />
            <x-atoms.input-error :messages="$errors->get('name')" />
        </div>

        <div>
            <x-atoms.label for="email" value="Alamat Email" />
            <x-atoms.text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="email@contoh.com" />
            <x-atoms.input-error :messages="$errors->get('email')" />
        </div>

        <div>
            <x-atoms.label for="password" value="Password" />
            <x-atoms.text-input id="password" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            <x-atoms.input-error :messages="$errors->get('password')" />
        </div>

        <div>
            <x-atoms.label for="password_confirmation" value="Konfirmasi Password" />
            <x-atoms.text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-atoms.input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <div class="flex items-center justify-between pt-4">
            <a class="text-sm font-medium text-indigo-400 hover:text-indigo-300 transition-colors" href="{{ route('login') }}">
                Sudah punya akun?
            </a>

            <button type="submit" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-indigo-500/30 transition-all hover:-translate-y-0.5">
                Daftar
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
            </button>
        </div>
    </form>
</x-guest-layout>