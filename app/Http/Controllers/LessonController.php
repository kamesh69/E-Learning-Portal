<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function show(Course $course, Lesson $lesson = null)
    {
        // Check if user is enrolled (stub)
        if (!auth()->user()->enrolledIn($course)) {
             abort(403, 'You must be enrolled to view this content.');
        }
        
        $sections = \App\Models\CourseSection::where('course_id', $course->id)
                    ->with('lessons')
                    ->orderBy('order_index')
                    ->get();

        if (!$lesson) {
            $lesson = $sections->flatMap->lessons->first();
        }

        return view('courses.learn', compact('course', 'lesson', 'sections'));
    }
}
