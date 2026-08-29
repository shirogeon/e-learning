<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight font-serif-display">
                {{ $course->title }}
            </h2>
            <a href="{{ route('student.dashboard') }}" class="text-sm font-medium text-amber-600 dark:text-amber-400 hover:text-amber-500 transition-colors">
                &larr; Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Flash messages -->
            @if(session('success'))
                <div class="mb-4 bg-emerald-50 border border-emerald-400 text-emerald-800 dark:bg-emerald-950/60 dark:border-emerald-800 dark:text-emerald-300 px-4 py-3 rounded-xl relative shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <!-- Left panel: Interactive Accordion Curriculum Sidebar -->
                <div class="lg:col-span-1 bg-white dark:bg-slate-900 rounded-2xl border border-gray-200 dark:border-slate-800 shadow-sm p-5 h-fit max-h-[82vh] overflow-y-auto">
                    <div class="flex justify-between items-center mb-4 border-b border-gray-150 dark:border-slate-800 pb-3">
                        <h3 class="font-bold text-lg text-slate-900 dark:text-white font-serif-display">Course Curriculum</h3>
                        <span class="text-xs font-mono px-2 py-0.5 bg-amber-500/10 text-amber-500 rounded-md font-bold">{{ $course->modules->count() }} Modules</span>
                    </div>

                    <div class="space-y-3">
                        @foreach($course->modules as $modIndex => $module)
                            <div x-data="{ open: true }" class="border border-gray-150 dark:border-slate-800 rounded-xl overflow-hidden">
                                <button @click="open = !open" class="w-full flex items-center justify-between p-3 bg-slate-50 dark:bg-slate-950/60 text-left hover:bg-slate-100 dark:hover:bg-slate-800/50 transition-colors">
                                    <h4 class="font-bold text-xs text-slate-900 dark:text-white uppercase tracking-wider line-clamp-1">
                                        {{ $modIndex + 1 }}. {{ $module->title }}
                                    </h4>
                                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200 flex-shrink-0" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <div x-show="open" x-collapse class="p-2 space-y-1 bg-white dark:bg-slate-900 border-t border-gray-150 dark:border-slate-800/60">
                                    <!-- Lessons -->
                                    @foreach($module->lessons as $les)
                                        @php
                                            $isCompleted = in_array($les->id, $completedLessonIds);
                                            $isActive = isset($activeLesson) && $activeLesson->id === $les->id && !request()->has('assignment_id');
                                        @endphp
                                        <li class="flex items-center justify-between p-2 rounded-lg text-xs {{ $isActive ? 'bg-amber-500/10 border border-amber-500/20 font-extrabold text-amber-600 dark:text-amber-400' : 'text-gray-600 dark:text-gray-400 hover:bg-slate-50 dark:hover:bg-slate-800/60' }}">
                                            <div class="flex items-center space-x-2 truncate">
                                                <form action="{{ route('lessons.complete', $les->id) }}" method="POST" class="inline flex-shrink-0">
                                                    @csrf
                                                    <input type="checkbox" onChange="this.form.submit()" {{ $isCompleted ? 'checked' : '' }} class="h-3.5 w-3.5 text-amber-500 border-gray-300 dark:border-slate-700 rounded focus:ring-amber-500 cursor-pointer">
                                                </form>
                                                <a href="{{ route('courses.learn', ['course' => $course->slug, 'lesson_id' => $les->id]) }}" class="truncate hover:text-amber-500 dark:hover:text-amber-400">
                                                    {{ $les->title }}
                                                </a>
                                            </div>
                                        </li>
                                    @endforeach

                                    <!-- Quizzes -->
                                    @foreach($module->quizzes as $quiz)
                                        <li class="flex items-center p-2 rounded-lg text-xs text-gray-600 dark:text-gray-400 hover:bg-slate-50 dark:hover:bg-slate-800/60">
                                            <svg class="h-3.5 w-3.5 text-orange-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                            </svg>
                                            <a href="{{ route('quizzes.show', $quiz->id) }}" class="truncate hover:text-orange-500">
                                                Quiz: {{ $quiz->title }}
                                            </a>
                                        </li>
                                    @endforeach

                                    <!-- Assignments -->
                                    @foreach($module->assignments as $assign)
                                        @php
                                            $isAssignActive = request()->query('assignment_id') == $assign->id;
                                        @endphp
                                        <li class="flex items-center p-2 rounded-lg text-xs {{ $isAssignActive ? 'bg-purple-500/10 border border-purple-500/20 font-extrabold text-purple-600 dark:text-purple-400' : 'text-gray-600 dark:text-gray-400 hover:bg-slate-50 dark:hover:bg-slate-800/60' }}">
                                            <svg class="h-3.5 w-3.5 text-purple-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                            <a href="{{ route('courses.learn', ['course' => $course->slug, 'assignment_id' => $assign->id]) }}" class="truncate hover:text-purple-500">
                                                Task: {{ $assign->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Right/Center Panel: Interactive Player & Tabbed Content -->
                <div class="lg:col-span-3 space-y-6" x-data="{ contentTab: 'material' }">
                    @if(request()->has('assignment_id'))
                        <!-- Assignment View -->
                        @php
                            $activeAssignment = \App\Models\Assignment::with('submissions')->findOrFail(request('assignment_id'));
                            $mySubmission = $activeAssignment->submissions->where('student_id', auth()->id())->first();
                        @endphp
                        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-200 dark:border-slate-800 shadow-sm p-6 space-y-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <span class="px-2.5 py-1 bg-purple-500/10 text-purple-600 dark:text-purple-400 text-[10px] font-extrabold uppercase rounded-md tracking-wider border border-purple-500/20">Course Assignment</span>
                                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mt-2 font-serif-display">{{ $activeAssignment->title }}</h2>
                                </div>
                                @if($activeAssignment->due_date)
                                    <span class="text-xs text-red-500 font-bold px-3 py-1 bg-red-50 dark:bg-red-950/40 rounded-lg border border-red-200 dark:border-red-900/30">Due: {{ $activeAssignment->due_date->format('M d, Y H:i') }}</span>
                                @endif
                            </div>

                            <div class="prose dark:prose-invert max-w-none text-slate-700 dark:text-slate-300 bg-slate-50 dark:bg-slate-950/50 p-4 rounded-xl border border-gray-150 dark:border-slate-800">
                                <p>{{ $activeAssignment->description }}</p>
                            </div>

                            @if($mySubmission)
                                <div class="bg-slate-50 dark:bg-slate-950 p-5 rounded-xl border border-gray-200 dark:border-slate-800 space-y-3">
                                    <div class="flex justify-between items-center">
                                        <h3 class="font-bold text-base text-slate-900 dark:text-white font-serif-display">Your Submission</h3>
                                        <span class="text-xs text-gray-400 font-mono">{{ $mySubmission->submitted_at->format('M d, Y H:i') }}</span>
                                    </div>
                                    @if($mySubmission->text_content)
                                        <div class="p-3.5 bg-white dark:bg-slate-900 rounded-lg border text-sm font-mono whitespace-pre-line text-slate-900 dark:text-slate-100">
                                            {{ $mySubmission->text_content }}
                                        </div>
                                    @endif
                                    
                                    <div class="pt-3 border-t border-gray-200 dark:border-slate-800">
                                        @if(is_null($mySubmission->grade))
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-500/10 text-amber-500 border border-amber-500/20">Status: Pending Grade</span>
                                        @else
                                            <div class="space-y-1">
                                                <span class="text-xl font-black text-amber-500">Score: {{ $mySubmission->grade }}/100</span>
                                                @if($mySubmission->feedback)
                                                    <p class="text-sm text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-900 p-3 rounded-lg border border-amber-500/20 italic">
                                                        <strong>Feedback:</strong> {{ $mySubmission->feedback }}
                                                    </p>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <!-- Submission Form -->
                            <div class="bg-slate-50 dark:bg-slate-950 p-5 rounded-xl border border-gray-200 dark:border-slate-800">
                                <h3 class="font-bold text-base text-slate-900 dark:text-white mb-4 font-serif-display">{{ $mySubmission ? 'Resubmit Assignment' : 'Submit Assignment Work' }}</h3>
                                <form action="{{ route('submissions.store', $activeAssignment->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Text Answer / Submission Link</label>
                                        <textarea name="text_content" rows="5" class="w-full rounded-xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-sm shadow-sm" placeholder="Type your answer, solution details, or paste public link here...">{{ $mySubmission->text_content ?? '' }}</textarea>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Attach Document File</label>
                                        <input type="file" name="file" class="w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-amber-500/10 file:text-amber-500 hover:file:bg-amber-500/20 transition-colors">
                                    </div>
                                    <button type="submit" class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-slate-950 rounded-xl text-sm font-extrabold shadow-md shadow-amber-500/10 transition duration-200">
                                        Submit Assignment
                                    </button>
                                </form>
                            </div>
                        </div>
                    @elseif($activeLesson)
                        <!-- Lesson Video & Player Container -->
                        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-200 dark:border-slate-800 shadow-sm overflow-hidden">
                            @if($activeLesson->video_url)
                                <div class="aspect-video w-full bg-black">
                                    <iframe src="{{ $activeLesson->video_url }}" class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            @endif
                            
                            <div class="p-6">
                                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-4 border-b border-gray-150 dark:border-slate-800">
                                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white font-serif-display">{{ $activeLesson->title }}</h2>
                                    
                                    @php $isCompleted = in_array($activeLesson->id, $completedLessonIds); @endphp
                                    <form action="{{ route('lessons.complete', $activeLesson->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-5 py-2.5 rounded-xl text-sm font-extrabold border {{ $isCompleted ? 'bg-emerald-50 dark:bg-emerald-950 border-emerald-200 dark:border-emerald-800 text-emerald-700 dark:text-emerald-300' : 'bg-amber-500 hover:bg-amber-600 text-slate-950 border-transparent' }} transition duration-200 flex items-center space-x-1.5">
                                            @if($isCompleted)
                                                <svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                </svg>
                                            @endif
                                            <span>{{ $isCompleted ? 'Completed' : 'Mark as Completed' }}</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Interactive Content Tabs (Material Text vs Discussion Board) -->
                        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-200 dark:border-slate-800 shadow-sm p-6 space-y-6">
                            <div class="border-b border-gray-150 dark:border-slate-800 flex space-x-6">
                                <button @click="contentTab = 'material'" :class="contentTab === 'material' ? 'border-amber-500 text-amber-600 dark:text-amber-400 font-extrabold border-b-2' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 font-semibold'" class="pb-3 text-sm transition-colors flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    <span>Lesson Material</span>
                                </button>

                                <button @click="contentTab = 'discussion'" :class="contentTab === 'discussion' ? 'border-amber-500 text-amber-600 dark:text-amber-400 font-extrabold border-b-2' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 font-semibold'" class="pb-3 text-sm transition-colors flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    <span>Discussion Forum</span>
                                    <span class="px-2 py-0.5 text-xs rounded-full bg-amber-500/10 text-amber-500 font-mono">{{ $course->discussions->count() }}</span>
                                </button>
                            </div>

                            <!-- Tab 1: Lesson Text Material -->
                            <div x-show="contentTab === 'material'" x-transition:enter="transition ease-out duration-200">
                                <div class="prose dark:prose-invert max-w-none text-slate-700 dark:text-slate-300 whitespace-pre-line leading-relaxed text-sm">
                                    {{ $activeLesson->content_text ?: 'No written lesson text provided for this module.' }}
                                </div>
                            </div>

                            <!-- Tab 2: Discussion Forum -->
                            <div x-show="contentTab === 'discussion'" x-transition:enter="transition ease-out duration-200" x-cloak>
                                <form action="{{ route('discussions.store', $course->id) }}" method="POST" class="mb-8">
                                    @csrf
                                    <div class="flex gap-3">
                                        <input type="text" name="message" required class="flex-grow rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-sm shadow-sm" placeholder="Ask a question or post a discussion message...">
                                        <button type="submit" class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-slate-950 rounded-xl text-sm font-extrabold shadow-md shadow-amber-500/10 transition duration-200">
                                            Post
                                        </button>
                                    </div>
                                </form>

                                @if($course->discussions->whereNull('parent_id')->isEmpty())
                                    <div class="text-center py-8 bg-slate-50 dark:bg-slate-950 rounded-xl border border-gray-150 dark:border-slate-800">
                                        <p class="text-gray-500 dark:text-gray-400 text-sm">No discussions yet. Be the first to start the conversation!</p>
                                    </div>
                                @else
                                    <div class="space-y-4">
                                        @foreach($course->discussions->whereNull('parent_id') as $post)
                                            <div class="bg-slate-50 dark:bg-slate-950 p-4 rounded-xl border border-gray-200 dark:border-slate-800">
                                                <div class="flex items-center space-x-2 mb-2 text-xs text-gray-500 dark:text-gray-400">
                                                    <span class="font-bold text-slate-900 dark:text-white">{{ $post->user->name }}</span>
                                                    <span>&bull;</span>
                                                    <span>{{ $post->created_at->diffForHumans() }}</span>
                                                </div>
                                                <p class="text-slate-800 dark:text-slate-200 text-sm mb-3">{{ $post->message }}</p>

                                                <!-- Reply list -->
                                                <div class="ml-6 space-y-3 border-l-2 border-gray-200 dark:border-slate-800 pl-4 mb-3">
                                                    @foreach($post->replies as $reply)
                                                        <div class="text-sm">
                                                            <div class="flex items-center space-x-2 text-xs text-gray-500 dark:text-gray-400 mb-1">
                                                                <span class="font-bold text-slate-900 dark:text-white">{{ $reply->user->name }}</span>
                                                                <span>&bull;</span>
                                                                <span>{{ $reply->created_at->diffForHumans() }}</span>
                                                            </div>
                                                            <p class="text-slate-700 dark:text-slate-300 text-xs">{{ $reply->message }}</p>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <!-- Reply Form -->
                                                <form action="{{ route('discussions.store', $course->id) }}" method="POST" class="ml-6 flex gap-2">
                                                    @csrf
                                                    <input type="hidden" name="parent_id" value="{{ $post->id }}">
                                                    <input type="text" name="message" required class="flex-grow rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-xs py-1.5 shadow-sm" placeholder="Reply to thread...">
                                                    <button type="submit" class="px-3.5 py-1.5 bg-amber-500 hover:bg-amber-600 text-slate-950 rounded-lg text-xs font-bold transition duration-200">
                                                        Reply
                                                    </button>
                                                </form>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-200 dark:border-slate-800 shadow-sm p-12 text-center">
                            <p class="text-gray-500 dark:text-gray-400">This course does not have any active lessons yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
