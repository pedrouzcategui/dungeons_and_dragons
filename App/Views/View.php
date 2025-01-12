<?php

namespace App\Views;

use App\Utils;

class View
{
    public static function render($viewFolder, $data = [])
    {
        // Extract data to be used in the view
        extract($data);

        // Append 'index.php' to the folder to always target the index file
        $viewPath = 'App/Views/' . $viewFolder . '/index.php';

        // Determine the directory of the view for CSS/JS inclusion
        $viewDir = 'App/Views/' . $viewFolder;

        // Dynamically include CSS if it exists
        $cssPath = "$viewDir/styles.css";
        if (file_exists($cssPath)) {
            echo '<link rel="stylesheet" href="App/Views/globals.css">';
            echo '<link rel="stylesheet" href="' . $cssPath . '">';
        }

        // Dynamically include JavaScript if it exists
        $jsPath = "$viewDir/script.js";
        if (file_exists($jsPath)) {
            echo '<script src="App/Views/globals.js"></script>';
            echo '<script src="' . $jsPath . '"></script>';
        }

        // Include the view
        if (file_exists($viewPath)) {
            include_once $viewPath;
        } else {
            throw new \Exception("View not found: $viewPath");
        }
    }
}
