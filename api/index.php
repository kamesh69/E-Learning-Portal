<?php

/**
 * Advanced Vercel Entry Point for Laravel
 * Fixed for Serverless Path Issues
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // 1. Prepare Writable Storage in /tmp
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

    // 2. Setup SQLite Database in /tmp
    $dbPath = '/tmp/database.sqlite';
    if (!file_exists($dbPath)) {
        @touch($dbPath);
    }

    // 3. Set Environment for the Runtime
    putenv("APP_CONFIG_CACHE=/tmp/config.php");
    putenv("APP_ROUTES_CACHE=/tmp/routes.php");
    putenv("APP_SERVICES_CACHE=/tmp/services.php");
    putenv("APP_PACKAGES_CACHE=/tmp/packages.php");
    
    putenv("VIEW_COMPILED_PATH=$storagePath/framework/views");
    putenv("DB_DATABASE=$dbPath");
    putenv("DB_CONNECTION=sqlite");

    // 4. Bootstrap Laravel
    require __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';

    // 5. Override Storage Path at Runtime
    $app->useStoragePath($storagePath);

    // 6. Handle the Request
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

    $response = $kernel->handle(
        $request = Illuminate\Http\Request::capture()
    );

    $response->send();

    $kernel->terminate($request, $response);

} catch (\Throwable $e) {
    http_response_code(500);
    echo "<h1>Deployment Error</h1>";
    echo "<p><strong>Message:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><strong>File:</strong> " . htmlspecialchars($e->getFile()) . " (Line: " . $e->getLine() . ")</p>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}
