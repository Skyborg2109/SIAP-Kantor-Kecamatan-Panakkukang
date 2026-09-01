@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-medium flex items-start gap-3 shadow-xs']) }}>
        <svg class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div class="flex-1 leading-relaxed">
            {{ $status }}
        </div>
    </div>
@endif
