

<?php $__env->startSection('content'); ?>
<div class="bg-gray-900 text-white py-12">
    <div class="container mx-auto px-4 flex flex-col md:flex-row gap-8">
        <div class="md:w-2/3">
            <h1 class="text-4xl font-bold mb-4"><?php echo e($course->title); ?></h1>
            <p class="text-lg text-gray-300 mb-6"><?php echo e(Str::limit($course->description, 150)); ?></p>
            
            <div class="flex items-center gap-4 text-sm mb-6">
                <span class="bg-yellow-500 text-black px-2 py-1 rounded font-bold">Best Seller</span>
                <span>Created by <?php echo e($course->instructor->name ?? 'Unknown'); ?></span>
                <span>Last updated <?php echo e($course->updated_at->format('M Y')); ?></span>
                <span>Language: English</span>
            </div>
            
            <div class="flex items-center gap-2">
                <span class="text-yellow-400 text-xl">★★★★☆</span>
                <span class="text-blue-300 underline">(1,234 ratings)</span>
                <span>10,000 students</span>
            </div>
        </div>
        
        <div class="md:w-1/3 relative">
             <!-- Sticky Purchase Card would go here in complex layout, inline for now -->
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8 flex flex-col md:flex-row gap-8">
    <div class="md:w-2/3">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border dark:border-gray-700 mb-8 transition-colors">
            <h2 class="text-2xl font-bold mb-4 dark:text-white">What you'll learn</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm text-gray-700 dark:text-gray-300">
                <p>✓ Master the fundamentals</p>
                <p>✓ Build real projects</p>
                <p>✓ Understand advanced concepts</p>
                <p>✓ Get certified</p>
            </div>
        </div>

        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4 dark:text-white">Description</h2>
            <div class="prose max-w-none text-gray-700 dark:text-gray-300">
                <?php echo e($course->description); ?>

            </div>
        </div>
    </div>

    <!-- Sidebar Purchase Card -->
    <div class="md:w-1/3 -mt-32 z-10">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden border dark:border-gray-700 transition-colors">
            <div class="h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                 <!-- Preview Video Placeholder -->
                 <a href="<?php echo e(route('courses.learn', $course->slug)); ?>" class="text-center cursor-pointer block hover:opacity-75 transition">
                     <div class="w-16 h-16 bg-white dark:bg-gray-800 rounded-full flex items-center justify-center shadow mb-2 mx-auto">
                         <span class="text-2xl dark:text-white">▶</span>
                     </div>
                     <span class="font-bold underline dark:text-blue-400">Preview this course</span>
                 </a>
            </div>
            <div class="p-6">
                <div class="text-3xl font-bold mb-4 dark:text-white">$<?php echo e($course->price); ?></div>
                
                <?php if(auth()->user()->enrolledIn($course)): ?>
                    <a href="<?php echo e(route('courses.learn', $course->slug)); ?>" class="block text-center w-full bg-green-600 text-white font-bold py-3 rounded-lg hover:bg-green-700 mb-3 transition">
                        Continue Learning
                    </a>
                <?php else: ?>
                    <a href="<?php echo e(route('courses.checkout', $course->slug)); ?>" class="block text-center w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 mb-3 transition">
                        Add to Cart
                    </a>
                <?php endif; ?>
                
                <p class="text-center text-xs text-gray-500 dark:text-gray-400 mb-4">30-Day Money-Back Guarantee</p>
                
                <div class="text-sm font-semibold mb-2 dark:text-gray-200">This course includes:</div>
                <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-2">
                    <li>🎥 24 hours on-demand video</li>
                    <li>📄 5 articles</li>
                    <li>📥 10 downloadable resources</li>
                    <li>📱 Access on mobile and TV</li>
                    <li>🏆 Certificate of completion</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Kamesh\Desktop\E Learning Platform\resources\views/courses/show.blade.php ENDPATH**/ ?>