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
        <h1>Character Creation</h1>
        <!-- Name Section -->
        <div class="form-group">
            <label for="character_name">What is your name?</label>
            <input type="text" id="character_name" name="character_name" required />
        </div>

        <!-- Role Selection -->
        <div class="form-group">
            <label>What is your role?</label>
            <div class="role-options">
                <label for="knight">
                    <img src="assets/images/classes/knight.png" alt="knight.png" />
                    <input type="radio" name="character_class" id="knight" value="1" checked>
                    <span>
                        Knight
                    </span>
                    <div style="display: flex; flex-direction: column">
                        <span>Ataque: 3</span>
                        <span>Defensa: 1</span>
                        <span>Honor: 2</span>
                    </div>
                </label>
                <label for="archer">
                    <img src="assets/images/classes/archer.png" alt="archer.png" />
                    <input type="radio" name="character_class" id="archer" value="2"> Archer
                    <div style="display: flex; flex-direction: column">
                        <span>Ataque: 1</span>
                        <span>Defensa: 3</span>
                        <span>Honor: 2</span>
                    </div>
                </label>
                <label for="mage">
                    <img src="assets/images/classes/mage.png" alt="mage.png" />
                    <input type="radio" name="character_class" id="mage" value="3"> Mage
                    <div style="display: flex; flex-direction: column">
                        <span>Ataque: 2</span>
                        <span>Defensa: 3</span>
                        <span>Honor: 1</span>
                    </div>
                </label>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit">Start Adventure</button>

        <?= AudioOptions::render() ?>
    </form>
</body>

</html>