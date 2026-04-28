<section>
    <header class="mb-6">
        <h2 class="text-xl font-bold text-slate-100">Informasi Profil</h2>
        <p class="mt-1 text-sm text-slate-400">Perbarui nama akun dan alamat email Anda.</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">@csrf</form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-atoms.label for="name" value="Nama Lengkap" />
                <x-atoms.text-input id="name" name="name" type="text" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-atoms.input-error :messages="$errors->get('name')" />
            </div>

            <div>
                <x-atoms.label for="email" value="Alamat Email" />
                <x-atoms.text-input id="email" name="email" type="email" :value="old('email', $user->email)" required autocomplete="username" />
                <x-atoms.input-error :messages="$errors->get('email')" />
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-slate-800">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-xl font-semibold shadow-lg shadow-indigo-500/30 transition-all hover:-translate-y-0.5">
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-emerald-400 font-medium">Berhasil disimpan.</p>
            @endif
        </div>
    </form>
</section>