<?php

use App\Components\AudioOptions;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Files</title>
</head>

<body>
    <a class="text-white underline" href="/dungeons_and_dragons"> ⬅️ Volver a la pantalla principal</a>
    <h1>Por Favor Selecciona Una Partida.</h1>
    <div class="save-files-container">
        <?php for ($i = 0; $i < 3; $i++): ?>
            <?php if (isset($characters[$i])): ?>
                <div class="file-option <?= $characters[$i]->getIsGameCompleted() ? "completed" : "" ?>" data-character-id="<?= $characters[$i]->getId() ?>">
                    <div class="file-options-meta-data">
                        <span class="text-sm">Partida <?= $i + 1 ?></span> <span> <?= $characters[$i]->getCharacterClassName() ?></span>
                    </div>
                    <span class="mb-1"><b><?= $characters[$i]->getName() ?></b> </span>
                    <?php if (!$characters[$i]->getIsGameCompleted()): ?>
                        <span class="text-sm">Capitulo Actual: <?= $characters[$i]->getCurrentChapter() ?></span>
                    <?php else: ?>
                        <span class="text-sm">Ending: <?= $characters[$i]->getEndingId() ?></span>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <a href="create-character">
                    <div class="file-create">
                        <span> ➕ Crear una nueva partida</span>
                    </div>
                </a>
            <?php endif; ?>
        <?php endfor; ?>
        <div class="file-options-actions">
            <button class="delete-button w-full" type="button" id="delete-file" disabled>Eliminar Partida</button>
            <a href="game" class="w-full">
                <button class="w-full confirm" type="submit" id="start-adventure" disabled>Empezar Aventura</button>
            </a>
        </div>
    </div>

    <div id="confirmation-modal" class="modal hidden">
        <div class="modal-content">
            <p>¿Estás seguro que quieres eliminar esta partida?</p>
            <button id="confirm-delete" class="confirm">Yes</button>
            <button id="cancel-delete" class="cancel">No</button>
        </div>
    </div>
    <?= AudioOptions::render() ?>
    <script src="script.js"></script>
</body>

</html>