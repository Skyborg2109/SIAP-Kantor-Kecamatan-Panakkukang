<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

     <?php $__env->slot('header', null, []); ?> 
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h2 class="font-black text-xl text-slate-900 tracking-tight">
                    <?php echo e(__('Pengaturan Profil & Akun')); ?>

                </h2>
                <p class="text-xs text-slate-500 mt-0.5">
                    Kelola data identitas akun petugas dan pengaturan keamanan login Anda.
                </p>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-xs px-3 py-1 rounded-xl bg-indigo-50 text-indigo-700 font-bold border border-indigo-200/60 uppercase">
                    Role: <?php echo e(Auth::user()->role ?? 'Petugas'); ?>

                </span>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-8 sm:py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <!-- Profile Information Card -->
            <div class="p-6 sm:p-8 bg-white rounded-3xl border border-slate-200/80 shadow-xs">
                <div class="max-w-xl">
                    <?php echo $__env->make('profile.partials.update-profile-information-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>

            <!-- Update Password Card -->
            <div class="p-6 sm:p-8 bg-white rounded-3xl border border-slate-200/80 shadow-xs">
                <div class="max-w-xl">
                    <?php echo $__env->make('profile.partials.update-password-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>

            <!-- Delete Account Card -->
            <div class="p-6 sm:p-8 bg-white rounded-3xl border border-rose-100 shadow-xs">
                <div class="max-w-xl">
                    <?php echo $__env->make('profile.partials.delete-user-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>

        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\SIAP-Kantor-Camat-Panakkukang\resources\views/profile/edit.blade.php ENDPATH**/ ?>