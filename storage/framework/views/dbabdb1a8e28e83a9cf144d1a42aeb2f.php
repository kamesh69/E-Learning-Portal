

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-12">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold mb-8 text-center">Secure Checkout</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Order Summary -->
            <div class="bg-gray-50 p-6 rounded-lg border">
                <h3 class="font-bold text-lg mb-4 text-gray-700">Order Summary</h3>
                <div class="flex items-center gap-4 mb-4">
                    <?php if($course->thumbnail): ?>
                        <img src="<?php echo e(asset($course->thumbnail)); ?>" class="w-20 h-16 object-cover rounded">
                    <?php else: ?>
                        <div class="w-20 h-16 bg-gray-200 rounded"></div>
                    <?php endif; ?>
                    <div>
                        <h4 class="font-bold"><?php echo e($course->title); ?></h4>
                        <p class="text-sm text-gray-500">Instructor: <?php echo e($course->instructor->name ?? 'Unknown'); ?></p>
                    </div>
                </div>
                <div class="border-t pt-4 flex justify-between items-center text-lg font-bold">
                    <span>Total:</span>
                    <span>$<?php echo e($course->price); ?></span>
                </div>
            </div>
            
            <!-- Payment Form -->
            <div class="bg-white p-6 rounded-lg shadow-lg border">
                <h3 class="font-bold text-lg mb-6 flex items-center gap-2">
                    <span>💳</span> Payment Details
                </h3>
                
                <form action="<?php echo e(route('courses.enroll', $course->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Cardholder Name</label>
                        <input type="text" class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500 outline-none" placeholder="John Doe" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Card Number</label>
                        <input type="text" class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500 outline-none" placeholder="0000 0000 0000 0000" maxlength="19" required>
                    </div>
                    
                    <div class="flex gap-4 mb-6">
                        <div class="w-1/2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Expiry</label>
                            <input type="text" class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500 outline-none" placeholder="MM/YY" maxlength="5" required>
                        </div>
                        <div class="w-1/2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">CVC</label>
                            <input type="text" class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-blue-500 outline-none" placeholder="123" maxlength="3" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 rounded-lg hover:bg-green-700 shadow-lg text-lg flex justify-center items-center gap-2">
                        <span>Pay Now</span>
                        <span class="text-sm font-normal">($<?php echo e($course->price); ?>)</span>
                    </button>
                    
                    <p class="text-xs text-center text-gray-400 mt-4">
                        <span class="font-bold">Note:</span> This is a dummy payment. No actual money will be charged.
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Kamesh\Desktop\E Learning Platform\resources\views/courses/checkout.blade.php ENDPATH**/ ?>