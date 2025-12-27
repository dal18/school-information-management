<?php
/**
 * Simple Git Pull Script
 * Access: https://littleflowerhs.com/pull-latest.php?key=pull2025
 */

$secretKey = 'pull2025';
$providedKey = $_GET['key'] ?? '';

if ($providedKey !== $secretKey) {
    die('Access Denied');
}

echo "<h1>Git Pull Script</h1>";
echo "<pre>";

$laravelPath = realpath(__DIR__ . '/..');
chdir($laravelPath);

echo "Current directory: " . getcwd() . "\n\n";

// Pull latest changes
echo "=== Pulling latest changes from GitHub ===\n";
$output = [];
exec('git pull origin main 2>&1', $output);
echo implode("\n", $output);

echo "\n\n✅ Done! You can now run the fix script:\n";
echo "https://littleflowerhs.com/fix-deployment.php?key=fix2025\n";

echo "\n⚠️ Delete this file after use!\n";
echo "</pre>";
