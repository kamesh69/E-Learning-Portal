<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource (Public Catalog or My Courses for instructor).
     */
    public function index()
    {
        // For Students/Public: Show Catalog
        if (Auth::user()->role === 'student' || Auth::user()->role === 'admin') {
            $courses = Course::where('is_published', true)->get();
            return view('courses.index', compact('courses'));
        }

        // For Instructors: Show Their Own Courses
        if (Auth::user()->role === 'instructor') {
             $courses = Course::where('instructor_id', Auth::id())->get();
             // Ideally this view might be different, but keeping it simple for now
             return view('instructor.courses.index', compact('courses'));
        }
        
        return abort(404);
    }

    /**
     * Show the form for creating a new resource (Instructor only).
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'numeric|min:0',
            'level' => 'required|in:beginner,intermediate,advanced',
        ]);

        $course = Course::create([
            'instructor_id' => Auth::id(),
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . rand(1000, 9999),
            'description' => $validated['description'],
            'price' => $validated['price'],
            'level' => $validated['level'],
            'is_published' => false, // Default draft
        ]);

        return redirect()->route('instructor.courses.index')->with('success', 'Course created successfully!');
    }

    /**
     * Display the specified resource (Course Details).
     */
    public function show($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        return view('courses.show', compact('course'));
    }

    public function checkout($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        
        // If already enrolled, redirect to learning
        if (Auth::user()->enrolledIn($course)) {
            return redirect()->route('courses.learn', $course->slug);
        }

        return view('courses.checkout', compact('course'));
    }

    /**
     * Enrollment Logic
     */
    public function enroll(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        
        // Check if already enrolled
        $exists = \App\Models\Enrollment::where('user_id', Auth::id())
                    ->where('course_id', $course->id)
                    ->exists();
        
        if ($exists) {
             return redirect()->route('courses.learn', [$course->id])->with('info', 'You are already enrolled.');
        }

        // Simulating Payment Access
        \App\Models\Enrollment::create([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
            'enrolled_at' => now(),
            'amount_paid' => $course->price,
            'status' => 'active',
        ]);
        
        // Simulate Payment Record
        if ($course->price > 0) {
             \App\Models\Payment::create([
                'user_id' => Auth::id(),
                'course_id' => $course->id,
                'transaction_id' => 'tx_' . Str::random(10),
                'amount' => $course->price,
                'status' => 'success',
            ]);
        }

        // Redirect to learning page (first lesson usually)
        return redirect()->route('courses.learn', [$course->slug])->with('success', 'Enrolled successfully! Start learning now.');
    }
    
    public function myLearning() {
        // $courses = Auth::user()->enrolledCourses;
        return view('dashboard'); // Reusing student dashboard for now
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::where('instructor_id', Auth::id())->where('id', $id)->firstOrFail();
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $course = Course::where('instructor_id', Auth::id())->where('id', $id)->firstOrFail();
        
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'price' => 'numeric|min:0',
             'is_published' => 'boolean',
        ]);

        $course->update($validated);
        
        return redirect()->route('instructor.courses.index')->with('success', 'Course updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::where('instructor_id', Auth::id())->where('id', $id)->firstOrFail();
        $course->delete();
        return back()->with('success', 'Course deleted.');
    }
}
