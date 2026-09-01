<x-guest-layout>
    <!-- Header Form -->
    <div class="mb-6">
        <div class="w-12 h-12 rounded-2xl bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 mb-3 shadow-xs">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
        </div>
        <h2 class="text-2xl font-black text-slate-900 tracking-tight">Verifikasi Email Anda</h2>
        <p class="text-xs sm:text-sm text-slate-500 mt-1.5 leading-relaxed">
            Terima kasih telah mendaftar! Sebelum memulai, silakan periksa tautan verifikasi yang telah kami kirimkan ke alamat email Anda.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-5 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm font-medium flex items-center gap-2.5">
            <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Tautan verifikasi baru telah berhasil dikirimkan ke email Anda.</span>
        </div>
    @endif

    <div class="space-y-4 pt-2">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button class="w-full py-3">
                <span>{{ __('Kirim Ulang Email Verifikasi') }}</span>
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="text-center">
            @csrf
            <button type="submit" class="text-xs font-semibold text-slate-500 hover:text-rose-600 transition underline underline-offset-2">
                {{ __('Keluar dari Sesi') }}
            </button>
        </form>
    </div>
</x-guest-layout>
