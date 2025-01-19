<?php

use App\Components\AudioOptions;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La traición del rey</title>
</head>

<body>
    <div class="main-screen">
        <h1>La traición del rey</h1>
        <a href="file-selection">
            <button id="main_button">Iniciar Juego</button>
        </a>
        <span class="block">Presiona F11 en tu teclado para mayor immersión!</span>
        <?= AudioOptions::render() ?>
    </div>
</body>

</html>