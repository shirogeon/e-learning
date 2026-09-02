<x-app-layout>
    <x-slot name="header">
        <div><p class="studio-eyebrow">Platform overview</p><h2>{{ __('Administrator Dashboard') }}</h2></div>
    </x-slot>

    <div class="studio-dashboard py-8 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-400 text-emerald-800 dark:bg-emerald-950/60 dark:border-emerald-800 dark:text-emerald-300 px-4 py-3 rounded-xl relative shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Students Card -->
                <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 border border-gray-200 dark:border-slate-800 shadow-sm flex items-center justify-between hover-lift animate-scale-up">
                    <div>
                        <span class="text-xs text-gray-500 dark:text-gray-400 uppercase font-bold tracking-wider block">Students</span>
                        <span class="text-3xl font-black text-slate-900 dark:text-white font-mono">{{ $stats['students'] }}</span>
                    </div>
                    <div class="p-3.5 bg-amber-50 dark:bg-amber-950/50 text-amber-600 dark:text-amber-400 rounded-xl border border-amber-500/20">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Instructors Card -->
                <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 border border-gray-200 dark:border-slate-800 shadow-sm flex items-center justify-between hover-lift animate-scale-up delay-75">
                    <div>
                        <span class="text-xs text-gray-500 dark:text-gray-400 uppercase font-bold tracking-wider block">Instructors</span>
                        <span class="text-3xl font-black text-slate-900 dark:text-white font-mono">{{ $stats['teachers'] }}</span>
                    </div>
                    <div class="p-3.5 bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 rounded-xl border border-emerald-500/20">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                </div>

                <!-- Courses Card -->
                <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 border border-gray-200 dark:border-slate-800 shadow-sm flex items-center justify-between hover-lift animate-scale-up delay-150">
                    <div>
                        <span class="text-xs text-gray-500 dark:text-gray-400 uppercase font-bold tracking-wider block">Courses</span>
                        <span class="text-3xl font-black text-slate-900 dark:text-white font-mono">{{ $stats['courses'] }}</span>
                    </div>
                    <div class="p-3.5 bg-blue-50 dark:bg-blue-950/40 text-blue-600 dark:text-blue-400 rounded-xl border border-blue-500/20">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>

                <!-- Categories Card -->
                <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 border border-gray-200 dark:border-slate-800 shadow-sm flex items-center justify-between hover-lift animate-scale-up delay-200">
                    <div>
                        <span class="text-xs text-gray-500 dark:text-gray-400 uppercase font-bold tracking-wider block">Categories</span>
                        <span class="text-3xl font-black text-slate-900 dark:text-white font-mono">{{ $stats['categories'] }}</span>
                    </div>
                    <div class="p-3.5 bg-purple-50 dark:bg-purple-950/40 text-purple-600 dark:text-purple-400 rounded-xl border border-purple-500/20">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Content Area: Categories & Add Category Form -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Category Management -->
                <div class="lg:col-span-2 bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-2xl shadow-sm p-6">
                    <h3 class="font-bold text-lg text-slate-900 dark:text-white mb-6 font-serif-display">Course Categories</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-slate-800 text-sm">
                            <thead class="bg-slate-50 dark:bg-slate-950">
                                <tr>
                                    <th class="px-6 py-3.5 text-left font-bold text-gray-700 dark:text-gray-300">Name</th>
                                    <th class="px-6 py-3.5 text-left font-bold text-gray-700 dark:text-gray-300">Slug</th>
                                    <th class="px-6 py-3.5 text-left font-bold text-gray-700 dark:text-gray-300">Courses Count</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-150 dark:divide-slate-800">
                                @foreach($categories as $category)
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/40 transition-colors">
                                        <td class="px-6 py-4 font-bold text-slate-900 dark:text-white font-serif-display">{{ $category->name }}</td>
                                        <td class="px-6 py-4 text-gray-500 dark:text-gray-400 font-mono text-xs">{{ $category->slug }}</td>
                                        <td class="px-6 py-4 text-gray-600 dark:text-gray-300 font-mono">{{ $category->courses_count }} courses</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Add Category Form -->
                <div class="lg:col-span-1 bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-2xl shadow-sm p-6 h-fit">
                    <h3 class="font-bold text-lg text-slate-900 dark:text-white mb-4 font-serif-display">Create Category</h3>
                    <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
                        @csrf
                        
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category Name</label>
                            <input type="text" name="name" id="name" required class="mt-1 block w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-sm shadow-sm">
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                            <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-sm shadow-sm" placeholder="Optional category description..."></textarea>
                        </div>

                        <button type="submit" class="w-full px-4 py-3 bg-amber-500 hover:bg-amber-600 text-slate-950 rounded-xl text-sm font-extrabold shadow-md shadow-amber-500/10 transition duration-200">
                            Create Category
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
