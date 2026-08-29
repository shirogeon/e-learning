@if(auth()->check())
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Course Catalog') }}
                </h2>
                @if(auth()->user()->isStudent())
                    <a href="{{ route('student.dashboard') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md text-sm font-semibold shadow-sm transition">
                        My Dashboard
                    </a>
                @endif
            </div>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @include('courses.partials.catalog')
            </div>
        </div>
    </x-app-layout>
@else
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>{{ config('app.name', 'Laravel E-Learning') }}</title>
            <!-- Fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        </head>
        <body class="bg-slate-50 dark:bg-slate-900 text-slate-900 dark:text-slate-100 font-sans antialiased min-h-screen flex flex-col justify-between">
            <!-- Header/Navbar -->
            <header class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-100 dark:border-slate-800 sticky top-0 z-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex justify-between items-center">
                    <div class="flex items-center space-x-2">
                        <svg class="h-6 w-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <a href="{{ route('home') }}" class="font-extrabold text-xl tracking-tight text-slate-900 dark:text-white">E-Learning Portal</a>
                    </div>
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-slate-600 dark:text-slate-350 hover:text-slate-900 dark:hover:text-white transition">Dashboard</a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-slate-100 dark:bg-slate-850 hover:bg-slate-200 dark:hover:bg-slate-750 text-slate-700 dark:text-slate-250 rounded-md text-sm font-bold transition">
                                    Log Out
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 dark:text-slate-350 hover:text-slate-900 dark:hover:text-white transition">Login</a>
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-slate-950 rounded-md text-sm font-bold shadow-md shadow-amber-500/10 transition">Register</a>
                        @endauth
                    </div>
                </div>
            </header>

            <!-- Hero Section -->
            <section class="bg-gradient-to-br from-slate-900 via-slate-950 to-neutral-950 text-white relative overflow-hidden py-20 lg:py-28 border-b border-slate-900">
                <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:24px_24px]"></div>
                <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-amber-500 rounded-full mix-blend-multiply filter blur-[120px] opacity-5 pointer-events-none"></div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <div class="max-w-3xl space-y-6">
                        <div class="inline-flex items-center space-x-2 px-3.5 py-1.5 rounded-full text-xs font-extrabold bg-amber-500/10 text-amber-400 border border-amber-500/20 shadow-sm animate-pulse">
                            <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                            <span>⚡ Next-Gen Interactive Learning Platform</span>
                        </div>
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-tight text-white font-serif-display">
                            Unlock Your Potential with <br>
                            <span class="bg-clip-text text-transparent bg-gradient-to-r from-amber-400 via-amber-200 to-yellow-500">E-Learning Portal</span>
                        </h1>
                        <p class="text-lg sm:text-xl text-slate-300 leading-relaxed max-w-2xl font-medium font-sans-interface">
                            Join a global community. Learn directly from certified developers and industry experts through guided modules, interactive quizzes, and coding assignments.
                        </p>
                        <div class="flex flex-wrap gap-4 pt-4">
                            @auth
                                <a href="{{ route('dashboard') }}" class="px-6 py-3.5 bg-amber-500 hover:bg-amber-600 text-slate-950 font-extrabold rounded-lg shadow-lg shadow-amber-500/10 text-base transition duration-200">
                                    Go to Dashboard
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="px-6 py-3.5 bg-amber-500 hover:bg-amber-600 text-slate-950 font-extrabold rounded-lg shadow-lg shadow-amber-500/10 text-base transition duration-200">
                                    Get Started Free
                                </a>
                            @endauth
                            <a href="#catalog" class="px-6 py-3.5 bg-white/5 hover:bg-white/10 text-white border border-white/20 font-bold rounded-lg text-base transition duration-200">
                                Browse Catalog
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Stats Bar -->
            <div class="bg-slate-950 border-b border-slate-900 py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                    <div>
                        <span class="text-3xl font-black text-amber-500 dark:text-amber-400 block mb-1">100%</span>
                        <span class="text-xs text-slate-400 uppercase font-bold tracking-widest font-sans-interface">Self-Paced Learning</span>
                    </div>
                    <div>
                        <span class="text-3xl font-black text-amber-500 dark:text-amber-400 block mb-1">20+</span>
                        <span class="text-xs text-slate-400 uppercase font-bold tracking-widest font-sans-interface">Handcrafted Lessons</span>
                    </div>
                    <div>
                        <span class="text-3xl font-black text-amber-500 dark:text-amber-400 block mb-1">100%</span>
                        <span class="text-xs text-slate-400 uppercase font-bold tracking-widest font-sans-interface">Practical Quizzes</span>
                    </div>
                    <div>
                        <span class="text-3xl font-black text-amber-500 dark:text-amber-400 block mb-1">Free</span>
                        <span class="text-xs text-slate-400 uppercase font-bold tracking-widest font-sans-interface">Certification Included</span>
                    </div>
                </div>
            </div>

            <!-- Main Content (Catalog) -->
            <main id="catalog" class="py-16 flex-grow">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
                    <div class="text-center space-y-2">
                        <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">Our Courses</h2>
                        <p class="text-slate-500 dark:text-slate-400 max-w-xl mx-auto">Explore high-quality learning content designed to build real-world capabilities.</p>
                    </div>

                    @include('courses.partials.catalog')
                </div>
            </main>

            <!-- Features Info Section -->
            <section class="bg-slate-100 dark:bg-slate-950 py-16 border-t border-slate-200/65 dark:border-slate-850">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white">Designed For Lifelong Success</h2>
                        <p class="text-slate-500 mt-2 max-w-md mx-auto">Here is how we help you master new capabilities step-by-step.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-200/60 dark:border-slate-800 shadow-sm space-y-4">
                            <div class="p-3 bg-indigo-50 dark:bg-indigo-950/40 text-indigo-600 dark:text-indigo-400 w-fit rounded-xl">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <h3 class="font-extrabold text-lg text-slate-900 dark:text-white">Interactive Syllabus</h3>
                            <p class="text-slate-500 text-sm leading-relaxed">
                                Our syllabus consists of structured modules, markdown lessons, embedded tutorial videos, and discussion boards for peer learning.
                            </p>
                        </div>

                        <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-200/60 dark:border-slate-800 shadow-sm space-y-4">
                            <div class="p-3 bg-indigo-50 dark:bg-indigo-950/40 text-indigo-600 dark:text-indigo-400 w-fit rounded-xl">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                            </div>
                            <h3 class="font-extrabold text-lg text-slate-900 dark:text-white">Instant Quizzes & Tasks</h3>
                            <p class="text-slate-500 text-sm leading-relaxed">
                                Complete multiple-choice quizzes that grade instantly, and upload assignment submissions that get graded by your instructors.
                            </p>
                        </div>

                        <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-200/60 dark:border-slate-800 shadow-sm space-y-4">
                            <div class="p-3 bg-indigo-50 dark:bg-indigo-950/40 text-indigo-600 dark:text-indigo-400 w-fit rounded-xl">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <h3 class="font-extrabold text-lg text-slate-900 dark:text-white">Digital Certifications</h3>
                            <p class="text-slate-500 text-sm leading-relaxed">
                                Achieve 100% completion in any course to instantly generate and print a unique certificate of completion code.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Testimonials -->
            <section class="py-16 bg-white dark:bg-slate-900">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-8">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 dark:text-white">What Our Students Say</h2>
                    
                    <div class="max-w-2xl mx-auto bg-slate-50 dark:bg-slate-850 p-8 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm italic text-slate-600 dark:text-slate-350 relative">
                        <span class="text-6xl text-indigo-200 dark:text-indigo-900 absolute -top-4 left-4 font-serif">“</span>
                        <p class="text-base sm:text-lg relative z-10 leading-relaxed">
                            "The platform's structured lesson player and interactive coding tasks enabled me to master Laravel 11. The printable certificate looks beautiful and is perfect for adding to my professional portfolio!"
                        </p>
                        <div class="mt-4 flex items-center justify-center space-x-2 text-xs">
                            <span class="font-bold text-slate-900 dark:text-white">Sarah Jenkins</span>
                            <span class="text-slate-400">&bull;</span>
                            <span class="text-indigo-600 dark:text-indigo-400 font-semibold">Junior Backend Developer</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Footer -->
            <footer class="bg-slate-900 text-slate-450 border-t border-slate-800 py-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-8 items-center text-center md:text-left">
                    <div class="space-y-3">
                        <div class="flex items-center justify-center md:justify-start space-x-2 text-white">
                            <svg class="h-6 w-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <span class="font-extrabold text-lg tracking-tight">E-Learning Portal</span>
                        </div>
                        <p class="text-sm max-w-sm">Empowering developers and learners with structured, expert-led coursework.</p>
                    </div>
                    <div class="md:text-right text-xs space-y-1">
                        <p>&copy; {{ date('Y') }} E-Learning Portal. All rights reserved.</p>
                        <p class="text-slate-600">Built with Laravel 11 & Tailwind CSS.</p>
                    </div>
                </div>
            </footer>
        </body>
    </html>
@endif
