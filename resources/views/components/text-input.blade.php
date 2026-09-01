@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border border-slate-300 bg-white text-slate-900 placeholder:text-slate-400 text-sm rounded-xl shadow-2xs focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 transition-colors py-2.5 px-3.5 disabled:bg-slate-100 disabled:text-slate-500 disabled:cursor-not-allowed']) }}>
