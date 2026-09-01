<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['disabled' => false]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['disabled' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<input <?php if($disabled): echo 'disabled'; endif; ?> <?php echo e($attributes->merge(['class' => 'border border-slate-300 bg-white text-slate-900 placeholder:text-slate-400 text-sm rounded-xl shadow-2xs focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition-colors py-2.5 px-3.5 disabled:bg-slate-100 disabled:text-slate-500 disabled:cursor-not-allowed'])); ?>>
<?php /**PATH C:\laragon\www\SIAP-Kantor-Camat-Panakkukang\resources\views/components/text-input.blade.php ENDPATH**/ ?>