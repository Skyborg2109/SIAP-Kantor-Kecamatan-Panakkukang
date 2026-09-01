<section class="space-y-5">
    <header class="flex items-center gap-3 pb-4 border-b border-rose-100">
        <div class="w-10 h-10 rounded-2xl bg-rose-50 border border-rose-100 flex items-center justify-center text-rose-600 shrink-0 shadow-xs">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </div>
        <div>
            <h2 class="text-base font-bold text-slate-900">
                {{ __('Hapus Akun Pengguna') }}
            </h2>
            <p class="text-xs text-slate-500 mt-0.5">
                {{ __('Setelah akun dihapus, seluruh sumber daya dan data terkait akan dihapus secara permanen.') }}
            </p>
        </div>
    </header>

    <div>
        <x-danger-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        >{{ __('Hapus Akun Saya') }}</x-danger-button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 sm:p-8">
            @csrf
            @method('delete')

            <div class="w-12 h-12 rounded-2xl bg-rose-50 border border-rose-100 flex items-center justify-center text-rose-600 mb-4">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>

            <h2 class="text-lg font-black text-slate-900">
                {{ __('Apakah Anda yakin ingin menghapus akun ini?') }}
            </h2>

            <p class="mt-2 text-xs sm:text-sm text-slate-500 leading-relaxed">
                {{ __('Tindakan ini tidak dapat dibatalkan. Masukkan kata sandi Anda untuk mengonfirmasi penghapusan permanen akun ini dari sistem.') }}
            </p>

            <div class="mt-5">
                <x-input-label for="password" value="{{ __('Kata Sandi Konfirmasi') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="block w-full sm:w-3/4"
                    placeholder="{{ __('Masukkan Kata Sandi') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-1.5" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Batal') }}
                </x-secondary-button>

                <x-danger-button>
                    {{ __('Ya, Hapus Akun') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
