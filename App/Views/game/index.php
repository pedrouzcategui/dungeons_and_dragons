<?php

use App\Components\AudioOptions;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La traición del rey - Juego</title>
</head>

<body>
    <div id="chapter_image">

    </div>
    <div id="dialog" class="dialog">
        <h2 id="title">Capítulo #<span id="chapter_id"></span>: <span id="chapter_title"></span> </h2>
        <span class="my-2 block italic bold" id="character_name"></span>
        <div id="dialog-container"></div>
        <img src="http://localhost\dungeons_and_dragons\assets\images\d20.webp" width="50px" id="d20" />
        <img id="item_image" width="50px">

        <div id="choices-container"></div>
    </div>
    <?= AudioOptions::render() ?>
    <script src="script.js"></script>
</body>

</html>