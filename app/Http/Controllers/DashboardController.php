<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'student') {
            return redirect()->route('courses.index');
        } elseif ($user->role === 'instructor') {
            return redirect()->route('instructor.dashboard');
        } elseif ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        
        return view('dashboard'); // Fallback
    }

    public function instructorDashboard()
    {
        return view('instructor.dashboard');
    }

    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        // Logic to fetch users would go here
        return view('admin.users', ['users' => \App\Models\User::all()]);
    }
}
