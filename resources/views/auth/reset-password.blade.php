<x-guest-layout>
    <div class="mb-5 pb-4 border-b border-slate-100">
        <h3 class="text-lg font-bold text-slate-900">Atur Ulang Kata Sandi</h3>
        <p class="text-xs text-slate-500 mt-1">
            Buat kata sandi baru untuk akun Anda.
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Alamat Email')" />
            <x-text-input 
                id="email" 
                class="block w-full" 
                type="email" 
                name="email" 
                :value="old('email', $request->email)" 
                required 
                autofocus 
                autocomplete="username" 
            />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Kata Sandi Baru')" />
            <x-text-input 
                id="password" 
                class="block w-full" 
                type="password" 
                name="password" 
                required 
                autocomplete="new-password" 
                placeholder="Minimal 8 karakter"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi Baru')" />
            <x-text-input 
                id="password_confirmation" 
                class="block w-full"
                type="password"
                name="password_confirmation" 
                required 
                autocomplete="new-password" 
                placeholder="Ulangi kata sandi baru"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <x-primary-button class="w-full">
                <span>{{ __('Perbarui Kata Sandi') }}</span>
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
