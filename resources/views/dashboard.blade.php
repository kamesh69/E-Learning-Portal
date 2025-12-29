@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-blue-600 text-white rounded-lg p-8 mb-8">
        <h1 class="text-4xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}!</h1>
        <p class="text-lg opacity-90">Continue learning where you left off.</p>
    </div>

    <h2 class="text-2xl font-bold mb-6 dark:text-white">In Progress</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Course Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition border dark:border-gray-700">
            <div class="h-40 bg-gray-300 dark:bg-gray-700 w-full object-cover flex items-center justify-center">
                <span class="text-gray-500 dark:text-gray-400">Course Thumbnail</span>
            </div>
            <div class="p-6">
                <h3 class="font-bold text-xl mb-2 dark:text-white">Web Development Bootcamp</h3>
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5 mb-4">
                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 45%"></div>
                </div>
                <div class="flex justify-between items-center text-sm text-gray-600 dark:text-gray-400">
                    <span>45% Complete</span>
                    <a href="#" class="text-blue-500 dark:text-blue-400 hover:underline">Resume</a>
                </div>
            </div>
        </div>

        <!-- Empty State if no courses -->
        <!-- 
        <div class="col-span-3 text-center py-12">
            <p class="text-gray-500 dark:text-gray-400 mb-4">You are not enrolled in any courses yet.</p>
            <a href="{{ route('courses.index') }}" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700">Browse Catalog</a>
        </div>
        -->
    </div>

    <h2 class="text-2xl font-bold mt-12 mb-6 dark:text-white">Recommended for You</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Recommended items place holder -->
         <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 border dark:border-gray-700">
            <div class="h-32 bg-gray-200 dark:bg-gray-700 rounded mb-4"></div>
            <h4 class="font-bold dark:text-white">UI/UX Design Masterclass</h4>
            <p class="text-sm text-gray-500 dark:text-gray-400">Jane Doe</p>
         </div>
    </div>
</div>
@endsection
