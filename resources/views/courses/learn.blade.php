@extends('layouts.app')

@section('content')
<div class="flex h-[calc(100vh-80px)]">
    <!-- Sidebar: Course Content -->
    <div class="w-1/4 bg-white dark:bg-gray-800 border-r dark:border-gray-700 overflow-y-auto transition-colors">
        <div class="p-4 border-b dark:border-gray-700">
            <h2 class="font-bold text-lg text-gray-800 dark:text-white">{{ $course->title }}</h2>
             <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mt-2">
                <div class="bg-green-500 h-2 rounded-full" style="width: 30%"></div>
            </div>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">30% Completed</p>
        </div>
        
        <div class="divide-y dark:divide-gray-700">
            {{-- STUB: Use $sections loop here --}}
            {{-- @foreach($sections as $section) --}}
            <div class="py-2">
                <button class="w-full text-left px-4 py-2 font-semibold text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 flex justify-between">
                    <span>Section 1: Introduction</span>
                    <span class="text-xs">▼</span>
                </button>
                <div class="bg-gray-50 dark:bg-gray-950">
                    <a href="#" class="block px-8 py-2 text-sm text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20 border-l-4 border-blue-600">
                         ▶  1. Welcome to the course
                         <span class="float-right text-xs text-gray-500 dark:text-gray-400">5:00</span>
                    </a>
                    <a href="#" class="block px-8 py-2 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800">
                         📄 2. Installation Guide
                         <span class="float-right text-xs text-gray-500 dark:text-gray-400">Text</span>
                    </a>
                </div>
            </div>
             <div class="py-2">
                <button class="w-full text-left px-4 py-2 font-semibold text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 flex justify-between">
                    <span>Section 2: Basics</span>
                    <span class="text-xs">▼</span>
                </button>
            </div>
            {{-- @endforeach --}}
        </div>
    </div>

    <!-- Main Content: Video Player -->
    <div class="w-3/4 bg-gray-900 flex flex-col">
        <div class="flex-grow flex items-center justify-center bg-black">
             <!-- Video Player Container -->
             @if($lesson && $lesson->type == 'video')
                <div class="w-full h-full flex items-center justify-center text-white">
                    @if(Str::contains($lesson->video_url, ['youtube.com', 'youtu.be']))
                        <iframe class="w-full h-full" src="{{ $lesson->video_url }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    @else
                        <video class="w-full h-full" controls>
                            <source src="{{ asset($lesson->video_url) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @endif
                </div>
             @else
                <div class="w-full h-full bg-white dark:bg-gray-900 text-black dark:text-white p-12 overflow-y-auto transition-colors">
                    <h1 class="text-3xl font-bold mb-6">{{ $lesson->title ?? 'Lesson Title' }}</h1>
                    <div class="prose dark:prose-invert max-w-none">
                        {{ $lesson->content ?? 'Lesson content goes here...' }}
                    </div>
                </div>
             @endif
        </div>
        
        <div class="h-16 bg-gray-800 dark:bg-gray-950 flex items-center justify-between px-6 text-white border-t border-gray-700 transition-colors">
            <button class="text-sm hover:text-gray-300">← Previous Lesson</button>
            <button class="bg-blue-600 px-4 py-2 rounded text-sm font-bold hover:bg-blue-700">Mark as Complete</button>
            <button class="text-sm hover:text-gray-300">Next Lesson →</button>
        </div>
        
        <!-- Tabs for Q&A / Notes -->
        <div class="h-1/3 bg-white dark:bg-gray-800 text-black dark:text-white p-4 overflow-y-auto border-t dark:border-gray-700 transition-colors">
             <div class="border-b dark:border-gray-700 mb-4">
                 <button class="px-4 py-2 border-b-2 border-blue-600 font-bold text-blue-600 dark:text-blue-400">Overview</button>
                 <button class="px-4 py-2 text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400">Q&A</button>
                 <button class="px-4 py-2 text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400">Notes</button>
             </div>
             <div>
                 <h3 class="font-bold text-lg mb-2">About this lesson</h3>
                 <p class="text-gray-600 dark:text-gray-400">In this lesson, we will cover the basics of...</p>
             </div>
        </div>
    </div>
</div>
@endsection
