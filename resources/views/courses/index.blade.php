@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-end mb-6">
        <div>
             <h1 class="text-3xl font-bold mb-2">Course Catalog</h1>
             <p class="text-gray-600 dark:text-gray-400">Explore our wide range of courses</p>
        </div>
        
        <div class="flex gap-2">
            <!-- Search/Filter could go here -->
            <input type="text" placeholder="Search courses..." class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-200">
             <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Search</button>
        </div>
    </div>

    @if($courses->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($courses as $course)
        <div class="bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-lg shadow-md overflow-hidden hover:shadow-xl transition transform hover:-translate-y-1">
            <a href="{{ route('courses.show', $course->slug) }}" class="block">
                <!-- Thumbnail -->
                <div class="h-48 bg-gray-200 dark:bg-gray-700 w-full object-cover flex items-center justify-center relative">
                    @if($course->thumbnail)
                        <img src="{{ asset($course->thumbnail) }}" alt="{{ $course->title }}" class="h-full w-full object-cover">
                    @else
                        <span class="text-gray-500 dark:text-gray-400">No Image</span>
                    @endif
                    <span class="absolute top-2 right-2 bg-yellow-400 text-black text-xs font-bold px-2 py-1 rounded">{{ $course->level }}</span>
                </div>
                
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-1 truncate dark:text-white">{{ $course->title }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">By {{ $course->instructor->name ?? 'Unknown' }}</p>
                    
                    <div class="flex items-center mb-2">
                         <span class="text-yellow-500">★★★★☆</span>
                         <span class="text-xs text-gray-400 ml-1">(4.5)</span>
                    </div>

                    <div class="flex justify-between items-center mt-4">
                        <span class="text-xl font-bold text-gray-900 dark:text-white">${{ $course->price }}</span>
                        <span class="text-blue-600 dark:text-blue-400 text-sm font-semibold hover:underline">View Details</span>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @else
        <div class="text-center py-12">
            <h3 class="text-xl text-gray-600">No courses available at the moment.</h3>
        </div>
    @endif
</div>
@endsection
