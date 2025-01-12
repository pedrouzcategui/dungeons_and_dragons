<?php

spl_autoload_register(function ($className) {
    // Define the base directory for your project
    $baseDir = __DIR__ . '/';

    // Convert the class name into a relative file path
    $relativePath = str_replace('\\', '/', $className) . '.php';

    // Construct the full path to the class file
    $filePath = $baseDir . $relativePath;

    // Check if the file exists, and include it
    if (file_exists($filePath)) {
        include_once $filePath;
    } else {
        die("Class $className could not be found in $filePath");
    }
});
