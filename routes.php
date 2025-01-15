<?php

use App\Controllers\CharacterController;
use App\Controllers\GameFilesController;
use App\Controllers\DialogueController;
use App\Controllers\MainScreenController;
use App\Controllers\SeedController;
use App\Controllers\EndingController;
use App\Controllers\ChapterController;

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
$router->get("/ending", EndingController::class, "show");

// API Routes
$router->delete("/api/character/:id", CharacterController::class, "delete");

$router->get("/api/chapter/:id", ChapterController::class, "show");
$router->get("/api/game", DialogueController::class, "getChapterDialogue");
$router->get("/api/game/:id", DialogueController::class, "getChapterDialogue");
$router->put("/api/save-game", GameFilesController::class, "saveGame");
$router->get("/api/ending/:id", EndingController::class, "get");
$router->post("/api/ending", EndingController::class, "index");

// Seeder Routes
$router->get("/seed", SeedController::class, "index");
