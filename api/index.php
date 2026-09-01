<?php

/**
 * Vercel Serverless Entrypoint for Laravel
 *
 * Vercel's filesystem is read-only except for /tmp.
 * This script sets up writable directories in /tmp before
 * bootstrapping the Laravel application.
 */

// ── 1. Redirect writable paths to /tmp ──────────────────────────────────────

$appBase = dirname(__DIR__);

$writableDirs = [
    '/tmp/storage/app/public',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/logs',
    '/tmp/bootstrap/cache',
];

foreach ($writableDirs as $dir) {
    if (! is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

// ── 2. Override Laravel environment paths to use /tmp ───────────────────────

$cacheRedirects = [
    'APP_STORAGE_PATH' => '/tmp/storage',
    'VIEW_COMPILED_PATH' => '/tmp/storage/framework/views',
    'APP_SERVICES_CACHE' => '/tmp/bootstrap/cache/services.php',
    'APP_PACKAGES_CACHE' => '/tmp/bootstrap/cache/packages.php',
    'APP_CONFIG_CACHE' => '/tmp/bootstrap/cache/config.php',
    'APP_ROUTES_CACHE' => '/tmp/bootstrap/cache/routes-v7.php',
    'APP_EVENTS_CACHE' => '/tmp/bootstrap/cache/events.php',
    'APP_MAINTENANCE_DRIVER' => 'array',
    'ASSET_URL' => '/',
];

foreach ($cacheRedirects as $key => $value) {
    putenv("{$key}={$value}");
    $_ENV[$key] = $value;
    $_SERVER[$key] = $value;
}

// ── 3. Boot Laravel ─────────────────────────────────────────────────────────

require $appBase.'/public/index.php';
