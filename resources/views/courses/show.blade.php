<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight font-serif-display">
                {{ $course->title }}
            </h2>
            <a href="{{ route('home') }}" class="text-sm font-medium text-amber-600 dark:text-amber-400 hover:text-amber-500 transition-colors">
                &larr; Back to Catalog
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-emerald-50 border border-emerald-400 text-emerald-800 dark:bg-emerald-950/60 dark:border-emerald-800 dark:text-emerald-300 px-4 py-3 rounded-2xl relative shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left panel: details & curriculum -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Course Overview Card -->
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-200 dark:border-slate-800 shadow-sm p-8 space-y-6">
                        <div class="flex items-center space-x-2">
                            <span class="px-3 py-1 bg-amber-500/10 text-amber-600 dark:text-amber-400 text-xs font-extrabold uppercase rounded-lg border border-amber-500/20">
                                {{ $course->category->name }}
                            </span>
                            <span class="px-3 py-1 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-xs font-extrabold uppercase rounded-lg border border-slate-200 dark:border-slate-700">
                                Level: {{ ucfirst($course->level) }}
                            </span>
                        </div>
                        <h1 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white leading-tight font-serif-display">{{ $course->title }}</h1>
                        <p class="text-slate-600 dark:text-slate-300 text-base sm:text-lg leading-relaxed">{{ $course->description }}</p>
                        
                        <div class="border-t border-gray-150 dark:border-slate-800 pt-6 flex items-center space-x-4">
                            <div class="flex-shrink-0 h-12 w-12 rounded-full bg-amber-100 dark:bg-amber-950/50 flex items-center justify-center font-black text-amber-600 dark:text-amber-400 border border-amber-500/20">
                                {{ substr($course->teacher->name, 0, 2) }}
                            </div>
                            <div>
                                <span class="text-xs text-gray-400 font-bold uppercase tracking-wider block">Lead Instructor</span>
                                <span class="text-base font-bold text-slate-900 dark:text-white font-serif-display">{{ $course->teacher->name }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Curriculum Card -->
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-200 dark:border-slate-800 shadow-sm p-8 space-y-6">
                        <div class="flex justify-between items-center border-b border-gray-150 dark:border-slate-800 pb-4">
                            <h2 class="text-2xl font-bold text-slate-900 dark:text-white font-serif-display">Course Curriculum</h2>
                            <span class="text-xs font-mono font-bold text-amber-500 bg-amber-500/10 px-3 py-1 rounded-lg">{{ $course->modules->count() }} Modules</span>
                        </div>
                        
                        @if($course->modules->isEmpty())
                            <p class="text-gray-500 dark:text-gray-400 py-4 text-center">Curriculum is being prepared by the instructor.</p>
                        @else
                            <div class="space-y-4">
                                @foreach($course->modules as $index => $module)
                                    <div x-data="{ open: true }" class="border border-gray-200 dark:border-slate-800 rounded-2xl overflow-hidden shadow-sm">
                                        <button @click="open = !open" class="w-full bg-slate-50 dark:bg-slate-950/60 px-5 py-4 flex justify-between items-center text-left hover:bg-slate-100 dark:hover:bg-slate-800/40 transition">
                                            <div class="flex items-center space-x-3">
                                                <span class="w-6 h-6 rounded-full bg-amber-500/10 text-amber-500 text-xs font-extrabold flex items-center justify-center border border-amber-500/20">{{ $index + 1 }}</span>
                                                <h3 class="font-bold text-slate-900 dark:text-white text-sm sm:text-base font-serif-display">
                                                    {{ $module->title }}
                                                </h3>
                                            </div>
                                            <div class="flex items-center space-x-3">
                                                <span class="text-xs text-gray-400 font-mono">
                                                    {{ $module->lessons->count() }} Lessons
                                                </span>
                                                <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </div>
                                        </button>
                                        <div x-show="open" x-collapse class="divide-y divide-gray-100 dark:divide-slate-800/60 bg-white dark:bg-slate-900 border-t border-gray-150 dark:border-slate-800">
                                            @foreach($module->lessons as $les)
                                                <div class="px-5 py-3.5 flex items-center space-x-3 text-sm text-slate-700 dark:text-slate-300">
                                                    <svg class="h-4 w-4 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <span class="font-medium text-xs sm:text-sm">{{ $les->title }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Reviews Card -->
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-200 dark:border-slate-800 shadow-sm p-8 space-y-6">
                        <div class="flex justify-between items-center border-b border-gray-150 dark:border-slate-800 pb-4">
                            <h2 class="text-2xl font-bold text-slate-900 dark:text-white font-serif-display">Student Reviews</h2>
                            <div class="flex items-center space-x-1.5 px-3 py-1 bg-amber-500/10 rounded-xl border border-amber-500/20">
                                <svg class="h-5 w-5 text-amber-400 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="font-black text-slate-900 dark:text-white text-sm">{{ number_format($averageRating, 1) }} / 5.0</span>
                            </div>
                        </div>

                        <!-- Add Review Form (only for enrolled students) -->
                        @if(auth()->check() && auth()->user()->isStudent() && $isEnrolled)
                            <div class="bg-slate-50 dark:bg-slate-950 p-5 rounded-2xl border border-gray-200 dark:border-slate-800">
                                <h3 class="font-bold text-sm text-slate-900 dark:text-white mb-3 font-serif-display">Leave a Review</h3>
                                <form action="{{ route('reviews.store', $course->id) }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label for="rating" class="block text-xs font-bold text-gray-500 uppercase mb-1">Rating</label>
                                        <select name="rating" id="rating" required class="rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 text-sm py-2 px-3 focus:border-amber-500 focus:ring focus:ring-amber-500/20">
                                            <option value="5">⭐⭐⭐⭐⭐ (5 - Excellent)</option>
                                            <option value="4">⭐⭐⭐⭐ (4 - Very Good)</option>
                                            <option value="3">⭐⭐⭐ (3 - Good)</option>
                                            <option value="2">⭐⭐ (2 - Fair)</option>
                                            <option value="1">⭐ (1 - Poor)</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="comment" class="block text-xs font-bold text-gray-500 uppercase mb-1">Feedback Comment</label>
                                        <textarea name="comment" id="comment" rows="3" placeholder="Tell other students about your experience in this course..." class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 text-sm focus:border-amber-500 focus:ring focus:ring-amber-500/20"></textarea>
                                    </div>
                                    <button type="submit" class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-slate-950 rounded-xl text-xs font-extrabold shadow-sm transition">
                                        Submit Review
                                    </button>
                                </form>
                            </div>
                        @endif

                        <!-- Reviews List -->
                        @if($course->reviews->isEmpty())
                            <p class="text-gray-500 dark:text-gray-400 text-sm italic py-4 text-center">No reviews yet for this course.</p>
                        @else
                            <div class="divide-y divide-gray-150 dark:divide-slate-800 space-y-4">
                                @foreach($course->reviews as $review)
                                    <div class="pt-4 first:pt-0">
                                        <div class="flex justify-between items-center text-xs text-gray-500 dark:text-gray-400 mb-1">
                                            <span class="font-bold text-slate-900 dark:text-white">{{ $review->student->name }}</span>
                                            <div class="flex items-center text-amber-400">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <svg class="h-4 w-4 {{ $i <= $review->rating ? 'fill-current text-amber-400' : 'text-gray-300 dark:text-gray-700' }}" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                @endfor
                                            </div>
                                        </div>
                                        <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">{{ $review->comment }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Right panel: enroll sidebar -->
                <div class="space-y-6">
                    <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 border border-gray-200 dark:border-slate-800 shadow-sm sticky top-24 space-y-6">
                        <div class="text-center py-4 border-b border-gray-150 dark:border-slate-800">
                            <span class="text-xs text-gray-400 uppercase font-bold tracking-wider block mb-1">Course Price</span>
                            @if($course->price == 0)
                                <span class="text-4xl font-black text-emerald-500">FREE</span>
                            @else
                                <span class="text-4xl font-black text-slate-900 dark:text-white font-mono">${{ number_format($course->price, 2) }}</span>
                            @endif
                        </div>

                        <!-- Action Button -->
                        @guest
                            <a href="{{ route('login') }}" class="w-full inline-flex justify-center items-center px-6 py-3.5 bg-amber-500 hover:bg-amber-600 text-slate-950 rounded-xl font-extrabold shadow-md shadow-amber-500/10 transition">
                                Login to Enroll
                            </a>
                        @else
                            @if(auth()->user()->isStudent())
                                @if($isEnrolled)
                                    <a href="{{ route('courses.learn', $course->slug) }}" class="w-full inline-flex justify-center items-center px-6 py-3.5 bg-emerald-500 hover:bg-emerald-600 text-slate-950 rounded-xl font-extrabold shadow-md shadow-emerald-500/10 transition">
                                        Resume Learning &rarr;
                                    </a>
                                @else
                                    <form action="{{ route('courses.enroll', $course->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3.5 bg-amber-500 hover:bg-amber-600 text-slate-950 rounded-xl font-extrabold shadow-md shadow-amber-500/10 transition">
                                            Enroll in Course
                                        </button>
                                    </form>
                                @endif
                            @else
                                <div class="p-4 bg-slate-50 dark:bg-slate-950 text-center text-xs text-gray-500 rounded-xl border border-gray-200 dark:border-slate-800">
                                    Logged in as {{ ucfirst(auth()->user()->role) }}. Only students can enroll.
                                </div>
                            @endif
                        @endguest

                        <div class="space-y-3 pt-2 text-xs text-slate-600 dark:text-slate-400">
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Full lifetime access to course lessons</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Interactive quizzes & coding assignments</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Shareable completion certificate code</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
