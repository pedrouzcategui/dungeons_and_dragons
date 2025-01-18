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
    <a class="text-white underline" href="/dungeons_and_dragons"> ⬅️ Back to main screen</a>
    <h1>Please select a file.</h1>
    <div class="save-files-container">
        <?php for ($i = 0; $i < 3; $i++): ?>
            <?php if (isset($characters[$i])): ?>
                <div class="file-option <?= $characters[$i]->getIsGameCompleted() ? "completed" : "" ?>" data-character-id="<?= $characters[$i]->getId() ?>">
                    <div class="file-options-meta-data">
                        <span>File <?= $i + 1 ?></span> <span>1-11-2025</span>
                    </div>
                    <span class="mb-1"><b><?= $characters[$i]->getName() ?> - Clase: <?= $characters[$i]->getCharacterClassName() ?></b> </span>
                    <?php if (!$characters[$i]->getIsGameCompleted()): ?>
                        <span class="text-sm">Current Chapter: <?= $characters[$i]->getCurrentChapter() ?></span>
                    <?php else: ?>
                        <span class="text-sm">Ending: <?= $characters[$i]->getEndingId() ?></span>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <a href="create-character">
                    <div class="file-create">
                        <span> ➕ Create new file</span>
                    </div>
                </a>
            <?php endif; ?>
        <?php endfor; ?>
        <div class="file-options-actions">
            <a href="game">
                <button class="w-full" type="submit" id="start-adventure" disabled>Resume Adventure</button>
            </a>
            <button class="w-full delete-button" type="button" id="delete-file" disabled>Delete File</button>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmation-modal" class="modal hidden">
        <div class="modal-content">
            <p>Are you sure you want to delete this file?</p>
            <button id="confirm-delete" class="confirm">Yes</button>
            <button id="cancel-delete" class="cancel">No</button>
        </div>
    </div>
    <?= AudioOptions::render() ?>
    <script src="script.js"></script>
</body>

</html>