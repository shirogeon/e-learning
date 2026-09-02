<div class="space-y-8">
    <form method="GET" action="{{ route('home') }}" class="studio-card grid gap-3 p-3 sm:grid-cols-[minmax(0,1fr)_auto] sm:p-4 dark:border-slate-700 dark:bg-slate-900">
        @if($selectedCategory)
            <input type="hidden" name="category" value="{{ $selectedCategory }}">
        @endif
        <label class="relative block">
            <span class="sr-only">Search courses</span>
            <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-[#68716b]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35m2.35-5.65a8 8 0 1 1-16 0 8 8 0 0 1 16 0Z" /></svg>
            <input type="search" name="search" value="{{ $search ?? '' }}" placeholder="Cari topik, keahlian, atau kata kunci" class="studio-field pl-10 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100">
        </label>
        <button type="submit" class="studio-button">Cari kelas</button>
    </form>

    <div class="border-y border-[#d8d4c9] py-4 dark:border-slate-700">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <p class="studio-eyebrow">Jelajahi berdasarkan kategori</p>
            @if($selectedCategory || !empty($search))
                <a href="{{ route('home') }}" class="studio-text-button text-sm">Hapus filter <span aria-hidden="true">×</span></a>
            @endif
        </div>
        <div class="mt-3 flex flex-wrap gap-x-5 gap-y-2">
            <a href="{{ route('home', array_filter(['search' => $search])) }}" class="text-sm font-semibold {{ is_null($selectedCategory) ? 'text-[#104841] underline decoration-[#b77928] decoration-2 underline-offset-4 dark:text-emerald-300' : 'text-[#68716b] hover:text-[#104841] dark:text-slate-400' }}">All categories</a>
            @foreach($categories as $cat)
                <a href="{{ route('home', array_filter(['category' => $cat->slug, 'search' => $search])) }}" class="text-sm font-semibold {{ $selectedCategory === $cat->slug ? 'text-[#104841] underline decoration-[#b77928] decoration-2 underline-offset-4 dark:text-emerald-300' : 'text-[#68716b] hover:text-[#104841] dark:text-slate-400' }}">{{ $cat->name }}</a>
            @endforeach
        </div>
    </div>

    @if($courses->isEmpty())
        <div class="studio-card p-10 text-center dark:border-slate-700 dark:bg-slate-900">
            <p class="studio-eyebrow">Belum ada hasil</p>
            <h3 class="mt-2 text-2xl text-[#203331] dark:text-white">Kelas yang kamu cari belum tersedia.</h3>
            <p class="mx-auto mt-3 max-w-md text-sm leading-6 text-[#68716b] dark:text-slate-400">Coba ubah kata kunci atau lihat semua kategori untuk menemukan pilihan lain.</p>
            <a href="{{ route('home') }}" class="studio-outline-button mt-6">Lihat semua kelas</a>
        </div>
    @else
        <div class="border-t border-[#d8d4c9] dark:border-slate-700">
            @foreach($courses as $course)
                <article class="group grid gap-5 border-b border-[#d8d4c9] py-6 sm:grid-cols-[4rem_minmax(0,1fr)_auto] sm:items-start sm:gap-6 dark:border-slate-700">
                    <div class="font-serif-display text-3xl text-[#b77928]">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                    <div>
                        <div class="flex flex-wrap items-center gap-2"><span class="studio-badge">{{ $course->category->name }}</span><span class="text-xs font-semibold text-[#68716b] dark:text-slate-400">{{ ucfirst($course->level) }}</span></div>
                        <h3 class="mt-3 text-2xl leading-tight text-[#203331] transition group-hover:text-[#104841] dark:text-white dark:group-hover:text-emerald-300"><a href="{{ route('courses.show', $course->slug) }}">{{ $course->title }}</a></h3>
                        <p class="mt-2 max-w-2xl text-sm leading-6 text-[#68716b] dark:text-slate-400">{{ $course->description }}</p>
                        <p class="mt-4 text-xs text-[#68716b] dark:text-slate-400">Instruktur <span class="font-bold text-[#42504c] dark:text-slate-200">{{ $course->teacher->name }}</span></p>
                    </div>
                    <div class="flex items-center justify-between gap-4 sm:min-w-32 sm:flex-col sm:items-end">
                        @if($course->price == 0)
                            <span class="studio-badge">Gratis</span>
                        @else
                            <span class="font-serif-display text-2xl text-[#203331] dark:text-white">${{ number_format($course->price, 2) }}</span>
                        @endif
                        <a href="{{ route('courses.show', $course->slug) }}" class="studio-text-button whitespace-nowrap">Lihat kelas <span aria-hidden="true">→</span></a>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
</div>
