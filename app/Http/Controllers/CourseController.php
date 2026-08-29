<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Certificate;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class CourseController extends Controller
{
    public function index(Request $request): Response
    {
        $categories = Category::all();
        $selectedCategory = $request->query('category');
        $search = $request->query('search');

        $query = Course::with(['category', 'teacher']);

        if ($selectedCategory) {
            $query->whereHas('category', function ($q) use ($selectedCategory) {
                $q->where('slug', $selectedCategory);
            });
        }

        if ($search) {
            $lowerSearch = strtolower($search);
            $query->where(function ($q) use ($lowerSearch) {
                $q->whereRaw('LOWER(title) LIKE ?', ["%{$lowerSearch}%"])
                    ->orWhereRaw('LOWER(description) LIKE ?', ["%{$lowerSearch}%"]);
            });
        }

        $courses = $query->latest()->get();

        return response()->view('courses.index', compact('courses', 'categories', 'selectedCategory', 'search'));
    }

    public function show(Course $course): Response
    {
        $course->load(['category', 'teacher', 'modules.lessons', 'reviews.student']);

        $isEnrolled = false;
        $enrollment = null;
        if (auth()->check() && auth()->user()->isStudent()) {
            $enrollment = Enrollment::where('student_id', auth()->id())
                ->where('course_id', $course->id)
                ->first();
            $isEnrolled = ! is_null($enrollment);
        }

        $averageRating = $course->reviews->avg('rating') ?: 0;

        return response()->view('courses.show', compact('course', 'isEnrolled', 'enrollment', 'averageRating'));
    }

    public function enroll(Request $request, Course $course)
    {
        $studentId = $request->user()->id;

        $existing = Enrollment::where('student_id', $studentId)
            ->where('course_id', $course->id)
            ->first();

        if (! $existing) {
            Enrollment::create([
                'student_id' => $studentId,
                'course_id' => $course->id,
                'status' => 'active',
                'progress_percent' => 0,
            ]);
        }

        return redirect()->route('courses.learn', $course->slug)
            ->with('success', 'You have successfully enrolled in this course!');
    }

    public function studentDashboard(Request $request): Response
    {
        $enrollments = Enrollment::where('student_id', $request->user()->id)
            ->with(['course.teacher', 'certificate'])
            ->latest()
            ->get();

        return response()->view('student.dashboard', compact('enrollments'));
    }

    public function learn(Request $request, string $slug, ?int $lesson_id = null): Response
    {
        $course = Course::where('slug', $slug)->firstOrFail();

        // Ensure user is enrolled
        $enrollment = Enrollment::where('student_id', $request->user()->id)
            ->where('course_id', $course->id)
            ->firstOrFail();

        $course->load(['modules.lessons', 'modules.quizzes.questions.options', 'modules.assignments.submissions', 'discussions.user', 'discussions.replies.user']);

        // Find active lesson or default to first lesson of first module
        $activeLesson = null;
        if ($lesson_id) {
            $activeLesson = Lesson::where('id', $lesson_id)->firstOrFail();
        } else {
            $firstModule = $course->modules->first();
            if ($firstModule) {
                $activeLesson = $firstModule->lessons->first();
            }
        }

        // Get completed lessons list for progress checkbox state
        $completedLessonIds = $request->user()
            ->completedLessons()
            ->whereIn('lesson_id', Lesson::whereHas('module', function ($q) use ($course) {
                $q->where('course_id', $course->id);
            })->pluck('id'))
            ->pluck('lesson_id')
            ->toArray();

        return response()->view('courses.learn', compact('course', 'enrollment', 'activeLesson', 'completedLessonIds'));
    }

    public function completeLesson(Request $request, Lesson $lesson)
    {
        $user = $request->user();

        // Toggle completed lesson
        if ($user->completedLessons()->where('lesson_id', $lesson->id)->exists()) {
            $user->completedLessons()->detach($lesson->id);
        } else {
            $user->completedLessons()->attach($lesson->id);
        }

        // Update progress percentage
        $course = $lesson->module->course;
        $enrollment = Enrollment::where('student_id', $user->id)
            ->where('course_id', $course->id)
            ->firstOrFail();

        $totalLessons = Lesson::whereHas('module', function ($q) use ($course) {
            $q->where('course_id', $course->id);
        })->count();

        $completedCount = $user->completedLessons()
            ->whereIn('lesson_id', Lesson::whereHas('module', function ($q) use ($course) {
                $q->where('course_id', $course->id);
            })->pluck('id'))
            ->count();

        $progressPercent = $totalLessons > 0 ? (int) round(($completedCount / $totalLessons) * 100) : 0;

        $enrollment->update([
            'progress_percent' => $progressPercent,
            'status' => $progressPercent === 100 ? 'completed' : 'active',
        ]);

        // Auto-generate certificate if 100% complete
        if ($progressPercent === 100 && ! $enrollment->certificate) {
            Certificate::create([
                'enrollment_id' => $enrollment->id,
                'certificate_code' => 'CERT-'.strtoupper(Str::random(10)),
                'issued_at' => now(),
            ]);
        }

        return redirect()->back();
    }
}
