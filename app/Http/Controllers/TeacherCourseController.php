<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Option;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class TeacherCourseController extends Controller
{
    public function dashboard(Request $request): Response
    {
        $teacher = $request->user();
        $courses = Course::where('teacher_id', $teacher->id)
            ->withCount('enrollments')
            ->latest()
            ->get();

        $courseIds = $courses->pluck('id');

        $pendingSubmissions = Submission::whereNull('grade')
            ->whereHas('assignment.module', function ($q) use ($courseIds) {
                $q->whereIn('course_id', $courseIds);
            })
            ->with(['assignment', 'student'])
            ->latest()
            ->get();

        return response()->view('teacher.dashboard', compact('courses', 'pendingSubmissions'));
    }

    public function create(): Response
    {
        $categories = Category::all();

        return response()->view('teacher.courses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'level' => 'required|in:beginner,intermediate,advanced',
            'price' => 'required|numeric|min:0',
        ]);

        $course = Course::create([
            'category_id' => $request->category_id,
            'teacher_id' => $request->user()->id,
            'title' => $request->title,
            'slug' => Str::slug($request->title).'-'.rand(100, 999),
            'description' => $request->description,
            'level' => $request->level,
            'price' => $request->price,
        ]);

        return redirect()->route('teacher.courses.edit', $course->id)
            ->with('success', 'Course created successfully. Now add some modules and lessons!');
    }

    public function edit(Course $course): Response
    {
        if ($course->teacher_id !== auth()->id()) {
            abort(403);
        }

        $course->load(['modules.lessons', 'modules.quizzes.questions.options', 'modules.assignments.submissions']);
        $categories = Category::all();

        return response()->view('teacher.courses.edit', compact('course', 'categories'));
    }

    public function update(Request $request, Course $course)
    {
        if ($course->teacher_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'level' => 'required|in:beginner,intermediate,advanced',
            'price' => 'required|numeric|min:0',
        ]);

        $course->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title).'-'.rand(100, 999),
            'description' => $request->description,
            'level' => $request->level,
            'price' => $request->price,
        ]);

        return redirect()->back()->with('success', 'Course updated successfully!');
    }

    public function storeModule(Request $request, Course $course)
    {
        if ($course->teacher_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $nextOrder = $course->modules()->count() + 1;

        Module::create([
            'course_id' => $course->id,
            'title' => $request->title,
            'order' => $nextOrder,
        ]);

        return redirect()->back()->with('success', 'Module added successfully!');
    }

    public function storeLesson(Request $request, Module $module)
    {
        if ($module->course->teacher_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content_text' => 'nullable|string',
            'video_url' => 'nullable|string',
        ]);

        $nextOrder = $module->lessons()->count() + 1;

        Lesson::create([
            'module_id' => $module->id,
            'title' => $request->title,
            'content_text' => $request->content_text,
            'video_url' => $request->video_url,
            'order' => $nextOrder,
        ]);

        return redirect()->back()->with('success', 'Lesson added successfully!');
    }

    public function storeQuiz(Request $request, Module $module)
    {
        if ($module->course->teacher_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'time_limit' => 'required|integer|min:1',
        ]);

        Quiz::create([
            'module_id' => $module->id,
            'title' => $request->title,
            'time_limit' => $request->time_limit,
        ]);

        return redirect()->back()->with('success', 'Quiz created successfully! Now add questions.');
    }

    public function storeQuestion(Request $request, Quiz $quiz)
    {
        if ($quiz->module->course->teacher_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'question_text' => 'required|string',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string',
            'correct_option' => 'required|integer',
        ]);

        $question = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => $request->question_text,
            'type' => 'multiple_choice',
        ]);

        foreach ($request->options as $index => $optionText) {
            Option::create([
                'question_id' => $question->id,
                'option_text' => $optionText,
                'is_correct' => ($index == $request->correct_option),
            ]);
        }

        return redirect()->back()->with('success', 'Question added successfully!');
    }

    public function storeAssignment(Request $request, Module $module)
    {
        if ($module->course->teacher_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'nullable|date',
        ]);

        Assignment::create([
            'module_id' => $module->id,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);

        return redirect()->back()->with('success', 'Assignment added successfully!');
    }
}
