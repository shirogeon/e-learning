<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\TeacherCourseController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [CourseController::class, 'index'])->name('home');
Route::get('/courses/{course:slug}', [CourseController::class, 'show'])->name('courses.show');

// Auth routes
Route::middleware(['auth'])->group(function () {
    // Shared Dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Student routes
    Route::middleware(['role:student'])->group(function () {
        Route::get('/student/dashboard', [CourseController::class, 'studentDashboard'])->name('student.dashboard');
        Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
        Route::get('/courses/{course:slug}/learn/{lesson_id?}', [CourseController::class, 'learn'])->name('courses.learn');
        Route::post('/lessons/{lesson}/complete', [CourseController::class, 'completeLesson'])->name('lessons.complete');

        // Quiz routes
        Route::get('/quizzes/{quiz}', [QuizController::class, 'show'])->name('quizzes.show');
        Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submit'])->name('quizzes.submit');

        // Assignment Submission
        Route::post('/assignments/{assignment}/submit', [SubmissionController::class, 'store'])->name('submissions.store');

        // Reviews
        Route::post('/courses/{course}/review', [ReviewController::class, 'store'])->name('reviews.store');

        // Certificates
        Route::get('/enrollments/{enrollment}/certificate', [CertificateController::class, 'download'])->name('certificates.download');
    });

    // Discussion Forum (Student & Teacher)
    Route::middleware(['role:student,teacher'])->group(function () {
        Route::post('/courses/{course}/discussion', [DiscussionController::class, 'store'])->name('discussions.store');
    });

    // Teacher routes
    Route::middleware(['role:teacher'])->group(function () {
        Route::get('/teacher/dashboard', [TeacherCourseController::class, 'dashboard'])->name('teacher.dashboard');
        Route::get('/teacher/courses/create', [TeacherCourseController::class, 'create'])->name('teacher.courses.create');
        Route::post('/teacher/courses', [TeacherCourseController::class, 'store'])->name('teacher.courses.store');
        Route::get('/teacher/courses/{course}/edit', [TeacherCourseController::class, 'edit'])->name('teacher.courses.edit');
        Route::put('/teacher/courses/{course}', [TeacherCourseController::class, 'update'])->name('teacher.courses.update');

        // Module management
        Route::post('/teacher/courses/{course}/modules', [TeacherCourseController::class, 'storeModule'])->name('teacher.modules.store');

        // Lesson management
        Route::post('/teacher/modules/{module}/lessons', [TeacherCourseController::class, 'storeLesson'])->name('teacher.lessons.store');

        // Quiz management
        Route::post('/teacher/modules/{module}/quizzes', [TeacherCourseController::class, 'storeQuiz'])->name('teacher.quizzes.store');
        Route::post('/teacher/quizzes/{quiz}/questions', [TeacherCourseController::class, 'storeQuestion'])->name('teacher.questions.store');

        // Assignment management
        Route::post('/teacher/modules/{module}/assignments', [TeacherCourseController::class, 'storeAssignment'])->name('teacher.assignments.store');

        // Grading submissions
        Route::get('/teacher/submissions/{submission}/grade', [SubmissionController::class, 'gradeShow'])->name('teacher.submissions.grade.show');
        Route::post('/teacher/submissions/{submission}/grade', [SubmissionController::class, 'gradeStore'])->name('teacher.submissions.grade.store');
    });

    // Admin routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Category management
        Route::post('/admin/categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');

        // User management
        Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users.index');
        Route::patch('/admin/users/{user}/role', [AdminController::class, 'updateRole'])->name('admin.users.update-role');
    });
});

require __DIR__.'/auth.php';
