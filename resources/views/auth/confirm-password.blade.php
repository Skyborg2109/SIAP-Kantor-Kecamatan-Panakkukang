<x-guest-layout>
    <div class="mb-5 pb-4 border-b border-slate-100">
        <h3 class="text-lg font-bold text-slate-900">Konfirmasi Keamanan</h3>
        <p class="text-xs text-slate-500 mt-1 leading-relaxed">
            Ini adalah area sistem yang dilindungi. Harap masukkan kata sandi Anda kembali untuk melanjutkan.
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Kata Sandi')" />
            <x-text-input 
                id="password" 
                class="block w-full"
                type="password"
                name="password"
                required 
                autocomplete="current-password" 
                placeholder="••••••••"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full">
                <span>{{ __('Konfirmasi & Lanjutkan') }}</span>
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
