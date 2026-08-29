<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight font-serif-display">
                Edit Course: {{ $course->title }}
            </h2>
            <a href="{{ route('teacher.dashboard') }}" class="text-sm font-medium text-amber-600 dark:text-amber-400 hover:text-amber-500 transition-colors">
                &larr; Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-400 text-emerald-800 dark:bg-emerald-950/60 dark:border-emerald-800 dark:text-emerald-300 px-4 py-3 rounded-xl relative shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Column 1: Course Info Editor -->
                <div class="lg:col-span-1 bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-2xl shadow-sm p-6 h-fit">
                    <h3 class="font-bold text-lg text-slate-900 dark:text-white mb-4 font-serif-display">Course Settings</h3>
                    <form action="{{ route('teacher.courses.update', $course->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                            <input type="text" name="title" id="title" required value="{{ old('title', $course->title) }}" class="mt-1 block w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-sm shadow-sm">
                        </div>

                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                            <select name="category_id" id="category_id" required class="mt-1 block w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-sm shadow-sm">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $course->category_id == $category->id ? 'selected' : '' }} class="bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="level" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Difficulty Level</label>
                            <select name="level" id="level" required class="mt-1 block w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-sm shadow-sm">
                                <option value="beginner" {{ $course->level == 'beginner' ? 'selected' : '' }} class="bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100">Beginner</option>
                                <option value="intermediate" {{ $course->level == 'intermediate' ? 'selected' : '' }} class="bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100">Intermediate</option>
                                <option value="advanced" {{ $course->level == 'advanced' ? 'selected' : '' }} class="bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100">Advanced</option>
                            </select>
                        </div>

                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price (USD)</label>
                            <input type="number" step="0.01" name="price" id="price" required value="{{ old('price', $course->price) }}" class="mt-1 block w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-sm shadow-sm">
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                            <textarea name="description" id="description" rows="5" class="mt-1 block w-full rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-sm shadow-sm">{{ old('description', $course->description) }}</textarea>
                        </div>

                        <button type="submit" class="w-full px-4 py-3 bg-amber-500 hover:bg-amber-600 text-slate-950 rounded-xl text-sm font-extrabold shadow-md shadow-amber-500/10 transition duration-200">
                            Save Changes
                        </button>
                    </form>
                </div>

                <!-- Column 2 & 3: Curriculum Builder -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Add Module Form -->
                    <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-2xl shadow-sm p-6">
                        <h3 class="font-bold text-lg text-slate-900 dark:text-white mb-4 font-serif-display">Add Curriculum Module</h3>
                        <form action="{{ route('teacher.modules.store', $course->id) }}" method="POST" class="flex gap-3">
                            @csrf
                            <input type="text" name="title" required class="flex-grow rounded-xl border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-sm shadow-sm" placeholder="Module Title (e.g. Introduction to PHP)">
                            <button type="submit" class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-slate-950 rounded-xl text-sm font-extrabold shadow-md shadow-amber-500/10 transition duration-200">
                                Add Module
                            </button>
                        </form>
                    </div>

                    <!-- Curriculum List -->
                    @if($course->modules->isEmpty())
                        <div class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-2xl shadow-sm p-12 text-center">
                            <p class="text-gray-500 dark:text-gray-400">No modules added yet. Add a module above to start building the course curriculum.</p>
                        </div>
                    @else
                        <div class="space-y-6">
                            @foreach($course->modules as $modIndex => $module)
                                <div x-data="{ showLesson: false, showQuiz: false, showAssign: false }" class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-2xl shadow-sm p-6 space-y-6">
                                    <div class="flex justify-between items-center border-b border-gray-150 dark:border-slate-800 pb-3">
                                        <h3 class="font-extrabold text-xl text-slate-900 dark:text-white font-serif-display">
                                            Module {{ $modIndex + 1 }}: {{ $module->title }}
                                        </h3>
                                        <span class="text-xs font-extrabold text-amber-500 uppercase tracking-widest bg-amber-500/10 border border-amber-500/20 px-2.5 py-1 rounded-md">
                                            Module {{ $modIndex + 1 }}
                                        </span>
                                    </div>

                                    <!-- List Lessons, Quizzes, Assignments -->
                                    <div class="space-y-4 pl-4 border-l-2 border-gray-150 dark:border-slate-800">
                                        @if($module->lessons->isNotEmpty())
                                            <div>
                                                <h4 class="font-bold text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2">Lessons</h4>
                                                <ul class="space-y-2">
                                                    @foreach($module->lessons as $lesson)
                                                        <li class="bg-slate-50 dark:bg-slate-950 p-3 rounded-xl text-sm text-slate-700 dark:text-slate-300 flex justify-between items-center border border-gray-150 dark:border-slate-800">
                                                            <div>
                                                                <span class="font-bold text-slate-900 dark:text-white">{{ $lesson->title }}</span>
                                                                @if($lesson->video_url)
                                                                    <span class="ml-2 text-[10px] bg-amber-500/10 text-amber-500 border border-amber-500/20 px-2 py-0.5 rounded font-extrabold uppercase">Video</span>
                                                                @endif
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        @if($module->quizzes->isNotEmpty())
                                            <div>
                                                <h4 class="font-bold text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2">Quizzes</h4>
                                                <div class="space-y-4">
                                                    @foreach($module->quizzes as $quiz)
                                                        <div class="bg-orange-500/5 p-4 rounded-xl border border-orange-500/20">
                                                            <div class="flex justify-between items-center mb-3">
                                                                <span class="font-bold text-orange-600 dark:text-orange-400">{{ $quiz->title }} ({{ $quiz->time_limit }} mins)</span>
                                                                <span class="text-[10px] bg-orange-500/10 text-orange-500 border border-orange-500/20 px-2 py-0.5 rounded font-extrabold uppercase">Quiz</span>
                                                            </div>

                                                            @if($quiz->questions->isNotEmpty())
                                                                <ul class="space-y-1 pl-4 list-disc text-xs text-slate-600 dark:text-slate-400 mb-4">
                                                                    @foreach($quiz->questions as $question)
                                                                        <li>{{ $question->question_text }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif

                                                            <form action="{{ route('teacher.questions.store', $quiz->id) }}" method="POST" class="bg-white dark:bg-slate-900 p-4 rounded-xl border border-orange-500/20 space-y-3">
                                                                @csrf
                                                                <h5 class="text-xs font-bold text-orange-500 uppercase">Add Question</h5>
                                                                <div>
                                                                    <input type="text" name="question_text" required placeholder="Question Text" class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-xs py-1.5">
                                                                </div>
                                                                <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                                                                    <input type="text" name="options[0]" required placeholder="Option A" class="rounded-lg border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-xs py-1.5">
                                                                    <input type="text" name="options[1]" required placeholder="Option B" class="rounded-lg border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-xs py-1.5">
                                                                    <input type="text" name="options[2]" required placeholder="Option C" class="rounded-lg border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-xs py-1.5">
                                                                </div>
                                                                <div>
                                                                    <label class="text-xs font-medium text-gray-700 dark:text-gray-300 block mb-1">Correct Option</label>
                                                                    <select name="correct_option" required class="rounded-lg border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-xs py-1.5">
                                                                        <option value="0" class="bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100">Option A</option>
                                                                        <option value="1" class="bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100">Option B</option>
                                                                        <option value="2" class="bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100">Option C</option>
                                                                    </select>
                                                                </div>
                                                                <button type="submit" class="px-3.5 py-1.5 bg-orange-500 hover:bg-orange-600 text-white rounded-lg text-xs font-bold transition">
                                                                    Add Question
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                        @if($module->assignments->isNotEmpty())
                                            <div>
                                                <h4 class="font-bold text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2">Assignments</h4>
                                                <ul class="space-y-2">
                                                    @foreach($module->assignments as $assign)
                                                        <li class="bg-purple-500/5 p-3 rounded-xl border border-purple-500/20 text-sm text-slate-700 dark:text-slate-300 flex justify-between items-center">
                                                            <div>
                                                                <span class="font-bold text-purple-600 dark:text-purple-400">{{ $assign->title }}</span>
                                                                @if($assign->due_date)
                                                                    <span class="ml-2 text-xs text-red-500 font-semibold">Due: {{ $assign->due_date->format('M d, Y H:i') }}</span>
                                                                @endif
                                                            </div>
                                                            <span class="text-[10px] bg-purple-500/10 text-purple-500 border border-purple-500/20 px-2 py-0.5 rounded font-extrabold uppercase">Task</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Collapsible Trigger Action Buttons -->
                                    <div class="border-t border-gray-150 dark:border-slate-800 pt-4 flex flex-wrap gap-3">
                                        <button type="button" @click="showLesson = !showLesson" class="px-3.5 py-1.5 bg-amber-500/10 text-amber-500 border border-amber-500/20 hover:bg-amber-500/20 rounded-xl text-xs font-bold transition flex items-center space-x-1">
                                            <span>+ Lesson</span>
                                        </button>
                                        <button type="button" @click="showQuiz = !showQuiz" class="px-3.5 py-1.5 bg-orange-500/10 text-orange-500 border border-orange-500/20 hover:bg-orange-500/20 rounded-xl text-xs font-bold transition flex items-center space-x-1">
                                            <span>+ Quiz</span>
                                        </button>
                                        <button type="button" @click="showAssign = !showAssign" class="px-3.5 py-1.5 bg-purple-500/10 text-purple-500 border border-purple-500/20 hover:bg-purple-500/20 rounded-xl text-xs font-bold transition flex items-center space-x-1">
                                            <span>+ Assignment</span>
                                        </button>
                                    </div>

                                    <!-- Collapsible Forms -->
                                    <div class="space-y-4">
                                        <!-- Add Lesson form -->
                                        <form x-show="showLesson" x-collapse action="{{ route('teacher.lessons.store', $module->id) }}" method="POST" class="bg-slate-50 dark:bg-slate-950 p-4 rounded-xl border border-gray-200 dark:border-slate-800 space-y-3">
                                            @csrf
                                            <h4 class="font-bold text-xs text-amber-500 uppercase tracking-wider">Add New Lesson</h4>
                                            <input type="text" name="title" required placeholder="Lesson Title" class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-xs py-1.5">
                                            <input type="text" name="video_url" placeholder="Embed Video URL (optional)" class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-xs py-1.5">
                                            <textarea name="content_text" rows="3" placeholder="Lesson content text..." class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-xs py-1.5"></textarea>
                                            <button type="submit" class="w-full py-2 bg-amber-500 hover:bg-amber-600 text-slate-950 font-extrabold rounded-lg text-xs transition duration-200">
                                                Save Lesson
                                            </button>
                                        </form>

                                        <!-- Add Quiz form -->
                                        <form x-show="showQuiz" x-collapse action="{{ route('teacher.quizzes.store', $module->id) }}" method="POST" class="bg-slate-50 dark:bg-slate-950 p-4 rounded-xl border border-gray-200 dark:border-slate-800 space-y-3">
                                            @csrf
                                            <h4 class="font-bold text-xs text-orange-500 uppercase tracking-wider">Add New Quiz</h4>
                                            <input type="text" name="title" required placeholder="Quiz Title" class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-xs py-1.5">
                                            <input type="number" name="time_limit" required placeholder="Time Limit (minutes)" class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-xs py-1.5">
                                            <button type="submit" class="w-full py-2 bg-orange-500 hover:bg-orange-600 text-white font-extrabold rounded-lg text-xs transition duration-200">
                                                Save Quiz
                                            </button>
                                        </form>

                                        <!-- Add Assignment form -->
                                        <form x-show="showAssign" x-collapse action="{{ route('teacher.assignments.store', $module->id) }}" method="POST" class="bg-slate-50 dark:bg-slate-950 p-4 rounded-xl border border-gray-200 dark:border-slate-800 space-y-3">
                                            @csrf
                                            <h4 class="font-bold text-xs text-purple-500 uppercase tracking-wider">Add New Assignment</h4>
                                            <input type="text" name="title" required placeholder="Assignment Title" class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-xs py-1.5">
                                            <textarea name="description" required rows="2" placeholder="Task description..." class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-xs py-1.5"></textarea>
                                            <input type="datetime-local" name="due_date" class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-amber-500 focus:ring focus:ring-amber-500/20 text-xs py-1.5">
                                            <button type="submit" class="w-full py-2 bg-purple-500 hover:bg-purple-600 text-white font-extrabold rounded-lg text-xs transition duration-200">
                                                Save Assignment
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
