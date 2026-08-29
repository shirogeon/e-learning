<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight font-serif-display">
                {{ $quiz->title }}
            </h2>
            <a href="{{ route('courses.learn', $quiz->module->course->slug) }}" class="text-sm font-medium text-amber-600 dark:text-amber-400 hover:text-amber-500 transition-colors">
                &larr; Back to Course Player
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Latest Attempt Score -->
            @if($latestAttempt)
                <div class="p-5 bg-amber-500/10 border border-amber-500/20 rounded-2xl flex justify-between items-center shadow-sm">
                    <div>
                        <h4 class="font-bold text-slate-900 dark:text-white font-serif-display">Your Last Attempt Result</h4>
                        <p class="text-xs text-amber-600 dark:text-amber-400 font-mono mt-0.5">Submitted on: {{ $latestAttempt->completed_at->format('M d, Y H:i') }}</p>
                    </div>
                    <div class="text-3xl font-black text-amber-500 font-mono">
                        {{ $latestAttempt->score }}%
                    </div>
                </div>
            @endif

            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-200 dark:border-slate-800 shadow-sm overflow-hidden p-8 space-y-8">
                <div class="border-b border-gray-150 dark:border-slate-800 pb-5">
                    <span class="px-2.5 py-1 bg-orange-500/10 text-orange-600 dark:text-orange-400 text-[10px] font-extrabold uppercase rounded-md tracking-wider border border-orange-500/20">Course Evaluation Quiz</span>
                    <h1 class="text-3xl font-black text-slate-900 dark:text-white mt-2 mb-2 font-serif-display">{{ $quiz->title }}</h1>
                    <div class="flex items-center space-x-4 text-xs font-bold text-gray-500 dark:text-gray-400 font-mono">
                        <span class="flex items-center space-x-1">
                            <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Time Limit: {{ $quiz->time_limit }} mins</span>
                        </span>
                        <span>&bull;</span>
                        <span>{{ $quiz->questions->count() }} Questions</span>
                    </div>
                </div>

                @if($quiz->questions->isEmpty())
                    <div class="text-center py-10 bg-slate-50 dark:bg-slate-950 rounded-xl border border-gray-150 dark:border-slate-800">
                        <p class="text-gray-500 dark:text-gray-400 text-sm">No questions found in this quiz yet.</p>
                    </div>
                @else
                    <form action="{{ route('quizzes.submit', $quiz->id) }}" method="POST" class="space-y-8">
                        @csrf
                        @foreach($quiz->questions as $qIndex => $question)
                            <div class="space-y-4">
                                <h3 class="font-bold text-slate-900 dark:text-white text-base flex items-start space-x-3">
                                    <span class="w-6 h-6 rounded-full bg-amber-500/10 text-amber-500 text-xs font-black flex items-center justify-center border border-amber-500/20 flex-shrink-0 mt-0.5">{{ $qIndex + 1 }}</span>
                                    <span>{{ $question->question_text }}</span>
                                </h3>
                                
                                <div class="space-y-2.5 pl-9">
                                    @foreach($question->options as $option)
                                        <label class="flex items-center space-x-3 text-sm text-slate-700 dark:text-slate-300 cursor-pointer p-3 rounded-xl border border-gray-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-950/50 hover:bg-amber-500/5 hover:border-amber-500/30 transition-colors">
                                            <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}" required class="h-4 w-4 text-amber-500 border-gray-300 dark:border-slate-700 focus:ring-amber-500 cursor-pointer">
                                            <span class="font-medium text-xs sm:text-sm">{{ $option->option_text }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            @if(!$loop->last)
                                <hr class="border-gray-150 dark:border-slate-800">
                            @endif
                        @endforeach

                        <div class="pt-4 border-t border-gray-150 dark:border-slate-800">
                            <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3.5 bg-amber-500 hover:bg-amber-600 text-slate-950 rounded-xl font-black text-sm shadow-md shadow-amber-500/10 transition duration-200">
                                Submit Quiz Answers &rarr;
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
