<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseTest extends TestCase
{
    use RefreshDatabase;

    public function test_catalog_can_be_rendered(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Course');
    }

    public function test_catalog_search_filters_courses(): void
    {
        $teacher = User::factory()->create(['role' => 'teacher']);
        $category = Category::create(['name' => 'Web Development', 'slug' => 'web-dev']);

        $course1 = Course::create([
            'teacher_id' => $teacher->id,
            'category_id' => $category->id,
            'title' => 'Mastering Laravel Framework',
            'slug' => 'mastering-laravel-framework',
            'description' => 'A comprehensive deep dive into Laravel 11.',
            'level' => 'advanced',
            'price' => 0,
        ]);

        $course2 = Course::create([
            'teacher_id' => $teacher->id,
            'category_id' => $category->id,
            'title' => 'Introduction to Python',
            'slug' => 'introduction-to-python',
            'description' => 'Beginner friendly Python programming.',
            'level' => 'beginner',
            'price' => 0,
        ]);

        $response = $this->get('/?search=Laravel');
        $response->assertStatus(200);
        $response->assertSee('Mastering Laravel Framework');
        $response->assertDontSee('Introduction to Python');
    }

    public function test_course_show_page_is_accessible(): void
    {
        $teacher = User::factory()->create(['role' => 'teacher']);
        $category = Category::create(['name' => 'Web Development', 'slug' => 'web-dev']);

        $course = Course::create([
            'teacher_id' => $teacher->id,
            'category_id' => $category->id,
            'title' => 'Mastering Laravel Framework',
            'slug' => 'mastering-laravel-framework',
            'description' => 'A comprehensive deep dive into Laravel 11.',
            'level' => 'advanced',
            'price' => 0,
        ]);

        $response = $this->get(route('courses.show', $course->slug));
        $response->assertStatus(200);
        $response->assertSee('Mastering Laravel Framework');
    }

    public function test_student_can_enroll_and_complete_lessons(): void
    {
        $teacher = User::factory()->create(['role' => 'teacher']);
        $student = User::factory()->create(['role' => 'student']);
        $category = Category::create(['name' => 'Web Development', 'slug' => 'web-dev']);

        $course = Course::create([
            'teacher_id' => $teacher->id,
            'category_id' => $category->id,
            'title' => 'Laravel 11 Fast Track',
            'slug' => 'laravel-11-fast-track',
            'description' => 'Learn Laravel in 1 day.',
            'level' => 'beginner',
            'price' => 0,
        ]);

        $module = Module::create([
            'course_id' => $course->id,
            'title' => 'Module 1: Basics',
            'order' => 1,
        ]);

        $lesson = Lesson::create([
            'module_id' => $module->id,
            'title' => 'Lesson 1: Routes & Controllers',
            'order' => 1,
        ]);

        // Student enrolls
        $enrollResponse = $this->actingAs($student)->post(route('courses.enroll', $course->id));
        $enrollResponse->assertRedirect(route('courses.learn', $course->slug));

        $this->assertDatabaseHas('enrollments', [
            'student_id' => $student->id,
            'course_id' => $course->id,
            'status' => 'active',
        ]);

        // Student completes lesson (100% progress)
        $completeResponse = $this->actingAs($student)->post(route('lessons.complete', $lesson->id));
        $completeResponse->assertStatus(302);

        $this->assertDatabaseHas('enrollments', [
            'student_id' => $student->id,
            'course_id' => $course->id,
            'status' => 'completed',
            'progress_percent' => 100,
        ]);

        // Certificate should automatically be generated
        $this->assertDatabaseHas('certificates', [
            'enrollment_id' => $student->enrollments()->first()->id,
        ]);
    }
}
