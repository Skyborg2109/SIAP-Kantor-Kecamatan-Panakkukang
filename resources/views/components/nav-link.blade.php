@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center gap-2 px-3.5 py-2 rounded-xl text-sm font-bold text-orange-700 bg-orange-50/90 border border-orange-200/60 shadow-xs transition-all duration-150'
            : 'inline-flex items-center gap-2 px-3.5 py-2 rounded-xl text-sm font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition-all duration-150';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
