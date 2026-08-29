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

$_ENV['APP_STORAGE_PATH']   = '/tmp/storage';
$_ENV['VIEW_COMPILED_PATH'] = '/tmp/storage/framework/views';

// Point bootstrap cache to /tmp so artisan config:cache works
if (! defined('LARAVEL_START')) {
    define('LARAVEL_START', microtime(true));
}

// ── 3. Boot Laravel ─────────────────────────────────────────────────────────

require $appBase . '/public/index.php';

