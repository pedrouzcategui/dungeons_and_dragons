<?php

namespace App\Views;

class View
{
    /**La función estática render recibe el nombre de un directorio, y opcionalmente, variables. */
    public static function render($viewFolder, $data = [])
    {
        // Extrae las variables para ser usadas en la vista.
        extract($data);

        // El punto de partida siempre sera un archivo llamado index.php
        $viewPath = 'App/Views/' . $viewFolder . '/index.php';

        // Determina el directorio para hacer inclusión de archivos de JS/CSS
        $viewDir = 'App/Views/' . $viewFolder;

        // Si existe CSS lo incluye.
        $cssPath = "$viewDir/styles.css";
        if (file_exists($cssPath)) {
            echo '<link rel="stylesheet" href="App/Views/globals.css">';
            echo '<link rel="stylesheet" href="' . $cssPath . '">';
        }

        // Si existe JS lo incluye.
        $jsPath = "$viewDir/script.js";
        if (file_exists($jsPath)) {
            echo '<script src="App/Views/globals.js"></script>';
            echo '<script src="' . $jsPath . '"></script>';
        }

        // Finalmente incluimos la vista. Si no existe se devuelve un exception.
        if (file_exists($viewPath)) {
            include_once $viewPath;
        } else {
            throw new \Exception("View not found: $viewPath");
        }
    }
}
