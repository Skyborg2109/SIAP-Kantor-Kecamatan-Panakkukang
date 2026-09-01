<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-orange-600 uppercase tracking-wider">Pemerintah Kota Makassar</p>
                <h2 class="text-xl font-extrabold text-slate-900 leading-tight">
                    {{ __('Dashboard Administrator') }} - Kecamatan Panakkukang
                </h2>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('public.display') }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-orange-800 bg-orange-50 border border-orange-200 rounded-xl hover:bg-orange-100 transition shadow-2xs">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>Monitor Antrean</span>
                    <svg class="w-3.5 h-3.5 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-2xl border border-slate-200 p-6 sm:p-8">
                
                <div class="flex space-x-2 mb-6 border-b border-slate-200 pb-4">
                    <button wire:click="$set('tab', 'services')" class="px-4 py-2 text-xs font-bold rounded-xl transition cursor-pointer {{ $tab === 'services' ? 'bg-orange-600 text-white shadow-xs' : 'text-slate-600 hover:bg-slate-100' }}">
                        Daftar Layanan
                    </button>
                    <button wire:click="$set('tab', 'counters')" class="px-4 py-2 text-xs font-bold rounded-xl transition cursor-pointer {{ $tab === 'counters' ? 'bg-orange-600 text-white shadow-xs' : 'text-slate-600 hover:bg-slate-100' }}">
                        Ruang Pelayanan
                    </button>
                    <button wire:click="$set('tab', 'users')" class="px-4 py-2 text-xs font-bold rounded-xl transition cursor-pointer {{ $tab === 'users' ? 'bg-orange-600 text-white shadow-xs' : 'text-slate-600 hover:bg-slate-100' }}">
                        Petugas & Pengguna
                    </button>
                </div>

                @if($tab === 'services')
                    <div class="overflow-x-auto rounded-xl border border-slate-200">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Kode Prefix</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Nama Layanan</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-100">
                                @foreach($services as $service)
                                <tr class="hover:bg-slate-50/70 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-mono font-bold text-orange-700">{{ $service->code }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-900">{{ $service->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-bold rounded-full {{ $service->status ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                            {{ $service->status ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                @if($tab === 'counters')
                    <div class="overflow-x-auto rounded-xl border border-slate-200">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Nama Ruang Pelayanan</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-100">
                                @foreach($counters as $counter)
                                <tr class="hover:bg-slate-50/70 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-slate-500">{{ $counter->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-900">{{ $counter->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-bold rounded-full {{ $counter->status ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                            {{ $counter->status ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                @if($tab === 'users')
                    <div class="overflow-x-auto rounded-xl border border-slate-200">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Role</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Penugasan Ruangan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-100">
                                @foreach($users as $user)
                                <tr class="hover:bg-slate-50/70 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-900">{{ $user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                        <span class="px-2.5 py-0.5 rounded-md text-xs font-bold {{ $user->role === 'ADMIN' ? 'bg-purple-100 text-purple-800' : 'bg-orange-100 text-orange-800' }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $user->counter ? $user->counter->name : '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
