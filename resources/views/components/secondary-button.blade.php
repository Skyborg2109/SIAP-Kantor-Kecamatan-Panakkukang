<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-5 py-2.5 bg-white hover:bg-slate-50 border border-slate-200 text-slate-700 font-semibold text-sm rounded-xl shadow-xs hover:border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-300 focus:ring-offset-2 disabled:opacity-50 transition-all duration-200 cursor-pointer']) }}>
    {{ $slot }}
</button>
