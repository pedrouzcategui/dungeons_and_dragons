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
}
