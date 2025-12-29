<?php

/**
 * Vercel Serverless Entry Point for Laravel
 */

// 1. Define storage and database paths in /tmp
$storagePath = '/tmp/storage';
$dbPath = '/tmp/database.sqlite';

// 2. Build necessary directory structure
$dirs = [
    $storagePath . '/framework/views',
    $storagePath . '/framework/cache',
    $storagePath . '/framework/sessions',
    $storagePath . '/app/public',
    $storagePath . '/logs',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

// 3. Initialize empty database if missing
$isNewDb = false;
if (!file_exists($dbPath)) {
    touch($dbPath);
    $isNewDb = true;
}

// 4. Inject runtime environment variables
putenv("VIEW_COMPILED_PATH=$storagePath/framework/views");
putenv("SESSION_PATH=$storagePath/framework/sessions");
putenv("CACHE_PATH=$storagePath/framework/cache");
putenv("LOG_PATH=$storagePath/logs/laravel.log");
putenv("DB_DATABASE=$dbPath");
putenv("DB_CONNECTION=sqlite");

// 5. Load the Laravel application
require __DIR__ . '/../public/index.php';

// 6. Optional: Auto-migrate for demo purposes
// This ensures that the first time the app wakes up, it sets up the tables.
if ($isNewDb) {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate --force');
        \Illuminate\Support\Facades\Artisan::call('db:seed --class=CourseSeeder --force');
    } catch (\Exception $e) {
        // Log errors to Vercel console for debugging
        error_log("Laravel Setup Error: " . $e->getMessage());
    }
}
