<div>
     <?php $__env->slot('header', null, []); ?> 
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-orange-600 uppercase tracking-wider">Pemerintah Kota Makassar</p>
                <h2 class="text-xl font-extrabold text-slate-900 leading-tight">
                    <?php echo e(__('Panel Petugas Pelayanan')); ?> - Kecamatan Panakkukang
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Ruang Pelayanan: <span class="font-bold text-slate-700"><?php echo e($counter->name ?? 'Tidak Ditugaskan'); ?></span></p>
            </div>
            <div class="flex items-center gap-2">
                <a href="<?php echo e(route('public.display')); ?>" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold text-orange-800 bg-orange-50 border border-orange-200 rounded-xl hover:bg-orange-100 transition shadow-2xs">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>Monitor Antrean</span>
                    <svg class="w-3.5 h-3.5 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </a>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('success')): ?>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="flex items-center gap-3 p-4 text-sm font-medium text-emerald-800 bg-emerald-50 border border-emerald-200 rounded-xl shadow-2xs">
                <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span><?php echo e(session('success')); ?></span>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('error')): ?>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="flex items-center gap-3 p-4 text-sm font-medium text-rose-800 bg-rose-50 border border-rose-200 rounded-xl shadow-2xs">
                <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span><?php echo e(session('error')); ?></span>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col xl:flex-row gap-6">

                
                <section aria-labelledby="active-queues-heading" class="flex-1 xl:w-3/5">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-1 h-6 rounded-full bg-orange-500"></div>
                        <div>
                            <h3 id="active-queues-heading" class="text-base font-extrabold text-slate-900">Antrean Sedang Dilayani</h3>
                            <p class="text-xs text-slate-500">Status real-time pelayanan</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <?php
                                $activeBatchQueues = $activeBatchQueuesByService[$service->id] ?? [];
                                $currentQueue = $activeBatchQueues[0] ?? null;
                                $isActive = $currentQueue !== null;
                                $isKtp = $service->code === 'KTP';
                            ?>

                            <article class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden transition hover:shadow-md">
                                
                                <div class="px-4 py-3 border-b border-slate-100 <?php echo e($isKtp ? 'bg-gradient-to-r from-orange-50 to-orange-50/50' : 'bg-gradient-to-r from-emerald-50 to-emerald-50/50'); ?>">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-2.5">
                                            <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg text-xs font-black font-mono <?php echo e($isKtp ? 'bg-orange-500 text-white' : 'bg-emerald-500 text-white'); ?> shadow-xs">
                                                <?php echo e($service->code); ?>

                                            </span>
                                            <div>
                                                <h4 class="text-sm font-bold text-slate-900 leading-tight"><?php echo e($service->name); ?></h4>
                                            </div>
                                        </div>
                                        <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold <?php echo e($isActive ? ($isKtp ? 'bg-orange-100 text-orange-700' : 'bg-emerald-100 text-emerald-700') : 'bg-slate-100 text-slate-500'); ?>">
                                            <span class="w-1.5 h-1.5 rounded-full <?php echo e($isActive ? ($isKtp ? 'bg-orange-500 animate-pulse' : 'bg-emerald-500 animate-pulse') : 'bg-slate-400'); ?>"></span>
                                            <?php echo e($isActive ? 'Aktif' : 'Standby'); ?>

                                        </span>
                                    </div>
                                </div>

                                
                                <div class="px-4 py-4">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($activeBatchQueues) > 1): ?>
                                        <div class="text-center">
                                            <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-2"><?php echo e(count($activeBatchQueues)); ?> nomor bersamaan</p>
                                            <div class="flex justify-center gap-1.5">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $activeBatchQueues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $queue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                                    <div class="rounded-lg border <?php echo e($isKtp ? 'border-orange-200 bg-orange-50' : 'border-emerald-200 bg-emerald-50'); ?> px-2.5 py-2 min-w-[60px]">
                                                        <span class="block text-[9px] font-bold uppercase tracking-widest <?php echo e($isKtp ? 'text-orange-500' : 'text-emerald-500'); ?>">Nomor</span>
                                                        <span class="block mt-0.5 text-base font-black font-mono <?php echo e($isKtp ? 'text-orange-900' : 'text-emerald-900'); ?>"><?php echo e($queue->number); ?></span>
                                                    </div>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                            </div>
                                        </div>
                                    <?php elseif($currentQueue): ?>
                                        <div class="text-center py-2">
                                            <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">Nomor Aktif</p>
                                            <p class="text-5xl font-black font-mono tracking-tight <?php echo e($isKtp ? 'text-orange-600' : 'text-emerald-600'); ?>"><?php echo e($currentQueue->number); ?></p>
                                        </div>
                                    <?php else: ?>
                                        <div class="text-center py-6">
                                            <div class="w-10 h-10 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <p class="mt-2 text-sm font-semibold text-slate-600">Belum ada antrean</p>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>

                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isActive): ?>
                                    <div class="px-4 py-2.5 border-t border-slate-100 bg-slate-50/50">
                                        <div class="grid grid-cols-3 gap-1.5">
                                            <button wire:click="recallService(<?php echo e($service->id); ?>)" type="button" class="inline-flex items-center justify-center gap-1 px-2 py-1.5 <?php echo e($isKtp ? 'bg-orange-500 hover:bg-orange-600' : 'bg-emerald-500 hover:bg-emerald-600'); ?> text-white font-bold text-[10px] rounded-lg shadow-xs transition cursor-pointer">
                                                <svg class="w-3 h-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077.637-1.707.707L5.586 15z" />
                                                </svg>
                                                <span>Ulangi</span>
                                            </button>
                                            <button wire:click="completeService(<?php echo e($service->id); ?>)" type="button" class="inline-flex items-center justify-center gap-1 px-2 py-1.5 bg-slate-700 hover:bg-slate-800 text-white font-bold text-[10px] rounded-lg shadow-xs transition cursor-pointer">
                                                <svg class="w-3 h-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span>Selesai</span>
                                            </button>
                                            <button wire:click="skipService(<?php echo e($service->id); ?>)" type="button" class="inline-flex items-center justify-center gap-1 px-2 py-1.5 bg-amber-500 hover:bg-amber-600 text-white font-bold text-[10px] rounded-lg shadow-xs transition cursor-pointer">
                                                <svg class="w-3 h-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                                </svg>
                                                <span>Lewati</span>
                                            </button>
                                        </div>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </article>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <div class="sm:col-span-2 p-6 text-center rounded-2xl border border-slate-200 bg-white text-sm text-slate-500">
                                Layanan antrean KTP dan IKD belum tersedia atau belum aktif.
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </section>

                
                <section aria-labelledby="next-queue-heading" class="xl:w-2/5 xl:min-w-[320px]">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-1 h-6 rounded-full bg-slate-700"></div>
                        <div>
                            <h3 id="next-queue-heading" class="text-base font-extrabold text-slate-900">Panggil Antrean</h3>
                            <p class="text-xs text-slate-500">Pilih jumlah & panggil</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden space-y-0 divide-y divide-slate-100">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <?php
                                $count = $batchCounts[$service->id] ?? 1;
                                $isKtp = $service->code === 'KTP';
                            ?>

                            <div class="p-4">
                                <div class="flex items-center gap-2.5 mb-3">
                                    <span class="px-2.5 py-1 rounded-lg text-xs font-black font-mono <?php echo e($isKtp ? 'bg-orange-500 text-white' : 'bg-emerald-500 text-white'); ?> shadow-xs"><?php echo e($service->code); ?></span>
                                    <div>
                                        <p class="text-sm font-bold text-slate-900 leading-tight"><?php echo e($service->name); ?></p>
                                    </div>
                                </div>

                                
                                <div class="flex items-center justify-between mb-3 p-2.5 bg-slate-50 rounded-xl border border-slate-100">
                                    <span class="text-[11px] font-semibold text-slate-600">Jumlah</span>
                                    <div class="flex items-center border border-slate-300 rounded-lg overflow-hidden bg-white shadow-2xs">
                                        <button wire:click="decrementBatch(<?php echo e($service->id); ?>)" type="button" class="px-2.5 py-1 text-slate-600 hover:bg-slate-100 text-sm font-bold transition cursor-pointer" title="Kurangi">−</button>
                                        <span class="px-2.5 py-1 text-sm font-black text-slate-800 min-w-[32px] text-center font-mono border-x border-slate-200"><?php echo e($count); ?></span>
                                        <button wire:click="incrementBatch(<?php echo e($service->id); ?>)" type="button" class="px-2.5 py-1 text-slate-600 hover:bg-slate-100 text-sm font-bold transition cursor-pointer" title="Tambah">+</button>
                                    </div>
                                </div>

                                
                                <button wire:click="callNext(<?php echo e($service->id); ?>)" type="button" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 <?php echo e($isKtp ? 'bg-orange-600 hover:bg-orange-700 active:bg-orange-800' : 'bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800'); ?> text-white font-bold text-xs rounded-xl shadow-xs transition cursor-pointer">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                    </svg>
                                    <span><?php echo e($count > 1 ? 'Panggil '.$count.' Antrean' : 'Panggil Antrean'); ?></span>
                                </button>

                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($specificServiceId === $service->id): ?>
                                    <div class="mt-3 p-3 bg-slate-50 rounded-xl border border-slate-200" x-data="{ focus: true }" x-init="$nextTick(() => $refs.specificInput.focus())">
                                        <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1.5">Masukkan Nomor</label>
                                        <div class="flex gap-2 items-center">
                                            <div class="flex items-center border border-slate-300 rounded-lg overflow-hidden bg-white shadow-2xs">
                                                <span class="px-3 py-2 text-sm font-black font-mono <?php echo e($isKtp ? 'text-orange-600 bg-orange-50' : 'text-emerald-600 bg-emerald-50'); ?> border-r border-slate-200"><?php echo e($service->code); ?>-</span>
                                                <input
                                                    wire:model.live.debounce.300ms="specificNumber"
                                                    x-ref="specificInput"
                                                    type="text"
                                                    inputmode="numeric"
                                                    pattern="[0-9]*"
                                                    maxlength="4"
                                                    placeholder="1"
                                                    class="w-20 px-3 py-2 text-sm font-mono font-bold text-slate-900 border-0 focus:ring-0 outline-none transition"
                                                    wire:keydown.enter="callSpecific"
                                                />
                                            </div>
                                            <button
                                                wire:click="callSpecific"
                                                type="button"
                                                <?php echo e($specificNumber === '' ? 'disabled' : ''); ?>

                                                class="px-3 py-2 <?php echo e($specificNumber === '' ? 'bg-slate-300 cursor-not-allowed' : ($isKtp ? 'bg-orange-600 hover:bg-orange-700 cursor-pointer' : 'bg-emerald-600 hover:bg-emerald-700 cursor-pointer')); ?> text-white font-bold text-xs rounded-lg shadow-xs transition inline-flex items-center gap-1"
                                            >
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                                </svg>
                                                Panggil
                                            </button>
                                            <button
                                                wire:click="setSpecificService(null)"
                                                type="button"
                                                class="px-3 py-2 bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold text-xs rounded-lg transition cursor-pointer"
                                            >Batal</button>
                                        </div>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($specificNumber !== ''): ?>
                                            <p class="mt-1.5 text-[10px] font-bold <?php echo e($isKtp ? 'text-orange-500' : 'text-emerald-500'); ?>">Preview: <?php echo e($service->code); ?>-<?php echo e(preg_replace('/[^0-9]/', '', $specificNumber)); ?></p>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <button
                                        wire:click="setSpecificService(<?php echo e($service->id); ?>)"
                                        type="button"
                                        class="mt-2 w-full inline-flex items-center justify-center gap-1.5 px-3 py-2 text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg transition cursor-pointer border border-dashed border-slate-300"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                        <span>Panggil Nomor Spesifik</span>
                                    </button>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                </section>

            </div>
        </div>
    </div>
</div><?php /**PATH C:\laragon\www\SIAP-Kantor-Camat-Panakkukang\resources\views/livewire/petugas-dashboard.blade.php ENDPATH**/ ?>