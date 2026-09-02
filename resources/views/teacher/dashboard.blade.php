<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div><p class="studio-eyebrow">Teaching workspace</p><h2>{{ __('Teacher Dashboard') }}</h2></div>
            <a href="{{ route('teacher.courses.create') }}" class="studio-button">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Create new course</span>
            </a>
        </div>
    </x-slot>

    <div class="studio-dashboard py-8 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-400 text-emerald-800 dark:bg-emerald-950/60 dark:border-emerald-800 dark:text-emerald-300 px-4 py-3 rounded-xl relative shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Teacher KPI Overview Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <!-- KPI 1: Active Courses -->
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-200 dark:border-slate-800 p-6 shadow-sm flex items-center justify-between hover-lift animate-scale-up">
                    <div>
                        <span class="text-xs text-gray-500 dark:text-gray-400 font-bold uppercase tracking-wider block mb-1">Created Courses</span>
                        <span class="text-3xl font-black text-slate-900 dark:text-white font-mono">{{ $courses->count() }}</span>
                    </div>
                    <div class="p-3.5 bg-amber-50 dark:bg-amber-950/50 text-amber-600 dark:text-amber-400 rounded-xl border border-amber-500/20">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                </div>

                <!-- KPI 2: Total Students -->
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-200 dark:border-slate-800 p-6 shadow-sm flex items-center justify-between hover-lift animate-scale-up delay-75">
                    <div>
                        <span class="text-xs text-gray-500 dark:text-gray-400 font-bold uppercase tracking-wider block mb-1">Total Enrollments</span>
                        <span class="text-3xl font-black text-slate-900 dark:text-white font-mono">{{ $courses->sum('enrollments_count') }}</span>
                    </div>
                    <div class="p-3.5 bg-blue-50 dark:bg-blue-950/40 text-blue-600 dark:text-blue-400 rounded-xl border border-blue-500/20">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>

                <!-- KPI 3: Pending Grading -->
                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-200 dark:border-slate-800 p-6 shadow-sm flex items-center justify-between hover-lift animate-scale-up delay-150">
                    <div>
                        <span class="text-xs text-gray-500 dark:text-gray-400 font-bold uppercase tracking-wider block mb-1">Pending Submissions</span>
                        <span class="text-3xl font-black text-slate-900 dark:text-white font-mono">{{ $pendingSubmissions->count() }}</span>
                    </div>
                    <div class="p-3.5 bg-purple-50 dark:bg-purple-950/40 text-purple-600 dark:text-purple-400 rounded-xl border border-purple-500/20">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Section 1: My Courses -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-gray-200 dark:border-slate-800 p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-lg text-slate-900 dark:text-white font-serif-display">My Courses</h3>
                    <span class="text-xs text-gray-400 font-mono">Manage Curriculum & Lessons</span>
                </div>
                
                @if($courses->isEmpty())
                    <div class="text-center py-10 bg-slate-50 dark:bg-slate-950 rounded-xl border border-gray-150 dark:border-slate-800">
                        <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">You haven't created any courses yet.</p>
                        <a href="{{ route('teacher.courses.create') }}" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-slate-950 rounded-xl text-xs font-extrabold shadow-sm transition duration-200">
                            Create First Course
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-slate-800 text-sm">
                            <thead class="bg-slate-50 dark:bg-slate-950">
                                <tr>
                                    <th class="px-6 py-3.5 text-left font-bold text-gray-700 dark:text-gray-300">Title</th>
                                    <th class="px-6 py-3.5 text-left font-bold text-gray-700 dark:text-gray-300">Level</th>
                                    <th class="px-6 py-3.5 text-left font-bold text-gray-700 dark:text-gray-300">Enrolled Students</th>
                                    <th class="px-6 py-3.5 text-left font-bold text-gray-700 dark:text-gray-300">Price</th>
                                    <th class="px-6 py-3.5 text-right font-bold text-gray-700 dark:text-gray-300">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-150 dark:divide-slate-800">
                                @foreach($courses as $course)
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/40 transition-colors">
                                        <td class="px-6 py-4 font-bold text-slate-900 dark:text-white font-serif-display">{{ $course->title }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-0.5 text-[10px] font-extrabold uppercase rounded-md bg-amber-500/10 text-amber-500 border border-amber-500/20">
                                                {{ $course->level }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400 font-mono">{{ $course->enrollments_count }} students</td>
                                        <td class="px-6 py-4 text-slate-900 dark:text-white font-black">
                                            {{ $course->price == 0 ? 'FREE' : '$' . number_format($course->price, 2) }}
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('teacher.courses.edit', $course->id) }}" class="inline-flex items-center px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-slate-950 rounded-lg text-xs font-extrabold transition duration-200">
                                                Edit Course &rarr;
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- Section 2: Submissions to Grade -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-gray-200 dark:border-slate-800 p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-lg text-slate-900 dark:text-white font-serif-display">Pending Submissions (Need Grading)</h3>
                    <span class="text-xs text-amber-500 font-bold font-mono">{{ $pendingSubmissions->count() }} Submissions</span>
                </div>
                
                @if($pendingSubmissions->isEmpty())
                    <div class="text-center py-8 bg-slate-50 dark:bg-slate-950 rounded-xl border border-gray-150 dark:border-slate-800">
                        <p class="text-emerald-500 font-bold text-sm">All submissions are graded. Great job! 🎉</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-slate-800 text-sm">
                            <thead class="bg-slate-50 dark:bg-slate-950">
                                <tr>
                                    <th class="px-6 py-3.5 text-left font-bold text-gray-700 dark:text-gray-300">Student</th>
                                    <th class="px-6 py-3.5 text-left font-bold text-gray-700 dark:text-gray-300">Assignment</th>
                                    <th class="px-6 py-3.5 text-left font-bold text-gray-700 dark:text-gray-300">Submitted Date</th>
                                    <th class="px-6 py-3.5 text-right font-bold text-gray-700 dark:text-gray-300">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-150 dark:divide-slate-800">
                                @foreach($pendingSubmissions as $submission)
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/40 transition-colors">
                                        <td class="px-6 py-4 font-bold text-slate-900 dark:text-white">{{ $submission->student->name }}</td>
                                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $submission->assignment->title }}</td>
                                        <td class="px-6 py-4 text-gray-500 dark:text-gray-400 font-mono text-xs">{{ $submission->submitted_at->format('M d, Y H:i') }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('teacher.submissions.grade.show', $submission->id) }}" class="px-3.5 py-1.5 bg-amber-500 hover:bg-amber-600 text-slate-950 rounded-lg text-xs font-extrabold transition duration-200">
                                                Grade Now
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
