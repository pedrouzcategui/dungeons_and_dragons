<?php

// Collect input from the form 
$character_name = $_POST['character_name'];
$character_class = $_POST['character_class'];


// Create a new character
// $character = new Character($character_name, $character_class);

// Save the character to the database
$character->save();

// Redirect to the chapter 1 page
header('Location: chapter-1.php');
