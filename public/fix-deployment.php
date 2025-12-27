<?php
/**
 * Emergency Deployment Fix Script
 * This script fixes common deployment issues
 */

// Security: Only allow execution from localhost or with a secret key
$secretKey = 'fix2025';
$providedKey = $_GET['key'] ?? '';

if ($providedKey !== $secretKey) {
    die('Access Denied. Provide correct key parameter.');
}

echo "<h1>Deployment Fix Script</h1>";
echo "<pre>";

// Get the base directory
$publicHtmlPath = realpath(__DIR__ . '/../..');
$laravelPath = realpath(__DIR__ . '/..');

echo "Public HTML Path: $publicHtmlPath\n";
echo "Laravel Path: $laravelPath\n\n";

// Fix 1: Copy .htaccess
echo "=== Fix 1: Copying .htaccess ===\n";
$htaccessSource = __DIR__ . '/.htaccess';
$htaccessDest = $publicHtmlPath . '/.htaccess';

if (file_exists($htaccessSource)) {
    if (copy($htaccessSource, $htaccessDest)) {
        echo "✅ .htaccess copied successfully\n";
    } else {
        echo "❌ Failed to copy .htaccess\n";
    }
} else {
    echo "⚠️ Source .htaccess not found\n";
}

// Fix 2: Copy robots.txt
echo "\n=== Fix 2: Copying robots.txt ===\n";
$robotsSource = __DIR__ . '/robots.txt';
$robotsDest = $publicHtmlPath . '/robots.txt';

if (file_exists($robotsSource)) {
    if (copy($robotsSource, $robotsDest)) {
        echo "✅ robots.txt copied successfully\n";
    } else {
        echo "❌ Failed to copy robots.txt\n";
    }
} else {
    echo "⚠️ robots.txt not found (optional)\n";
}

// Fix 3: Clear Laravel cache
echo "\n=== Fix 3: Clearing Laravel Cache ===\n";
chdir($laravelPath);

$commands = [
    'config:clear',
    'cache:clear',
    'route:clear',
    'view:clear',
    'config:cache',
    'route:cache',
    'view:cache',
];

foreach ($commands as $cmd) {
    echo "Running: php artisan $cmd\n";
    $output = [];
    $returnVar = 0;
    exec("php artisan $cmd 2>&1", $output, $returnVar);
    if ($returnVar === 0) {
        echo "✅ Success\n";
    } else {
        echo "❌ Failed: " . implode("\n", $output) . "\n";
    }
}

// Fix 4: Check permissions
echo "\n=== Fix 4: Checking Permissions ===\n";
$storagePath = $laravelPath . '/storage';
$bootstrapCachePath = $laravelPath . '/bootstrap/cache';

if (is_writable($storagePath)) {
    echo "✅ storage/ is writable\n";
} else {
    echo "❌ storage/ is NOT writable\n";
}

if (is_writable($bootstrapCachePath)) {
    echo "✅ bootstrap/cache/ is writable\n";
} else {
    echo "❌ bootstrap/cache/ is NOT writable\n";
}

// Fix 5: Verify .htaccess content
echo "\n=== Fix 5: Verifying .htaccess Content ===\n";
if (file_exists($htaccessDest)) {
    echo "✅ .htaccess exists at root\n";
    echo "First 10 lines:\n";
    $lines = file($htaccessDest);
    echo implode('', array_slice($lines, 0, 10));
} else {
    echo "❌ .htaccess NOT found at root\n";
}

echo "\n\n=== ALL FIXES COMPLETED ===\n";
echo "Now visit: https://littleflowerhs.com\n";
echo "\n⚠️ IMPORTANT: Delete this file after use for security!\n";
echo "</pre>";
