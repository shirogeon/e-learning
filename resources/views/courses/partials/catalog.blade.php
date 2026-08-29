<!-- Search & Category Filter Section -->
<div class="mb-10 space-y-6">
    <!-- Live Keyword Search Bar -->
    <form method="GET" action="{{ route('home') }}" class="max-w-2xl mx-auto flex gap-3">
        @if($selectedCategory)
            <input type="hidden" name="category" value="{{ $selectedCategory }}">
        @endif
        <div class="relative flex-grow">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search courses by topic, skill, or keyword..." class="w-full pl-11 pr-4 py-3 bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-2xl text-slate-900 dark:text-slate-100 placeholder-gray-400 text-sm focus:border-amber-500 focus:ring focus:ring-amber-500/20 shadow-sm transition">
        </div>
        <button type="submit" class="px-6 py-3 bg-amber-500 hover:bg-amber-600 text-slate-950 font-extrabold rounded-2xl text-sm shadow-md shadow-amber-500/10 transition duration-200 flex items-center space-x-2 flex-shrink-0">
            <span>Search</span>
        </button>
    </form>

    <!-- Categories Filter Bar -->
    <div>
        <div class="flex items-center justify-between mb-3 border-b border-gray-200 dark:border-slate-800 pb-2">
            <h3 class="font-bold text-base text-slate-900 dark:text-white font-serif-display">Explore by Category</h3>
            @if($selectedCategory || !empty($search))
                <a href="{{ route('home') }}" class="text-xs font-extrabold text-amber-600 dark:text-amber-400 hover:text-amber-500 transition">
                    &times; Reset All Filters
                </a>
            @endif
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('home', array_filter(['search' => $search])) }}" class="px-4 py-1.5 rounded-full text-xs font-bold transition {{ is_null($selectedCategory) ? 'bg-amber-500 text-slate-950 shadow-md shadow-amber-500/10' : 'bg-white dark:bg-slate-900 text-gray-600 dark:text-gray-400 hover:bg-slate-100 dark:hover:bg-slate-800 border border-gray-200 dark:border-slate-800' }}">
                All Categories
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('home', array_filter(['category' => $cat->slug, 'search' => $search])) }}" class="px-4 py-1.5 rounded-full text-xs font-bold transition {{ $selectedCategory === $cat->slug ? 'bg-amber-500 text-slate-950 shadow-md shadow-amber-500/10' : 'bg-white dark:bg-slate-900 text-gray-600 dark:text-gray-400 hover:bg-slate-100 dark:hover:bg-slate-800 border border-gray-200 dark:border-slate-800' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>
    </div>
</div>

<!-- Course Grid -->
@if($courses->isEmpty())
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-16 text-center border border-gray-200 dark:border-gray-800 shadow-sm max-w-lg mx-auto">
        <div class="inline-flex p-4 bg-amber-50 dark:bg-amber-950/30 rounded-full text-amber-600 dark:text-amber-400 mb-4">
            <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
        </div>
        <p class="text-gray-900 dark:text-white font-bold text-lg mb-1">No courses found</p>
        <p class="text-gray-500 dark:text-gray-400 text-sm">We couldn't find any courses in this category at the moment. Check back soon!</p>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($courses as $course)
            @php
                $delays = ['', 'delay-75', 'delay-150', 'delay-200'];
                $delayClass = $delays[$loop->index % 4];
            @endphp
            <div class="group bg-white dark:bg-gray-800 rounded-2xl overflow-hidden border border-gray-200/80 dark:border-gray-700 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 animate-fade-in-up {{ $delayClass }} flex flex-col justify-between">
                <div>
                    <!-- Thumbnail with Gradient -->
                    <div class="h-44 bg-gradient-to-br from-amber-600 to-yellow-600 dark:from-amber-900 dark:to-yellow-950 flex flex-col justify-between p-4 relative overflow-hidden">
                        <!-- Subtle Pattern Overlay -->
                        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
                        
                        <div class="flex justify-between items-start z-10">
                            <span class="px-2.5 py-1 bg-white/20 backdrop-blur-md text-white text-[10px] font-extrabold uppercase rounded-md tracking-wider font-sans-interface">
                                {{ $course->category->name }}
                            </span>
                            <span class="px-2.5 py-1 bg-gray-900/60 backdrop-blur-sm text-white text-[10px] font-extrabold uppercase rounded-md tracking-wider font-sans-interface">
                                {{ $course->level }}
                            </span>
                        </div>

                        <div class="z-10 mt-auto">
                            <h4 class="text-white font-black text-xl leading-tight line-clamp-1 select-none font-serif-display">{{ $course->title }}</h4>
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="p-6">
                        <div class="flex items-center space-x-1.5 mb-2 text-xs font-bold text-amber-600 dark:text-amber-400 uppercase tracking-widest font-sans-interface">
                            <span>{{ $course->category->name }}</span>
                            <span>&bull;</span>
                            <span>{{ $course->level }}</span>
                        </div>
                        <h3 class="font-extrabold text-lg text-slate-900 dark:text-white mb-2 line-clamp-2 hover:text-amber-500 dark:hover:text-amber-400 transition-colors font-serif-display">
                            <a href="{{ route('courses.show', $course->slug) }}">
                                {{ $course->title }}
                            </a>
                        </h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mb-4 line-clamp-3 leading-relaxed font-sans-interface">
                            {{ $course->description }}
                        </p>
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-6 py-4 bg-gray-50/50 dark:bg-gray-900/50 border-t border-gray-150/70 dark:border-gray-800/60 flex justify-between items-center">
                    <div class="flex items-center space-x-3">
                        <div class="h-8 w-8 rounded-full bg-amber-100 dark:bg-amber-950/40 flex items-center justify-center text-amber-600 dark:text-amber-400 font-black text-sm uppercase">
                            {{ substr($course->teacher->name, 0, 1) }}
                        </div>
                        <div>
                            <span class="text-[10px] text-gray-400 block uppercase font-bold tracking-wider">Instructor</span>
                            <span class="text-xs font-bold text-gray-700 dark:text-gray-300">{{ $course->teacher->name }}</span>
                        </div>
                    </div>
                    <div>
                        @if($course->price == 0)
                            <span class="text-xs font-extrabold text-green-700 dark:text-green-400 bg-green-50 dark:bg-green-950/40 border border-green-150 dark:border-green-900/30 px-2.5 py-1 rounded-md">FREE</span>
                        @else
                            <span class="text-lg font-black text-slate-900 dark:text-white">${{ number_format($course->price, 2) }}</span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
