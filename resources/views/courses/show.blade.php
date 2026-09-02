<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div><p class="studio-eyebrow">Course library</p><h2>{{ $course->title }}</h2></div>
            <a href="{{ route('home') }}" class="studio-text-button">← Back to catalog</a>
        </div>
    </x-slot>

    <div class="py-8 sm:py-12">
        <div class="studio-container">
            @if(session('success'))
                <div class="mb-6 rounded-md border border-emerald-300 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800 dark:border-emerald-900 dark:bg-emerald-950 dark:text-emerald-200">{{ session('success') }}</div>
            @endif

            <div class="grid gap-8 lg:grid-cols-[minmax(0,1fr)_20rem]">
                <div class="space-y-7">
                    <article class="studio-card p-6 sm:p-8 dark:border-slate-700 dark:bg-slate-900">
                        <div class="flex flex-wrap gap-2"><span class="studio-badge">{{ $course->category->name }}</span><span class="studio-badge">{{ ucfirst($course->level) }}</span></div>
                        <h1 class="mt-5 max-w-3xl text-3xl leading-tight text-[#203331] sm:text-4xl dark:text-white">{{ $course->title }}</h1>
                        <p class="mt-5 max-w-3xl text-base leading-7 text-[#5b6660] dark:text-slate-300">{{ $course->description }}</p>
                        <div class="mt-7 flex items-center gap-3 border-t border-[#d8d4c9] pt-5 dark:border-slate-700"><span class="grid h-10 w-10 place-items-center rounded-full bg-[#dcebe5] text-sm font-bold text-[#104841]">{{ strtoupper(substr($course->teacher->name, 0, 1)) }}</span><div><p class="studio-eyebrow">Instructor</p><p class="mt-1 text-sm font-bold text-[#203331] dark:text-white">{{ $course->teacher->name }}</p></div></div>
                    </article>

                    <section class="studio-card p-6 sm:p-8 dark:border-slate-700 dark:bg-slate-900">
                        <div class="flex flex-col gap-2 border-b border-[#d8d4c9] pb-5 sm:flex-row sm:items-center sm:justify-between dark:border-slate-700"><div><p class="studio-eyebrow">Learning path</p><h2 class="mt-2 text-2xl text-[#203331] dark:text-white">Course curriculum</h2></div><span class="studio-badge">{{ $course->modules->count() }} modules</span></div>
                        @if($course->modules->isEmpty())
                            <p class="py-10 text-center text-sm text-[#68716b] dark:text-slate-400">Curriculum is being prepared by the instructor.</p>
                        @else
                            <div class="mt-5 divide-y divide-[#d8d4c9] dark:divide-slate-700">
                                @foreach($course->modules as $index => $module)
                                    <div x-data="{ open: true }" class="py-1">
                                        <button @click="open = !open" class="flex w-full items-center justify-between gap-4 py-4 text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-[#18645b]">
                                            <span class="flex items-center gap-3"><span class="font-serif-display text-xl text-[#b77928]">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span><span class="text-base font-bold text-[#203331] dark:text-white">{{ $module->title }}</span></span>
                                            <span class="flex items-center gap-3 text-xs font-semibold text-[#68716b] dark:text-slate-400">{{ $module->lessons->count() }} lessons <svg class="h-4 w-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6" /></svg></span>
                                        </button>
                                        <div x-show="open" x-collapse class="mb-3 ml-8 border-l border-[#d8d4c9] pl-4 dark:border-slate-700">
                                            @forelse($module->lessons as $les)
                                                <div class="flex items-center gap-3 py-2 text-sm text-[#59635e] dark:text-slate-300"><span class="h-1.5 w-1.5 rounded-full bg-[#b77928]"></span>{{ $les->title }}</div>
                                            @empty
                                                <p class="py-2 text-sm text-[#68716b] dark:text-slate-400">Lessons will be added soon.</p>
                                            @endforelse
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </section>

                    <section class="studio-card p-6 sm:p-8 dark:border-slate-700 dark:bg-slate-900">
                        <div class="flex items-end justify-between gap-4 border-b border-[#d8d4c9] pb-5 dark:border-slate-700"><div><p class="studio-eyebrow">Feedback</p><h2 class="mt-2 text-2xl text-[#203331] dark:text-white">Student reviews</h2></div><span class="font-serif-display text-2xl text-[#82571a]">{{ number_format($averageRating, 1) }}<span class="font-sans text-sm text-[#68716b] dark:text-slate-400"> / 5</span></span></div>
                        @if(auth()->check() && auth()->user()->isStudent() && $isEnrolled)
                            <div class="studio-inset mt-6 p-4 dark:border-slate-700 dark:bg-slate-800"><h3 class="text-lg text-[#203331] dark:text-white">Leave a review</h3><form action="{{ route('reviews.store', $course->id) }}" method="POST" class="mt-4 grid gap-4">@csrf <label class="text-sm font-semibold text-[#42504c] dark:text-slate-300">Rating<select name="rating" id="rating" required class="studio-field mt-1 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"><option value="5">5 — Excellent</option><option value="4">4 — Very good</option><option value="3">3 — Good</option><option value="2">2 — Fair</option><option value="1">1 — Poor</option></select></label><label class="text-sm font-semibold text-[#42504c] dark:text-slate-300">Feedback<textarea name="comment" id="comment" rows="3" placeholder="Tell other students about your experience in this course..." class="studio-field mt-1 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100"></textarea></label><div><button type="submit" class="studio-button">Submit review</button></div></form></div>
                        @endif
                        @if($course->reviews->isEmpty())
                            <p class="py-8 text-center text-sm text-[#68716b] dark:text-slate-400">No reviews yet for this course.</p>
                        @else
                            <div class="mt-5 divide-y divide-[#d8d4c9] dark:divide-slate-700">@foreach($course->reviews as $review)<article class="py-5 first:pt-0"><div class="flex items-center justify-between gap-4"><p class="text-sm font-bold text-[#203331] dark:text-white">{{ $review->student->name }}</p><p class="text-xs font-bold text-[#82571a]">{{ $review->rating }} / 5</p></div><p class="mt-2 text-sm leading-6 text-[#59635e] dark:text-slate-300">{{ $review->comment }}</p></article>@endforeach</div>
                        @endif
                    </section>
                </div>

                <aside class="lg:sticky lg:top-6 lg:h-fit">
                    <div class="studio-card p-6 dark:border-slate-700 dark:bg-slate-900">
                        <p class="studio-eyebrow">Enrollment</p>
                        <div class="mt-3 border-b border-[#d8d4c9] pb-5 dark:border-slate-700">@if($course->price == 0)<p class="font-serif-display text-4xl text-[#104841] dark:text-emerald-300">Free</p>@else<p class="font-serif-display text-4xl text-[#203331] dark:text-white">${{ number_format($course->price, 2) }}</p>@endif</div>
                        <div class="mt-5">
                            @guest
                                <a href="{{ route('login') }}" class="studio-button w-full">Login to enroll</a>
                            @else
                                @if(auth()->user()->isStudent())
                                    @if($isEnrolled)<a href="{{ route('courses.learn', $course->slug) }}" class="studio-button w-full">Resume learning <span aria-hidden="true">→</span></a>
                                    @else<form action="{{ route('courses.enroll', $course->id) }}" method="POST">@csrf <button type="submit" class="studio-button w-full">Enroll in course</button></form>@endif
                                @else
                                    <p class="studio-inset p-3 text-center text-xs leading-5 text-[#68716b] dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400">Logged in as {{ ucfirst(auth()->user()->role) }}. Only students can enroll.</p>
                                @endif
                            @endguest
                        </div>
                        <ul class="mt-6 space-y-3 border-t border-[#d8d4c9] pt-5 text-sm text-[#59635e] dark:border-slate-700 dark:text-slate-300"><li class="flex gap-2"><span class="text-[#18645b]">✓</span>Full access to course lessons</li><li class="flex gap-2"><span class="text-[#18645b]">✓</span>Interactive quizzes and assignments</li><li class="flex gap-2"><span class="text-[#18645b]">✓</span>Completion certificate code</li></ul>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</x-app-layout>
