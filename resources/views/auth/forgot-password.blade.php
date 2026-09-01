<x-guest-layout>
    <div class="mb-5 pb-4 border-b border-slate-100">
        <h3 class="text-lg font-bold text-slate-900">Lupa Kata Sandi</h3>
        <p class="text-xs text-slate-500 mt-1 leading-relaxed">
            Masukkan alamat email kedinasan Anda untuk menerima tautan pemulihan kata sandi.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Alamat Email Terdaftar')" />
            <x-text-input 
                id="email" 
                class="block w-full" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
                placeholder="nama@panakkukang.go.id" 
            />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <x-primary-button class="w-full">
                <span>{{ __('Kirim Tautan Pemulihan') }}</span>
            </x-primary-button>
        </div>

        <!-- Back to Login -->
        <div class="pt-3 text-center">
            <a href="{{ route('login') }}" class="text-xs font-medium text-slate-600 hover:text-blue-700 hover:underline">
                ← Kembali ke Halaman Masuk
            </a>
        </div>
    </form>
</x-guest-layout>
