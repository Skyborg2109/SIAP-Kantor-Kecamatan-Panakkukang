<nav x-data="{ open: false }" class="bg-white/95 backdrop-blur-md border-b border-slate-200/80 sticky top-0 z-40 transition-all">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-6">
                <!-- Logo Duo: Kota Makassar & Kecamatan Panakkukang -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 group">
                        <img src="{{ asset('logo kota makassar.png') }}" alt="Logo Kota Makassar" class="h-9 w-auto object-contain drop-shadow-2xs transform group-hover:scale-105 transition-transform duration-200" />
                        <img src="{{ asset('logo kecamatan panakkukang.jpg') }}" alt="Logo Kecamatan Panakkukang" class="h-9 w-auto object-contain rounded-lg shadow-2xs transform group-hover:scale-105 transition-transform duration-200" />
                        <div class="flex flex-col">
                            <div class="flex items-center gap-1.5 leading-none">
                                <span class="font-black text-slate-900 tracking-tight text-base">SIAP</span>
                                <span class="text-[10px] font-bold px-1.5 py-0.5 rounded-md bg-orange-50 text-orange-700 border border-orange-200">PANAKKUKANG</span>
                            </div>
                            <span class="text-[10px] text-slate-500 font-medium">Kecamatan Panakkukang</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:flex sm:items-center">
                    @if(Auth::user()->role === 'ADMIN')
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard') || request()->routeIs('dashboard')">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                            <span>{{ __('Dashboard Admin') }}</span>
                        </x-nav-link>
                        <x-nav-link :href="route('petugas.dashboard')" :active="request()->routeIs('petugas.dashboard')">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <span>{{ __('Panel Petugas') }}</span>
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Right Actions & Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:gap-3">
                <!-- User Dropdown -->
                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2.5 p-1.5 pe-3 rounded-2xl hover:bg-slate-100 focus:outline-none transition duration-150 cursor-pointer border border-transparent hover:border-slate-200">
                            <!-- Initials Avatar with Panakkukang Orange Gradient -->
                            <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-orange-600 to-amber-500 text-white font-black text-xs flex items-center justify-center shadow-xs">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>

                            <div class="text-start">
                                <div class="text-xs font-bold text-slate-800 leading-tight">{{ Auth::user()->name }}</div>
                                <div class="text-[10px] font-semibold text-orange-600 uppercase tracking-wider">
                                    {{ Auth::user()->role ?? 'Petugas' }}
                                </div>
                            </div>

                            <svg class="w-4 h-4 text-slate-400 ms-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- User Header Info -->
                        <div class="px-4 py-3 border-b border-slate-100 bg-slate-50/50">
                            <p class="text-xs font-bold text-slate-900 leading-none">{{ Auth::user()->name }}</p>
                            <p class="text-[11px] text-slate-500 mt-1 truncate">{{ Auth::user()->email }}</p>
                        </div>

                        <!-- Dropdown Links -->
                        <div class="py-1">
                            <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-2 text-xs">
                                <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>{{ __('Pengaturan Profil') }}</span>
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('public.display')" target="_blank" class="flex items-center gap-2 text-xs">
                                <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span>{{ __('Buka Layar Display') }}</span>
                            </x-dropdown-link>
                        </div>

                        <!-- Authentication Logout -->
                        <div class="border-t border-slate-100 py-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        class="flex items-center gap-2 text-xs text-rose-600 hover:text-rose-700 hover:bg-rose-50/50"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    <svg class="w-4 h-4 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    <span>{{ __('Keluar dari Sesi') }}</span>
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Button for Mobile -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-500 hover:text-slate-700 hover:bg-slate-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-b border-slate-200 bg-white px-4 pt-2 pb-4 space-y-3">
        <div class="space-y-1">
            @if(Auth::user()->role === 'ADMIN')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard') || request()->routeIs('dashboard')">
                    {{ __('Dashboard Admin') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('petugas.dashboard')" :active="request()->routeIs('petugas.dashboard')">
                    {{ __('Panel Petugas Pelayanan') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('petugas.dashboard')" :active="request()->routeIs('petugas.dashboard') || request()->routeIs('dashboard')">
                    {{ __('Panel Pelayanan Antrean') }}
                </x-responsive-nav-link>
            @endif
            <x-responsive-nav-link :href="route('public.display')" target="_blank">
                {{ __('Monitor Antrean Publik') }} ↗
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-3 border-t border-slate-100">
            <div class="flex items-center gap-3 px-2 py-1 mb-2">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-orange-600 to-amber-500 text-white font-bold text-xs flex items-center justify-center shadow-xs">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div>
                    <div class="font-bold text-sm text-slate-800">{{ Auth::user()->name }}</div>
                    <div class="font-semibold text-xs text-orange-600 uppercase tracking-wider">{{ Auth::user()->role ?? 'Petugas' }}</div>
                </div>
            </div>

            <div class="space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                    {{ __('Pengaturan Profil') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            class="text-rose-600 hover:bg-rose-50"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Keluar dari Sesi') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
