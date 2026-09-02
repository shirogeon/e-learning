@props(['active'])

<a {{ $attributes->class(['block rounded-md px-3 py-2.5 text-sm font-semibold transition focus:outline-none focus-visible:ring-2 focus-visible:ring-[#18645b]', 'bg-[#e5f0eb] text-[#104841] dark:bg-emerald-950 dark:text-emerald-200' => $active ?? false, 'text-[#59635e] hover:bg-[#f1ede4] hover:text-[#104841] dark:text-slate-300 dark:hover:bg-slate-800' => !($active ?? false)]) }}>
    {{ $slot }}
</a>
