<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-slate-900 tracking-tight">
            {{ __('Dashboard Utama') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="bg-gradient-to-r from-indigo-900 via-indigo-800 to-blue-900 rounded-3xl p-8 sm:p-10 text-white shadow-xl relative overflow-hidden">
                <!-- Background Pattern -->
                <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-indigo-500/20 rounded-full blur-2xl pointer-events-none"></div>

                <div class="relative z-10 max-w-2xl">
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-indigo-200 text-xs font-semibold backdrop-blur-sm mb-4 border border-white/10">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        Sistem Informasi Antrian & Pelayanan Kecamatan Panakkukang
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                        Selamat Datang, {{ Auth::user()->name }}! 👋
                    </h1>
                    <p class="text-sm text-indigo-200 mt-2 leading-relaxed">
                        Anda masuk sebagai <span class="font-bold text-white uppercase">{{ Auth::user()->role ?? 'Petugas' }}</span>. Silakan pilih panel kerja di bawah ini untuk memulai pengelolaan pelayanan publik.
                    </p>

                    <div class="mt-6 flex flex-wrap gap-3">
                        @if(Auth::user()->role === 'ADMIN')
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white text-indigo-900 font-bold text-xs hover:bg-indigo-50 shadow-md transition">
                                <svg class="w-4 h-4 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                                <span>Buka Dashboard Admin</span>
                            </a>
                        @endif

                        <a href="{{ route('petugas.dashboard') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-indigo-600 text-white font-bold text-xs hover:bg-indigo-500 shadow-md transition">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <span>Buka Panel Pelayanan Antrean</span>
                        </a>

                        <a href="{{ route('public.display') }}" target="_blank" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-white/10 text-white font-bold text-xs hover:bg-white/20 border border-white/20 transition">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>Layar Monitor Antrean ↗</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
