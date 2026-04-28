<x-app-layout>
    <div class="max-w-4xl mx-auto space-y-6">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white tracking-tight mb-2">Pengaturan Profil</h1>
            <p class="text-slate-400">Kelola informasi akun dan pengaturan keamanan Anda di sini.</p>
        </div>

        <div class="bg-slate-900 border border-slate-800/60 rounded-2xl p-6 md:p-8 shadow-xl">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="bg-slate-900 border border-slate-800/60 rounded-2xl p-6 md:p-8 shadow-xl">
            @include('profile.partials.update-password-form')
        </div>

        <div class="bg-red-500/5 border border-red-500/20 rounded-2xl p-6 md:p-8 shadow-xl">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>