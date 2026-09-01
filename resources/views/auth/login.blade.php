<x-guest-layout>
    <!-- Header Form -->
    <div class="mb-5 pb-4 border-b border-slate-100">
        <h3 class="text-lg font-black text-slate-900">Masuk ke Akun Petugas</h3>
        <p class="text-xs text-slate-500 mt-1">
            Gunakan email dan kata sandi yang telah didaftarkan oleh administrator.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Alamat Email')" />
            <x-text-input 
                id="email" 
                class="block w-full" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
                autocomplete="username" 
                placeholder="nama@panakkukang.go.id" 
            />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
        </div>

        <!-- Password -->
        <div x-data="{ show: false }">
            <div class="flex items-center justify-between mb-1.5">
                <x-input-label for="password" :value="__('Kata Sandi')" class="!mb-0" />
                @if (Route::has('password.request'))
                    <a class="text-xs font-semibold text-orange-600 hover:text-orange-700 hover:underline" href="{{ route('password.request') }}">
                        Lupa sandi?
                    </a>
                @endif
            </div>

            <div class="relative">
                <input 
                    id="password" 
                    :type="show ? 'text' : 'password'"
                    name="password"
                    required 
                    autocomplete="current-password" 
                    placeholder="••••••••" 
                    class="border border-slate-300 bg-white text-slate-900 placeholder:text-slate-400 text-sm rounded-xl shadow-2xs focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition-colors py-2.5 px-3.5 pr-10 block w-full"
                />
                <button 
                    type="button" 
                    @click="show = !show" 
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 cursor-pointer"
                    tabindex="-1"
                >
                    <svg x-show="!show" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="show" class="w-4 h-4" style="display: none;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center pt-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input 
                    id="remember_me" 
                    type="checkbox" 
                    class="rounded-md border-slate-300 text-orange-600 shadow-2xs focus:ring-orange-500 focus:ring-offset-0 transition cursor-pointer" 
                    name="remember"
                >
                <span class="ms-2 text-xs font-medium text-slate-600">{{ __('Ingat saya di perangkat ini') }}</span>
            </label>
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <x-primary-button class="w-full">
                <span>{{ __('Masuk ke Sistem') }}</span>
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
