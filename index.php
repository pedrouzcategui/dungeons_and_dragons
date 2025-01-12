<?php

require_once 'autoloader.php';
require_once 'routes.php';

// Maybe just in DEBUG
// header('Pragma: no-cache');

use App\Utils;

// Get the full URI
$uri = $_SERVER['REQUEST_URI'];

// Define your base path
$basePath = '/dungeons_and_dragons';

// Remove the base path from the URI
if (strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
}

// Get the HTTP method
$method = $_SERVER['REQUEST_METHOD'];

// Dispatch the cleaned URI and HTTP method
$router->dispatch($uri, $method);
