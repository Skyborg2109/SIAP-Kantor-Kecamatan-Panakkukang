<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h2 class="font-black text-xl text-slate-900 tracking-tight">
                    {{ __('Pengaturan Profil & Akun') }}
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">
                    Kelola data identitas akun petugas dan pengaturan keamanan login Anda.
                </p>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-xs px-3 py-1 rounded-xl bg-indigo-50 text-indigo-700 font-bold border border-indigo-200/60 uppercase">
                    Role: {{ Auth::user()->role ?? 'Petugas' }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-8 sm:py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <!-- Profile Information Card -->
            <div class="p-6 sm:p-8 bg-white rounded-3xl border border-slate-200/80 shadow-xs">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password Card -->
            <div class="p-6 sm:p-8 bg-white rounded-3xl border border-slate-200/80 shadow-xs">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account Card -->
            <div class="p-6 sm:p-8 bg-white rounded-3xl border border-rose-100 shadow-xs">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
