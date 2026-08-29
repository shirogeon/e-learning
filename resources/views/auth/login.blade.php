<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Login') }} - {{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased h-full">
    <div class="flex min-h-full">
        <!-- Left Side: Brand & Visuals (Hidden on mobile) -->
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-slate-900 via-slate-950 to-neutral-950 text-white flex-col justify-between p-12 relative overflow-hidden">
            <!-- Decorative circle -->
            <div class="absolute -top-40 -left-40 w-96 h-96 bg-amber-500 rounded-full mix-blend-multiply filter blur-3xl opacity-5"></div>
            <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-yellow-600 rounded-full mix-blend-multiply filter blur-3xl opacity-5"></div>

            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-3 z-10 animate-fade-in hover:opacity-85 transition">
                <div class="p-2 bg-amber-500/10 rounded-lg backdrop-blur-md">
                    <svg class="h-8 w-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <span class="text-2xl font-extrabold tracking-wider bg-clip-text text-transparent bg-gradient-to-r from-amber-200 to-amber-550">E-Learning Portal</span>
            </a>

            <!-- Main text and features -->
            <div class="space-y-6 z-10 my-auto animate-fade-in-up">
                <h1 class="text-4xl font-extrabold leading-tight tracking-tight font-serif-display">
                    Empower Your Learning Journey <br>
                    <span class="text-amber-500">With Expert-Led</span> Courses.
                </h1>
                <p class="text-slate-300 text-lg max-w-md font-sans-interface">
                    Access premium coding courses, practice with interactive quizzes, and earn industry-certified credentials.
                </p>

                <!-- Value Props -->
                <div class="space-y-4 pt-4 animate-fade-in-up delay-75">
                    <div class="flex items-start space-x-3">
                        <div class="mt-1 p-1 bg-amber-500/10 rounded-full text-amber-500">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm">Structured Curriculum</h4>
                            <p class="text-xs text-slate-400">Modules and lessons tailored for quick conceptual mastery.</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="mt-1 p-1 bg-amber-500/10 rounded-full text-amber-500">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm">Interactive Assessments</h4>
                            <p class="text-xs text-slate-400">Instant-graded multiple-choice quizzes and programming tasks.</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="mt-1 p-1 bg-amber-500/10 rounded-full text-amber-500">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm">Verified Credentials</h4>
                            <p class="text-xs text-slate-400">Earn printable, unique PDF certificates upon course completion.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Testimonial -->
            <div class="bg-slate-950/40 border border-slate-800/40 p-4 rounded-xl backdrop-blur-sm z-10 animate-fade-in-up delay-150">
                <p class="text-sm italic text-slate-350">
                    "The structured assignments and quizzes on this platform gave me the confidence to switch my developer stack. Highly recommended!"
                </p>
                <div class="mt-3 flex items-center space-x-2 text-xs text-slate-400">
                    <span class="font-bold text-white">Leon Smith</span>
                    <span class="text-amber-500">&bull;</span>
                    <span class="text-amber-500">Software Engineer</span>
                </div>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center px-6 py-12 sm:px-16 lg:px-24 bg-white dark:bg-gray-900">
            <div class="max-w-md w-full mx-auto space-y-8 animate-fade-in-up delay-75">
                <!-- Mobile Logo -->
                <a href="{{ route('home') }}" class="flex lg:hidden items-center space-x-2 mb-8 hover:opacity-85 transition">
                    <svg class="h-8 w-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span class="text-xl font-bold text-gray-900 dark:text-white">E-Learning Portal</span>
                </a>

                <div class="space-y-4">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center text-xs font-bold text-slate-500 hover:text-amber-600 dark:text-slate-400 dark:hover:text-amber-400 transition group">
                            <svg class="h-4 w-4 mr-1 transform group-hover:-translate-x-1 transition duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Home
                        </a>
                    </div>
                    <div>
                        <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight font-serif-display">Sign In</h2>
                        <p class="mt-1.5 text-sm text-gray-500 dark:text-gray-400 font-sans-interface">
                            New to E-Learning? 
                            <a href="{{ route('register') }}" class="font-bold text-amber-600 hover:text-amber-500 dark:text-amber-400 dark:hover:text-amber-300">
                                Create a free account
                            </a>
                        </p>
                    </div>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="mt-1 block w-full rounded-md border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-sm shadow-sm">
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex justify-between items-center">
                            <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Password</label>
                            @if (Route::has('password.request'))
                                <a class="text-xs font-semibold text-amber-600 hover:text-amber-555 dark:text-amber-400 dark:hover:text-amber-300" href="{{ route('password.request') }}">
                                    {{ __('Forgot password?') }}
                            @endif
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password" class="mt-1 block w-full rounded-md border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-sm shadow-sm">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <!-- Remember Me & Actions -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded bg-slate-50 dark:bg-slate-950 border-slate-300 dark:border-slate-800 text-amber-500 shadow-sm focus:ring-amber-500 dark:focus:ring-amber-500 dark:focus:ring-offset-gray-800" name="remember">
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                        </label>
                    </div>
                    <div>
                        <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-3 bg-amber-500 hover:bg-amber-600 text-slate-950 rounded-md font-extrabold text-sm shadow-md shadow-amber-500/10 transition duration-200">
                            Log In
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
