<?php

use App\Controllers\CharacterController;
use App\Controllers\GameFilesController;
use App\Controllers\DialogueController;
use App\Controllers\MainScreenController;

use App\Router;

$router = new Router();

$router->get("/", MainScreenController::class, "index");

// Character Routes
$router->get("/create-character", CharacterController::class, "index");
$router->post("/create-character", CharacterController::class, "create");

// Save Files Routes
$router->get("/file-selection", GameFilesController::class, "index");

// Chapter File Routes
$router->get("/game", GameFilesController::class, "loadChapter");
$router->post("/saveGame", GameFilesController::class, "saveGame");

// API Routes
$router->get("/api/game", DialogueController::class, "getChapterDialogue");
$router->get("/api/game/:id", DialogueController::class, "getChapterDialogue");
$router->put("/api/save-game", GameFilesController::class, "saveGame");
