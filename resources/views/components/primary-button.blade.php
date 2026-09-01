<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-2.5 bg-orange-600 hover:bg-orange-700 active:bg-orange-800 text-white font-bold text-sm rounded-xl shadow-xs hover:shadow transition duration-150 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer']) }}>
    {{ $slot }}
</button>
