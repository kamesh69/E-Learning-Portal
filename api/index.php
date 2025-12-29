<?php

/**
 * Robust Vercel Entry Point for Laravel
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // 1. Move Laravel's storage to /tmp
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
            @mkdir($dir, 0777, true);
        }
    }

    // 2. Setup SQLite in /tmp
    $dbPath = '/tmp/database.sqlite';
    if (!file_exists($dbPath)) {
        @touch($dbPath);
    }

    // 3. Inject critical environment variables
    putenv("VIEW_COMPILED_PATH=$storagePath/framework/views");
    putenv("SESSION_PATH=$storagePath/framework/sessions");
    putenv("CACHE_PATH=$storagePath/framework/cache");
    putenv("LOG_PATH=$storagePath/logs/laravel.log");
    putenv("DB_DATABASE=$dbPath");
    putenv("DB_CONNECTION=sqlite");

    // 4. Load the Laravel application
    require __DIR__ . '/../public/index.php';

} catch (\Throwable $e) {
    // Catch EVERYTHING (Exceptions and Errors)
    http_response_code(500);
    echo "<html><body style='font-family: sans-serif; padding: 20px;'>";
    echo "<h1 style='color: #e53e3e;'>Critical Boot Error</h1>";
    echo "<p>The application failed to start on Vercel.</p>";
    echo "<div style='background: #f7fafc; border: 1px solid #cbd5e0; padding: 15px;'>";
    echo "<strong>Message:</strong> " . htmlspecialchars($e->getMessage()) . "<br><br>";
    echo "<strong>File:</strong> " . htmlspecialchars($e->getFile()) . " (Line: " . $e->getLine() . ")<br><br>";
    echo "<strong>Trace:</strong><pre style='font-size: 12px;'>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
    echo "</div></body></html>";
}
