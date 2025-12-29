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
if (!file_exists($dbPath)) {
    touch($dbPath);
}

// 4. Inject runtime environment variables to override cached config path issues
putenv("VIEW_COMPILED_PATH=$storagePath/framework/views");
putenv("SESSION_PATH=$storagePath/framework/sessions");
putenv("CACHE_PATH=$storagePath/framework/cache");
putenv("LOG_PATH=$storagePath/logs/laravel.log");
putenv("DB_DATABASE=$dbPath");
putenv("DB_CONNECTION=sqlite");

// 5. Error reporting for debugging (Vercel logs)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 6. Load the Laravel application
try {
    require __DIR__ . '/../public/index.php';
} catch (\Exception $e) {
    echo "<h1>Laravel Initialization Error</h1>";
    echo "<p>" . $e->getMessage() . "</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
