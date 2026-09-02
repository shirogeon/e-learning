@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'studio-field disabled:cursor-not-allowed disabled:opacity-60 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100']) }}>
