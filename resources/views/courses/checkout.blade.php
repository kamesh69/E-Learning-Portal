@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold mb-8 text-center dark:text-white">Secure Checkout</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Order Summary -->
            <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg border dark:border-gray-700 transition-colors">
                <h3 class="font-bold text-lg mb-4 text-gray-700 dark:text-gray-200">Order Summary</h3>
                <div class="flex items-center gap-4 mb-4">
                    @if($course->thumbnail)
                        <img src="{{ asset($course->thumbnail) }}" class="w-20 h-16 object-cover rounded">
                    @else
                        <div class="w-20 h-16 bg-gray-200 dark:bg-gray-700 rounded transition-colors"></div>
                    @endif
                    <div>
                        <h4 class="font-bold dark:text-white">{{ $course->title }}</h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Instructor: {{ $course->instructor->name ?? 'Unknown' }}</p>
                    </div>
                </div>
                <div class="border-t dark:border-gray-700 pt-4 flex justify-between items-center text-lg font-bold dark:text-white">
                    <span>Total:</span>
                    <span>${{ $course->price }}</span>
                </div>
            </div>
            
            <!-- Payment Form -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg border dark:border-gray-700 transition-colors">
                <h3 class="font-bold text-lg mb-6 flex items-center gap-2 dark:text-white">
                    <span>💳</span> Payment Details
                </h3>
                
                <form action="{{ route('courses.enroll', $course->id) }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Cardholder Name</label>
                        <input type="text" class="w-full px-4 py-2 border dark:border-gray-600 rounded focus:ring-2 focus:ring-blue-500 outline-none dark:bg-gray-700 dark:text-white transition-colors" placeholder="John Doe" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Card Number</label>
                        <input type="text" class="w-full px-4 py-2 border dark:border-gray-600 rounded focus:ring-2 focus:ring-blue-500 outline-none dark:bg-gray-700 dark:text-white transition-colors" placeholder="0000 0000 0000 0000" maxlength="19" required>
                    </div>
                    
                    <div class="flex gap-4 mb-6">
                        <div class="w-1/2">
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Expiry</label>
                            <input type="text" class="w-full px-4 py-2 border dark:border-gray-600 rounded focus:ring-2 focus:ring-blue-500 outline-none dark:bg-gray-700 dark:text-white transition-colors" placeholder="MM/YY" maxlength="5" required>
                        </div>
                        <div class="w-1/2">
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">CVC</label>
                            <input type="text" class="w-full px-4 py-2 border dark:border-gray-600 rounded focus:ring-2 focus:ring-blue-500 outline-none dark:bg-gray-700 dark:text-white transition-colors" placeholder="123" maxlength="3" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 rounded-lg hover:bg-green-700 shadow-lg text-lg flex justify-center items-center gap-2">
                        <span>Pay Now</span>
                        <span class="text-sm font-normal">(${{ $course->price }})</span>
                    </button>
                    
                    <p class="text-xs text-center text-gray-400 mt-4">
                        <span class="font-bold">Note:</span> This is a dummy payment. No actual money will be charged.
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
