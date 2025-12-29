@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
         <h1 class="text-2xl font-bold">Edit Course: {{ $course->title }}</h1>
         <a href="{{ route('instructor.courses.index') }}" class="text-blue-500 hover:underline">&larr; Back to List</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Form -->
        <div class="lg:col-span-2">
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <h2 class="text-xl font-bold mb-4 border-b pb-2">Basic Information</h2>
                <form action="{{ route('instructor.courses.update', $course->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Title</label>
                        <input type="text" name="title" value="{{ $course->title }}" class="w-full px-3 py-2 border rounded-lg" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Description</label>
                        <textarea name="description" rows="4" class="w-full px-3 py-2 border rounded-lg" required>{{ $course->description }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                         <div>
                            <label class="block text-gray-700 font-bold mb-2">Price ($)</label>
                            <input type="number" name="price" value="{{ $course->price }}" class="w-full px-3 py-2 border rounded-lg" required>
                        </div>
                        <div class="flex items-center mt-6">
                            <input type="hidden" name="is_published" value="0">
                            <input type="checkbox" name="is_published" value="1" id="publish" class="mr-2 h-5 w-5" {{ $course->is_published ? 'checked' : '' }}>
                            <label for="publish" class="text-gray-700 font-bold">Published</label>
                        </div>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 font-bold">Update Details</button>
                </form>
            </div>
            
            <!-- Curriculum Builder (Visual Only for now) -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                 <div class="flex justify-between items-center mb-4 border-b pb-2">
                    <h2 class="text-xl font-bold">Curriculum / Content</h2>
                    <button class="text-sm bg-gray-200 px-3 py-1 rounded hover:bg-gray-300">+ Add Section</button>
                </div>
                
                <!-- Section Item -->
                <div class="bg-gray-50 border rounded p-4 mb-4">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="font-bold">Section 1: Introduction</h3>
                        <div class="space-x-2">
                             <button class="text-xs text-blue-500">Edit</button>
                             <button class="text-xs text-red-500">Delete</button>
                        </div>
                    </div>
                    
                    <!-- Lessons -->
                    <div class="ml-4 space-y-2">
                        <div class="flex justify-between items-center bg-white p-2 border rounded">
                             <span class="text-sm">🎥 Welcome to the course</span>
                             <button class="text-xs text-blue-500">Edit Content</button>
                        </div>
                         <div class="flex justify-between items-center bg-white p-2 border rounded">
                             <span class="text-sm">📄 Course Prerequisites</span>
                             <button class="text-xs text-blue-500">Edit Content</button>
                        </div>
                        <button class="text-sm text-blue-500 mt-2">+ Add Lesson</button>
                    </div>
                </div>

                 <!-- Section Item -->
                <div class="bg-gray-50 border rounded p-4">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="font-bold">Section 2: Core Concepts</h3>
                         <div class="space-x-2">
                             <button class="text-xs text-blue-500">Edit</button>
                             <button class="text-xs text-red-500">Delete</button>
                        </div>
                    </div>
                     <div class="ml-4">
                        <button class="text-sm text-blue-500 mt-2">+ Add Lesson</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
             <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-bold mb-4">Instructor Tips</h3>
                <ul class="text-sm text-gray-600 list-disc ml-4 space-y-2">
                    <li>Keep your titles short and catchy.</li>
                    <li>Upload high-quality video (1080p).</li>
                    <li>Create a compelling description.</li>
                    <li>Engage students with quizzes.</li>
                </ul>
             </div>
        </div>
    </div>
</div>
@endsection
