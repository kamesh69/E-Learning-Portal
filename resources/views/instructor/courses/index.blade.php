@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Manage My Courses</h1>
        <a href="{{ route('instructor.courses.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + New Course
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-sm uppercas text-gray-600">
                    <th class="p-4 border-b">Thumbnail</th>
                    <th class="p-4 border-b">Title</th>
                    <th class="p-4 border-b">Price</th>
                    <th class="p-4 border-b">Status</th>
                    <th class="p-4 border-b text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr class="hover:bg-gray-50">
                    <td class="p-4 border-b w-24">
                        @if($course->thumbnail)
                            <img src="{{ asset($course->thumbnail) }}" class="w-16 h-10 object-cover rounded">
                        @else
                            <div class="w-16 h-10 bg-gray-200 rounded flex items-center justify-center text-xs">No Img</div>
                        @endif
                    </td>
                    <td class="p-4 border-b font-medium">{{ $course->title }}</td>
                    <td class="p-4 border-b">${{ $course->price }}</td>
                    <td class="p-4 border-b">
                        @if($course->is_published)
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Published</span>
                        @else
                            <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-xs">Draft</span>
                        @endif
                    </td>
                    <td class="p-4 border-b text-right">
                        <a href="{{ route('instructor.courses.edit', $course->id) }}" class="text-blue-500 hover:text-blue-700 mr-3 font-semibold">Edit</a>
                        
                        <form action="{{ route('instructor.courses.destroy', $course->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 font-semibold">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                
                @if($courses->isEmpty())
                <tr>
                    <td colspan="5" class="p-8 text-center text-gray-500">
                        You haven't created any courses yet.
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
