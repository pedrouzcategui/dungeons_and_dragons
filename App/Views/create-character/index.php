<?php

use App\Components\AudioOptions;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Character Creation Menu</title>
    <link rel="stylesheet" href="styles.css" />
</head>

<body>
    <form method="post" action="create-character">
        <h1>Creación de personaje</h1>
        <div class="form-group">
            <label class="text-sm" for="character_name">¿Cuál es el nombre de tu personaje?</label>
            <input style="background:rgb(172, 77, 60); color: white" type="text" id="character_name" name="character_name" required />
        </div>

        <div class="form-group">
            <label class="text-sm">¿Cuál es tu rol?</label>
            <div class="role-options">
                <label for="knight">
                    <img src="assets/images/classes/knight.png" alt="knight.png" />
                    <div class="flex justify-between items-center my-2">
                        <span class="character_class_name">Caballero</span>
                        <input type="radio" name="character_class" id="knight" value="1" checked>
                    </div>
                    <div class="flex flex-column text-sm gap-1">
                        <span>Ataque: 3</span>
                        <span>Defensa: 1</span>
                        <span>Honor: 2</span>
                    </div>
                </label>
                <label for="archer">
                    <img src="assets/images/classes/archer.png" alt="archer.png" />
                    <div class="flex justify-between items-center  my-2">
                        <span class="character_class_name">Arquero</span>
                        <input type="radio" name="character_class" id="archer" value="2">
                    </div>
                    <div class="flex flex-column text-sm gap-1">
                        <span>Ataque: 1</span>
                        <span>Defensa: 3</span>
                        <span>Honor: 2</span>
                    </div>
                </label>
                <label for="mage">
                    <img src="assets/images/classes/mage.png" alt="mage.png" />
                    <div class="flex justify-between items-center  my-2">
                        <span class="character_class_name">Mago</span>
                        <input type="radio" name="character_class" id="mage" value="3">
                    </div>
                    <div class="flex flex-column text-sm gap-1">
                        <span>Ataque: 2</span>
                        <span>Defensa: 3</span>
                        <span>Honor: 1</span>
                    </div>
                </label>
            </div>
        </div>

        <button type="submit">Crear Personaje</button>

        <?= AudioOptions::render() ?>
    </form>
</body>

</html>