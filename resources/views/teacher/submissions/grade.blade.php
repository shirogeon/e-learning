<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight font-serif-display">
                {{ __('Grade Assignment Submission') }}
            </h2>
            <a href="{{ route('teacher.dashboard') }}" class="text-sm font-medium text-amber-600 dark:text-amber-400 hover:text-amber-500 transition-colors">
                &larr; Back to Teacher Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-2xl shadow-sm p-8 space-y-8">
                
                <div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3 font-serif-display">Assignment Details</h3>
                    <div class="p-5 bg-slate-50 dark:bg-slate-950 rounded-2xl border border-gray-200 dark:border-slate-800 text-sm space-y-2">
                        <span class="text-xs text-gray-400 uppercase font-bold tracking-wider block">Assignment Task</span>
                        <p class="font-bold text-slate-900 dark:text-white text-lg font-serif-display">{{ $submission->assignment->title }}</p>
                        <p class="text-xs text-gray-400 uppercase font-bold tracking-wider block pt-2">Instructions</p>
                        <p class="text-slate-700 dark:text-slate-300 text-sm leading-relaxed">{{ $submission->assignment->description }}</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3 font-serif-display">Student's Submission</h3>
                    <div class="p-5 bg-slate-50 dark:bg-slate-950 rounded-2xl border border-gray-200 dark:border-slate-800 text-sm space-y-4">
                        <div class="flex justify-between items-center pb-3 border-b border-gray-200 dark:border-slate-800">
                            <div>
                                <span class="text-xs text-gray-400 block uppercase font-bold">Student Name</span>
                                <span class="font-bold text-slate-900 dark:text-white text-base">{{ $submission->student->name }}</span>
                            </div>
                            <div class="text-right">
                                <span class="text-xs text-gray-400 block uppercase font-bold">Submitted Date</span>
                                <span class="text-xs text-slate-700 dark:text-slate-300 font-mono">{{ $submission->submitted_at->format('M d, Y H:i') }}</span>
                            </div>
                        </div>

                        @if($submission->text_content)
                            <div>
                                <span class="text-xs text-gray-400 block uppercase font-bold mb-1.5">Text Answer / Submission Link:</span>
                                <div class="p-4 bg-white dark:bg-slate-900 rounded-xl border border-gray-200 dark:border-slate-800 text-sm font-mono whitespace-pre-line text-slate-900 dark:text-slate-100">
                                    {{ $submission->text_content }}
                                </div>
                            </div>
                        @endif

                        @if($submission->file_path)
                            <div class="pt-2">
                                <span class="text-xs text-gray-400 block uppercase font-bold mb-1">Attached Document:</span>
                                <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="inline-flex items-center space-x-2 px-4 py-2 bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/20 rounded-xl font-bold text-xs hover:bg-amber-500/20 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <span>Download Submission File</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-4 font-serif-display">Grading & Feedback</h3>
                    <form action="{{ route('teacher.submissions.grade.store', $submission->id) }}" method="POST" class="space-y-4">
                        @csrf
                        
                        <div>
                            <label for="grade" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Grade Score (0 - 100)</label>
                            <input type="number" step="0.01" name="grade" id="grade" min="0" max="100" required value="{{ old('grade', $submission->grade) }}" class="mt-1 block w-32 rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-sm shadow-sm font-mono font-bold">
                        </div>

                        <div>
                            <label for="feedback" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Instructor Feedback / Comments</label>
                            <textarea name="feedback" id="feedback" rows="4" class="mt-1 block w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-sm shadow-sm" placeholder="Provide constructive feedback and notes to the student...">{{ old('feedback', $submission->feedback) }}</textarea>
                        </div>

                        <div class="flex justify-end space-x-3 border-t border-gray-150 dark:border-slate-800 pt-6">
                            <a href="{{ route('teacher.dashboard') }}" class="px-5 py-2.5 border border-gray-300 dark:border-slate-700 rounded-xl text-sm font-bold text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                                Cancel
                            </a>
                            <button type="submit" class="px-6 py-2.5 bg-amber-500 hover:bg-amber-600 text-slate-950 rounded-xl text-sm font-black shadow-md shadow-amber-500/10 transition duration-200">
                                Save Grade
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
