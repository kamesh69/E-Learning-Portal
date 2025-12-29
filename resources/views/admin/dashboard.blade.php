@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-red-600">Admin Dashboard</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-gray-500 text-sm font-bold uppercase mb-2">Total Users</h3>
            <p class="text-3xl font-bold">1,204</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-gray-500 text-sm font-bold uppercase mb-2">Total Courses</h3>
            <p class="text-3xl font-bold">45</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-gray-500 text-sm font-bold uppercase mb-2">Pending Instructors</h3>
            <p class="text-3xl font-bold text-orange-500">3</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-gray-500 text-sm font-bold uppercase mb-2">Total Revenue</h3>
            <p class="text-3xl font-bold text-green-600">$15,400</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- User Management -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold">Recent Signups</h3>
                <a href="{{ route('admin.users') }}" class="text-blue-500 text-sm hover:underline">View All</a>
            </div>
            <ul>
                <li class="flex justify-between py-3 border-b">
                    <span>John Doe</span>
                    <span class="text-gray-500 text-sm">Student</span>
                </li>
                 <li class="flex justify-between py-3 border-b">
                    <span>Jane Smith</span>
                    <span class="text-gray-500 text-sm">Instructor (Pending)</span>
                </li>
                 <li class="flex justify-between py-3 border-b">
                    <span>Admin User</span>
                    <span class="text-gray-500 text-sm">Admin</span>
                </li>
            </ul>
        </div>

        <!-- Course Approval -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-bold mb-4">Pending Course Approvals</h3>
            <ul>
                <li class="flex justify-between items-center py-3 border-b">
                    <div>
                        <p class="font-semibold">Advanced React Patterns</p>
                        <p class="text-xs text-gray-500">By: Dev Instructor</p>
                    </div>
                    <div>
                         <button class="bg-green-500 text-white px-3 py-1 rounded text-sm hover:bg-green-600">Approve</button>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
