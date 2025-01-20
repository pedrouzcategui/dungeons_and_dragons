<?php

namespace App\Components;

use App\Utils;

class Image
{
    public static function render($src, $title = "", $width = 50, $height = 50)
    {

        $image_path = Utils::getImagePath($src);

        echo <<<HTML
            <img class="file-item" src="$image_path" width="$width" height="$height" title="$title"/>
        HTML;
    }
}
