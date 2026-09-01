@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center gap-2.5 w-full px-4 py-2.5 rounded-xl text-sm font-bold text-orange-700 bg-orange-50 border border-orange-200/60 shadow-xs transition duration-150'
            : 'flex items-center gap-2.5 w-full px-4 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-50 transition duration-150';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
