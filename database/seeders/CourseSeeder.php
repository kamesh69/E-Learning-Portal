<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;
use App\Models\CourseSection;
use App\Models\Lesson;
use Illuminate\Support\Facades\Hash;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create an Instructor
        $instructor = User::firstOrCreate(
            ['email' => 'instructor@example.com'],
            [
                'name' => 'Dr. Angela Yu',
                'password' => Hash::make('password'),
                'role' => 'instructor',
                'email_verified_at' => now(),
            ]
        );

        // 2. Create Python Course
        $pythonCourse = Course::updateOrCreate(
            ['slug' => 'python-pro-bootcamp-2024'],
            [
                'instructor_id' => $instructor->id,
                'title' => 'The Complete Python Pro Bootcamp for 2024',
                'description' => 'Master Python by building 100 projects in 100 days. Learn data science, automation, build websites, games and apps!',
                'price' => 19.99,
                'level' => 'beginner',
                'thumbnail' => '/images/python.jpg',
                'is_published' => true,
            ]
        );

        // Sections & Lessons for Python
        $section1 = CourseSection::firstOrCreate(['course_id' => $pythonCourse->id, 'title' => 'Day 1: Working with Variables'], ['order_index' => 1]);
        Lesson::updateOrCreate(
            ['course_section_id' => $section1->id, 'title' => 'Printing to the Console'],
            [
                'type' => 'video',
                'video_url' => '/videos/sample-video.mp4',
                'duration_minutes' => 10,
                'is_free_preview' => true,
                'order_index' => 1
            ]
        );

        // 3. Create Web Development Course
        $webCourse = Course::updateOrCreate(
            ['slug' => 'web-developer-bootcamp'],
            [
                'instructor_id' => $instructor->id,
                'title' => 'The Web Developer Bootcamp 2024',
                'description' => 'The only course you need to learn web development - HTML, CSS, JS, Node, and more!',
                'price' => 12.50,
                'level' => 'beginner',
                'thumbnail' => '/images/web.jpg',
                'is_published' => true,
            ]
        );

        // Sections & Lessons for Web
        $webSection1 = CourseSection::firstOrCreate(['course_id' => $webCourse->id, 'title' => 'Introduction to HTML'], ['order_index' => 1]);
        Lesson::updateOrCreate(
            ['course_section_id' => $webSection1->id, 'title' => 'HTML Basics'],
            [
                'type' => 'video',
                'video_url' => 'https://www.youtube.com/embed/qz0aGYrrlhU',
                'duration_minutes' => 15,
                'is_free_preview' => true,
                'order_index' => 1
            ]
        );

         // 4. Create React Course
         $reactCourse = Course::updateOrCreate(
            ['slug' => 'react-complete-guide'],
            [
                'instructor_id' => $instructor->id,
                'title' => 'React - The Complete Guide 2024 (incl. React Router & Redux)',
                'description' => 'Dive in and learn React.js from scratch! Learn Reactjs, Hooks, Redux, React Routing, Animations, Next.js and way more!',
                'price' => 24.99,
                'level' => 'intermediate',
                'thumbnail' => '/images/react.jpg',
                'is_published' => true,
            ]
        );

        // 5. Create Machine Learning Course
        Course::updateOrCreate(
            ['slug' => 'machine-learning-az'],
            [
                'instructor_id' => $instructor->id,
                'title' => 'Machine Learning A-Z: AI, Python & R + ChatGPT Prize [2024]',
                'description' => 'Learn to create Machine Learning Algorithms in Python and R from two Data Science experts. Code templates included.',
                'price' => 29.99,
                'level' => 'advanced',
                'thumbnail' => '/images/ml.jpg',
                'is_published' => true,
            ]
        );
    }
}
