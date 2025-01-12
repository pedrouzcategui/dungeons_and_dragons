<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Files</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>Please select a file.</h1>

    <div class="save-files-container">
        <?php foreach ($characters as $index => $character): ?>
            <div class="file-option">
                <div class="file-options-meta-data">
                    <span>File <?= $index + 1 ?></span> <span>1-11-2025</span>
                </div>
                <span class="mb-1"><b><?= $character->getName() ?></b> </span>
                <span class="text-sm">Current Chapter: <?= $character->getCurrentChapter() ?></span>
            </div>
        <?php endforeach; ?>
        <a href="game">
            <button class="w-full" type="button" id="start-adventure" disabled>Resume Adventure</button>
        </a>

    </div>
    <a href="create-character" class="my-2">
        <div class="create-file">
            Or Create a Character Instead
        </div>
    </a>
</body>

</html>