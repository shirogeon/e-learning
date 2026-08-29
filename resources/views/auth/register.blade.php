<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Register') }} - {{ config('app.name', 'Laravel') }}</title>
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
                <span class="text-2xl font-extrabold tracking-wider bg-clip-text text-transparent bg-gradient-to-r from-amber-200 to-amber-500">E-Learning Portal</span>
            </a>

            <!-- Main text and features -->
            <div class="space-y-6 z-10 my-auto animate-fade-in-up">
                <h1 class="text-4xl font-extrabold leading-tight tracking-tight font-serif-display">
                    Start Learning <br>
                    <span class="text-amber-500">New Skills</span> Today.
                </h1>
                <p class="text-slate-300 text-lg max-w-md font-sans-interface">
                    Create a free account to join thousands of students mastering programming, design, and business.
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
                            <h4 class="font-bold text-sm">Free Core Curriculum</h4>
                            <p class="text-xs text-slate-400">Get access to beginner-friendly intro courses at zero cost.</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="mt-1 p-1 bg-amber-500/10 rounded-full text-amber-500">
                            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm">Self-Paced Timelines</h4>
                            <p class="text-xs text-slate-400">Learn on your own schedule with lifetime course access.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Quote -->
            <div class="text-xs text-slate-400 z-10 font-sans-interface">
                &copy; {{ date('Y') }} E-Learning Portal. Join us and shape your future.
            </div>
        </div>

        <!-- Right Side: Register Form -->
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
                        <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight font-serif-display">Create Account</h2>
                        <p class="mt-1.5 text-sm text-gray-500 dark:text-gray-400 font-sans-interface">
                            Already registered? 
                            <a href="{{ route('login') }}" class="font-bold text-amber-600 hover:text-amber-555 dark:text-amber-400 dark:hover:text-amber-300">
                                Sign in to your account
                            </a>
                        </p>
                    </div>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Full Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" class="mt-1 block w-full rounded-md border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-sm shadow-sm">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" class="mt-1 block w-full rounded-md border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-sm shadow-sm">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password" class="mt-1 block w-full rounded-md border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-sm shadow-sm">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="mt-1 block w-full rounded-md border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-sm shadow-sm">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-3 bg-amber-500 hover:bg-amber-600 text-slate-950 rounded-md font-extrabold text-sm shadow-md shadow-amber-500/10 transition duration-200">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
