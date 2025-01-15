<?php

namespace App;

class Utils
{

    public static function prettyDump(...$things)
    {
        foreach ($things as $thing) {
            echo "<pre>";
            var_dump($thing);
            echo "</pre>";
        }
    }

    public static function redirect($url, $statusCode)
    {
        header('Location: ' . $url, true, $statusCode);
    }

    //**This function get images, path is related to the assets/images folder */
    public static function getImagePath($path)
    {
        return "http://localhost/dungeons_and_dragons/assets/images/$path";
    }
}
