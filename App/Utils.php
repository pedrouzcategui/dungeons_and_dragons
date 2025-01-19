<?php

namespace App;

class Utils
{

    // Función usada para debuggear de manera más sencilla
    public static function prettyDump(...$things)
    {
        foreach ($things as $thing) {
            echo "<pre>";
            var_dump($thing);
            echo "</pre>";
        }
    }

    // Función para obtener el URL de una imagen relativa a la carpeta "images"
    public static function getImagePath($path)
    {
        return "http://localhost/dungeons_and_dragons/assets/images/$path";
    }
}
