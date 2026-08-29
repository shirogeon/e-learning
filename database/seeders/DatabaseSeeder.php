<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Option;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Users
        $admin = User::create([
            'name' => 'System Administrator',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $teacher = User::create([
            'name' => 'John Doe (Teacher)',
            'email' => 'teacher@example.com',
            'password' => bcrypt('password'),
            'role' => 'teacher',
        ]);

        $student = User::create([
            'name' => 'Jane Smith (Student)',
            'email' => 'student@example.com',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

        // 2. Create Categories
        $devCategory = Category::create([
            'name' => 'Web Development',
            'slug' => 'web-development',
            'description' => 'Learn how to build modern websites and web applications.',
        ]);

        $dsCategory = Category::create([
            'name' => 'Data Science',
            'slug' => 'data-science',
            'description' => 'Learn Python, machine learning, and data analysis.',
        ]);

        // 3. Create Course
        $course = Course::create([
            'category_id' => $devCategory->id,
            'teacher_id' => $teacher->id,
            'title' => 'Laravel 11 for Beginners',
            'slug' => 'laravel-11-for-beginners',
            'description' => 'A comprehensive course for learning Laravel 11 from scratch. You will learn MVC architecture, database migrations, Eloquent ORM, and how to build a complete application.',
            'thumbnail' => null,
            'price' => 0,
            'level' => 'beginner',
        ]);

        // 4. Create Modules
        $module1 = Module::create([
            'course_id' => $course->id,
            'title' => 'Introduction to Laravel 11',
            'order' => 1,
        ]);

        $module2 = Module::create([
            'course_id' => $course->id,
            'title' => 'Core Concepts: Routing & Controllers',
            'order' => 2,
        ]);

        // 5. Create Lessons for Module 1
        $lesson1 = Lesson::create([
            'module_id' => $module1->id,
            'title' => 'What is Laravel and Why Use It?',
            'content_text' => 'Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in most web projects.',
            'video_url' => 'https://www.youtube.com/embed/ImtZ5yENzgE',
            'attachment_path' => null,
            'order' => 1,
        ]);

        $lesson2 = Lesson::create([
            'module_id' => $module1->id,
            'title' => 'Installation & Setup Guide',
            'content_text' => 'Before creating your first Laravel project, make sure that your local machine has PHP and Composer installed. If you are developing on macOS, PHP and Composer can be installed in minutes via Homebrew. Once installed, you can create a new project via composer create-project.',
            'video_url' => null,
            'attachment_path' => null,
            'order' => 2,
        ]);

        // Create Lessons for Module 2
        $lesson3 = Lesson::create([
            'module_id' => $module2->id,
            'title' => 'Understanding Laravel Routing',
            'content_text' => 'The most basic Laravel routes accept a URI and a closure, providing a very simple and expressive method of defining routes and behavior without complicated routing configuration files.',
            'video_url' => null,
            'attachment_path' => null,
            'order' => 1,
        ]);

        // 6. Create Quiz under Module 1
        $quiz = Quiz::create([
            'module_id' => $module1->id,
            'title' => 'Laravel 11 Basics Quiz',
            'time_limit' => 10,
        ]);

        $q1 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'Which pattern does Laravel follow?',
            'type' => 'multiple_choice',
        ]);

        Option::create([
            'question_id' => $q1->id,
            'option_text' => 'MVC (Model-View-Controller)',
            'is_correct' => true,
        ]);
        Option::create([
            'question_id' => $q1->id,
            'option_text' => 'MVVM (Model-View-ViewModel)',
            'is_correct' => false,
        ]);
        Option::create([
            'question_id' => $q1->id,
            'option_text' => 'Singleton',
            'is_correct' => false,
        ]);

        $q2 = Question::create([
            'quiz_id' => $quiz->id,
            'question_text' => 'What tool is used for Laravel dependency management?',
            'type' => 'multiple_choice',
        ]);

        Option::create([
            'question_id' => $q2->id,
            'option_text' => 'npm',
            'is_correct' => false,
        ]);
        Option::create([
            'question_id' => $q2->id,
            'option_text' => 'Composer',
            'is_correct' => true,
        ]);
        Option::create([
            'question_id' => $q2->id,
            'option_text' => 'pip',
            'is_correct' => false,
        ]);

        // 7. Create Assignment under Module 2
        Assignment::create([
            'module_id' => $module2->id,
            'title' => 'Create Your First Route and Controller',
            'description' => 'Write a custom GET route in routes/web.php that points to a new controller. The controller should return a custom string or a view containing your profile info. Submit your PHP controller code as text here.',
            'due_date' => now()->addDays(7),
        ]);
    }
}
