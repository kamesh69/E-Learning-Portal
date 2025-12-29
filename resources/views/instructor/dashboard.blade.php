@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Instructor Dashboard</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-blue-500">
            <h3 class="text-xl font-semibold mb-2">Total Courses</h3>
            <p class="text-3xl font-bold">5</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-green-500">
            <h3 class="text-xl font-semibold mb-2">Total Enrolled</h3>
            <p class="text-3xl font-bold">120</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-yellow-500">
            <h3 class="text-xl font-semibold mb-2">Earnings</h3>
            <p class="text-3xl font-bold">$1,250</p>
        </div>
    </div>

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">My Courses</h2>
        <a href="{{ route('instructor.courses.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Create New Course
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-4 border-b">Course Title</th>
                    <th class="p-4 border-b">Enrolled</th>
                    <th class="p-4 border-b">Status</th>
                    <th class="p-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example Row -->
                <tr>
                    <td class="p-4 border-b">Introduction to Laravel</td>
                    <td class="p-4 border-b">45 Students</td>
                    <td class="p-4 border-b"><span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Published</span></td>
                    <td class="p-4 border-b">
                        <a href="#" class="text-blue-500 hover:text-blue-700 mr-2">Edit</a>
                        <a href="#" class="text-red-500 hover:text-red-700">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
