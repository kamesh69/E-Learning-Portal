<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Learning</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Login</h2>
        
        <?php if($errors->any()): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <?php echo e($errors->first()); ?>

            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('login')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" name="email" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" name="password" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600 transition duration-200">
                Login
            </button>
        </form>

        <div class="mt-4 text-center">
            <a href="<?php echo e(route('auth.google')); ?>" class="w-full inline-block bg-red-500 text-white font-bold py-2 px-4 rounded hover:bg-red-600 transition duration-200">
                Login with Google
            </a>
        </div>

        <p class="mt-4 text-center text-sm text-gray-600">
            Don't have an account? <a href="<?php echo e(route('register')); ?>" class="text-blue-500 hover:text-blue-700">Register</a>
        </p>
    </div>
</body>
</html>
<?php /**PATH C:\Users\Kamesh\Desktop\E Learning Platform\resources\views/auth/login.blade.php ENDPATH**/ ?>