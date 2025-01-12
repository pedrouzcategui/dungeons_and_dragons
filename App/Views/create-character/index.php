<?php



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Character Creation Menu</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<form method="post" action="create-character">
    <div class="step active">
        <h1>What is your name?</h1>
        <input type="text" name="character_name" required />
        <button type="button" id="next-step-1">Next</button>
    </div>
    <div class="step">
        <h1>What is your role?</h1>

        <div>
            <label for="knight">
                <input type="radio" name="character_class" id="knight" value="1" checked> Knight
            </label>
            <label for="archer">
                <input type="radio" name="character_class" id="archer" value="2"> Archer
            </label>
            <label for="mage">
                <input type="radio" name="character_class" id="mage" value="3"> Mage
            </label>
        </div>

        <button type="submit" id="next-step-1">Start Adventure</button>
    </div>
    <script src="script.js"></script>
</form>

</html>