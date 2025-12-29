<?php

// 1. Move Laravel's storage to /tmp (Vercel's only writable directory)
$storagePath = '/tmp/storage';
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

// 2. Ensure SQLite database exists in /tmp
$dbPath = '/tmp/database.sqlite';
if (!file_exists($dbPath)) {
    touch($dbPath);
}

// 3. Set environment variables for the runtime
putenv("VIEW_COMPILED_PATH=$storagePath/framework/views");
putenv("SESSION_PATH=$storagePath/framework/sessions");
putenv("CACHE_PATH=$storagePath/framework/cache");
putenv("LOG_PATH=$storagePath/logs/laravel.log");
putenv("DB_DATABASE=$dbPath");

// 4. Forward requests to Laravel's public entry point
require __DIR__ . '/../public/index.php';
