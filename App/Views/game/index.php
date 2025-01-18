<?php

use App\Components\AudioOptions;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dialog System</title>
</head>

<body>
    <div id="chapter_image">

    </div>
    <div id="dialog" class="dialog">
        <h2 id="title">Chapter #<span id="chapter_id"></span>: <span id="chapter_title"></span> </h2>
        <span class="my-2 block italic bold" id="character_name"></span>
        <div id="dialog-container"></div>
        <div class="dice" id="dice-container" style="display: none;">
            <span>
                Required Number: <span id="required-number"></span>
            </span>
            <span>
                Obtained Number: <span id="obtained-number"></span>
            </span>
        </div>

        <div id="choices-container"></div>
    </div>
    <?= AudioOptions::render() ?>
    <script src="script.js"></script>
</body>

</html>