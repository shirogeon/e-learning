<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 border border-transparent rounded-md font-bold text-xs text-slate-950 uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 shadow-sm']) }}>
    {{ $slot }}
</button>
