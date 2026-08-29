<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-250 leading-tight">
            {{ __('Student Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ activeTab: 'courses' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Welcome Banner with Ambient Glow -->
            <div class="bg-gradient-to-r from-slate-900 via-slate-950 to-amber-950/40 text-white rounded-2xl p-8 relative overflow-hidden border border-slate-800 shadow-xl animate-fade-in-up">
                <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
                <div class="absolute -top-10 -right-10 w-72 h-72 bg-amber-500/20 rounded-full filter blur-3xl pointer-events-none animate-pulse-glow"></div>
                <div class="absolute -bottom-10 right-1/3 w-64 h-64 bg-amber-600/10 rounded-full filter blur-3xl pointer-events-none animate-float-slow"></div>

                <div class="relative z-10 space-y-2">
                    <div class="inline-flex items-center space-x-2 px-3 py-1 bg-amber-500/10 border border-amber-500/20 rounded-full text-amber-400 text-xs font-bold uppercase tracking-widest backdrop-blur-sm">
                        <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                        <span>Student Learning Portal</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-black tracking-tight font-serif-display text-white">Hello, {{ auth()->user()->name }}! 🎓</h1>
                    <p class="text-slate-300 text-sm max-w-xl font-sans-interface leading-relaxed">
                        Ready to level up your skills today? Track your ongoing courses, complete modules, and earn verified certificates.
                    </p>
                </div>
            </div>

            <!-- Stats Overview KPI Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1: Enrolled -->
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-200 dark:border-slate-800 p-6 shadow-sm flex items-center justify-between hover-lift animate-scale-up delay-75">
                    <div>
                        <span class="text-xs text-gray-500 dark:text-gray-400 font-bold uppercase tracking-wider block mb-1 font-sans-interface">Enrolled Courses</span>
                        <span class="text-3xl font-black text-slate-900 dark:text-white font-sans-interface">{{ $enrollments->count() }}</span>
                    </div>
                    <div class="p-3.5 bg-amber-50 dark:bg-amber-950/50 text-amber-600 dark:text-amber-400 rounded-xl border border-amber-500/20">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>

                <!-- Card 2: Completed -->
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-200 dark:border-slate-800 p-6 shadow-sm flex items-center justify-between hover-lift animate-scale-up delay-100">
                    <div>
                        <span class="text-xs text-gray-500 dark:text-gray-400 font-bold uppercase tracking-wider block mb-1 font-sans-interface">Completed</span>
                        <span class="text-3xl font-black text-slate-900 dark:text-white font-sans-interface">{{ $enrollments->where('status', 'completed')->count() }}</span>
                    </div>
                    <div class="p-3.5 bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 rounded-xl border border-emerald-500/20">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Card 3: Quiz Attempts -->
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-200 dark:border-slate-800 p-6 shadow-sm flex items-center justify-between hover-lift animate-scale-up delay-150">
                    <div>
                        <span class="text-xs text-gray-500 dark:text-gray-400 font-bold uppercase tracking-wider block mb-1 font-sans-interface">Quiz Attempts</span>
                        <span class="text-3xl font-black text-slate-900 dark:text-white font-sans-interface">{{ auth()->user()->quizAttempts()->count() }}</span>
                    </div>
                    <div class="p-3.5 bg-orange-50 dark:bg-orange-950/40 text-orange-600 dark:text-orange-400 rounded-xl border border-orange-500/20">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                </div>

                <!-- Card 4: Avg Score -->
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-200 dark:border-slate-800 p-6 shadow-sm flex items-center justify-between hover-lift animate-scale-up delay-200">
                    <div>
                        <span class="text-xs text-gray-500 dark:text-gray-400 font-bold uppercase tracking-wider block mb-1 font-sans-interface">Avg Quiz Score</span>
                        <span class="text-3xl font-black text-slate-900 dark:text-white font-sans-interface">
                            {{ number_format(auth()->user()->quizAttempts()->avg('score') ?? 0, 1) }}%
                        </span>
                    </div>
                    <div class="p-3.5 bg-purple-50 dark:bg-purple-950/40 text-purple-600 dark:text-purple-400 rounded-xl border border-purple-500/20">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Interactive Tab Navigation Header -->
            <div class="border-b border-gray-200 dark:border-slate-800 flex space-x-4">
                <button @click="activeTab = 'courses'" :class="activeTab === 'courses' ? 'border-amber-500 text-amber-600 dark:text-amber-400 font-extrabold border-b-2' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 font-semibold'" class="pb-3 px-1 text-sm transition-colors flex items-center space-x-2">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span>My Enrolled Courses</span>
                    <span class="px-2 py-0.5 text-xs rounded-full bg-amber-500/10 text-amber-500 font-mono">{{ $enrollments->count() }}</span>
                </button>

                @php $completedEnrollments = $enrollments->filter(fn($e) => $e->status === 'completed' && $e->certificate); @endphp
                <button @click="activeTab = 'certificates'" :class="activeTab === 'certificates' ? 'border-amber-500 text-amber-600 dark:text-amber-400 font-extrabold border-b-2' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 font-semibold'" class="pb-3 px-1 text-sm transition-colors flex items-center space-x-2">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                    <span>Digital Certificates</span>
                    <span class="px-2 py-0.5 text-xs rounded-full bg-emerald-500/10 text-emerald-500 font-mono">{{ $completedEnrollments->count() }}</span>
                </button>
            </div>

            <!-- Tab 1: Enrolled Courses Content -->
            <div x-show="activeTab === 'courses'" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                @if($enrollments->isEmpty())
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-200 dark:border-slate-800 p-12 text-center shadow-sm">
                        <div class="inline-flex p-4 bg-amber-50 dark:bg-amber-950/50 rounded-full text-amber-500 mb-4 animate-bounce">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2 font-serif-display">No Enrolled Courses Yet</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm max-w-sm mx-auto mb-6">Explore our curated catalog to start learning new programming, design, and business skills.</p>
                        <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 bg-amber-500 hover:bg-amber-600 text-slate-950 rounded-xl font-extrabold text-sm shadow-md shadow-amber-500/10 transition duration-200">
                            Browse Course Catalog &rarr;
                        </a>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($enrollments as $enrollment)
                            @php
                                $course = $enrollment->course;
                                $delays = ['', 'delay-75', 'delay-150', 'delay-200'];
                                $delayClass = $delays[$loop->index % 4];
                            @endphp
                            <div class="group bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-2xl p-6 shadow-sm hover-lift animate-fade-in-up {{ $delayClass }} flex flex-col justify-between">
                                <div>
                                    <div class="flex justify-between items-start">
                                        <span class="px-2.5 py-1 bg-amber-500/10 text-amber-600 dark:text-amber-400 text-[10px] font-extrabold uppercase rounded-md tracking-wider border border-amber-500/20">
                                            {{ $course->category->name }}
                                        </span>
                                        <span class="px-2 py-0.5 text-[10px] font-bold rounded {{ $enrollment->status === 'completed' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300' : 'bg-amber-100 text-amber-800 dark:bg-amber-950 dark:text-amber-300' }} uppercase font-sans">
                                            {{ $enrollment->status }}
                                        </span>
                                    </div>
                                    <h3 class="font-extrabold text-lg text-slate-900 dark:text-white mt-4 mb-1 line-clamp-2 hover:text-amber-500 dark:hover:text-amber-400 transition-colors font-serif-display">
                                        <a href="{{ route('courses.show', $course->slug) }}">{{ $course->title }}</a>
                                    </h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">
                                        Instructor: <span class="font-semibold text-slate-700 dark:text-slate-300">{{ $course->teacher->name }}</span>
                                    </p>
                                </div>

                                <div class="mt-4 border-t border-gray-150 dark:border-slate-800/80 pt-4">
                                    <!-- Progress Bar -->
                                    <div class="flex justify-between items-center text-xs mb-1.5">
                                        <span class="text-gray-400 font-bold uppercase tracking-wider font-sans">Course Progress</span>
                                        <span class="text-amber-600 dark:text-amber-400 font-black">{{ $enrollment->progress_percent }}%</span>
                                    </div>
                                    <div class="w-full bg-slate-100 dark:bg-slate-800 rounded-full h-2 mb-6 overflow-hidden">
                                        <div class="bg-gradient-to-r from-amber-500 to-amber-400 h-2 rounded-full transition-all duration-700 ease-out" style="width: {{ $enrollment->progress_percent }}%"></div>
                                    </div>

                                    <!-- Action buttons -->
                                    <div class="flex flex-col gap-2">
                                        <a href="{{ route('courses.learn', $course->slug) }}" class="w-full inline-flex justify-center items-center px-4 py-2.5 bg-amber-500 hover:bg-amber-600 text-slate-950 rounded-xl text-sm font-extrabold shadow-sm transition duration-200">
                                            <span>Resume Study</span>
                                            <svg class="w-4 h-4 ml-1.5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                            </svg>
                                        </a>
                                        @if($enrollment->status === 'completed' && $enrollment->certificate)
                                            <a href="{{ route('certificates.download', $enrollment->id) }}" target="_blank" class="w-full inline-flex justify-center items-center px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-sm font-bold shadow-sm transition">
                                                <svg class="h-4 w-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                Download Certificate
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Tab 2: Digital Certificates Content -->
            <div x-show="activeTab === 'certificates'" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                @if($completedEnrollments->isEmpty())
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-200 dark:border-slate-800 p-12 text-center shadow-sm">
                        <div class="inline-flex p-4 bg-emerald-50 dark:bg-emerald-950/40 rounded-full text-emerald-500 mb-4">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2 font-serif-display">No Certificates Earned Yet</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm max-w-sm mx-auto">Complete 100% of your enrolled course lessons to automatically claim your verified digital certificate.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($completedEnrollments as $enroll)
                            <div class="flex items-center justify-between p-5 bg-white dark:bg-slate-900 rounded-2xl border border-gray-200 dark:border-slate-800 shadow-sm hover-lift">
                                <div class="flex items-center space-x-4">
                                    <div class="p-3.5 bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 rounded-xl border border-emerald-500/20">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-extrabold text-base text-slate-900 dark:text-white font-serif-display">{{ $enroll->course->title }}</h4>
                                        <p class="text-xs text-gray-400 font-mono">ID: {{ $enroll->certificate->certificate_code }}</p>
                                    </div>
                                </div>
                                <a href="{{ route('certificates.download', $enroll->id) }}" target="_blank" class="px-4 py-2.5 bg-amber-500 hover:bg-amber-600 text-slate-950 rounded-xl text-xs font-extrabold transition duration-200">
                                    View Certificate
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
