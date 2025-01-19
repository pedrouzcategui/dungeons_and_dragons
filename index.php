<?php

require_once 'autoloader.php';
require_once 'routes.php';

header('Pragma: no-cache');

// Obtiene el URI
$uri = $_SERVER['REQUEST_URI'];

// Define your base path
$basePath = '/dungeons_and_dragons';

// Remove the base path from the URI
if (strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
}

// Obtiene el verbo HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Despacha el controlador y acción dependiendo del verbo HTTP y de la ruta especificada.
$router->dispatch($uri, $method);
