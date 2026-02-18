<?php
// ==========================
// Debugging: show all errors
// ==========================
error_reporting(E_ALL);
ini_set('display_errors', 1);

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// ==========================
// Path to Laravel root
// ==========================
$laravelRoot = __DIR__.'/..';

// ==========================
// Maintenance mode
// ==========================
if (file_exists($maintenance = $laravelRoot.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

// ==========================
// Composer autoloader
// ==========================
$autoload = $laravelRoot.'/vendor/autoload.php';
if (!file_exists($autoload)) {
    die('Error: Composer autoload file not found. Did you run "composer install"?');
}
require $autoload;

// ==========================
// Bootstrap Laravel
// ==========================
$appFile = $laravelRoot.'/bootstrap/app.php';
if (!file_exists($appFile)) {
    die('Error: Laravel bootstrap file not found.');
}

$app = require_once $appFile;

// ==========================
// Handle the request safely
// ==========================
try {
    $response = $app->handle(Request::capture());
    $response->send();
} catch (\Throwable $e) {
    // Display the error directly (useful for debugging)
    echo '<h1>Laravel Error</h1>';
    echo '<pre>'.$e.'</pre>';
}
