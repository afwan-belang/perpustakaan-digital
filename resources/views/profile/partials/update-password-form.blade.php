<section>
    <header class="mb-6">
        <h2 class="text-xl font-bold text-slate-100">Update Password</h2>
        <p class="mt-1 text-sm text-slate-400">Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div class="space-y-6 max-w-xl">
            <div>
                <x-atoms.label for="update_password_current_password" value="Password Saat Ini" />
                <x-atoms.text-input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password" placeholder="••••••••" />
                <x-atoms.input-error :messages="$errors->updatePassword->get('current_password')" />
            </div>

            <div>
                <x-atoms.label for="update_password_password" value="Password Baru" />
                <x-atoms.text-input id="update_password_password" name="password" type="password" autocomplete="new-password" placeholder="••••••••" />
                <x-atoms.input-error :messages="$errors->updatePassword->get('password')" />
            </div>

            <div>
                <x-atoms.label for="update_password_password_confirmation" value="Konfirmasi Password Baru" />
                <x-atoms.text-input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" placeholder="••••••••" />
                <x-atoms.input-error :messages="$errors->updatePassword->get('password_confirmation')" />
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-slate-800">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-xl font-semibold shadow-lg shadow-indigo-500/30 transition-all hover:-translate-y-0.5">
                Update Password
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-emerald-400 font-medium">Password diperbarui.</p>
            @endif
        </div>
    </form>
</section>