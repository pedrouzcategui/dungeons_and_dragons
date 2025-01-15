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
                    <input type="radio" name="character_class" id="knight" value="1" checked> Knight
                </label>
                <label for="archer">
                    <input type="radio" name="character_class" id="archer" value="2"> Archer
                </label>
                <label for="mage">
                    <input type="radio" name="character_class" id="mage" value="3"> Mage
                </label>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit">Start Adventure</button>
    </form>
</body>

</html>