<?php

namespace App\Components;

use App\Components\Image;

class CharacterItems
{
    public static function render($items)
    {

        echo "<div class='file-items'>";
        echo "<span class='text-sm'>Items:</span>";
        foreach ($items as $item) {
            echo Image::render('icons/' . $item->getImageName(), $item->getName(), 35, 35);
        }
        echo "</div>";
    }
}
