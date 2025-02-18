<?php

use App\Components\AudioOptions;
use App\Models\CharacterClass;
use App\Utils;

$classes = CharacterClass::getAll();
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
                <!-- I need to iterate from this point -->
                <?php foreach ($classes as $index => $class): ?>
                    <label for="<?= $class->getName() ?>">
                        <img class="class_image" src="assets/images/classes/<?= $class->getName() ?>.png" alt="<?= $class->getName() ?>.png" />
                        <div class="flex justify-between items-center my-2">
                            <span class="character_class_name"><?= $class->getName() ?></span>
                            <input type="radio" name="character_class" id="<?= $class->getName() ?>" value="<?= $index + 1 ?>" checked>
                        </div>
                        <div class="flex flex-column text-sm gap-1">
                            <span>Ataque: <?= $class->getAttack() ?></span>
                            <span>Defensa: <?= $class->getDefense() ?></span>
                            <span>Salud: <?= $class->getHealth() ?></span>
                            <span>Suerte: <?= $class->getLuck() ?></span>
                            <span>Honor: <?= $class->getHonor() ?></span>
                        </div>
                    </label>
                <?php endforeach; ?>
                <!-- To this point -->
            </div>
        </div>

        <button type="submit">Crear Personaje</button>

        <?= AudioOptions::render() ?>
    </form>
</body>

</html>