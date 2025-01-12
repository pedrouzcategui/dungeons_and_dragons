<?php

namespace App\Controllers;

use App\Views\View;
use App\Request;
use App\Response;
use App\Models\Character;
use App\Database as DB;
use App\Models\Dialogue;
use App\Utils;

class GameFilesController extends BaseController
{
    public function index()
    {
        View::render('file-selection', ['characters' => Character::getAll()]);
    }

    public function loadChapter(Request $request)
    {
        View::render('game');
    }

    public function saveGame(Request $request)
    {
        // Simulating a successful save response
        $data = $request->getBody();
        //TODO: Implement character update method

        // Update Character Progress
        // $dialogue = Dialogue::findById($data['current_dialogue_node']);
        // Character::update($character_id = 1, $current_chapter, $current_dialogue_node);

        // Instead of returning a response, I might need to actually return a view, the same loadChpater
        // $response = [
        //     'status' => 'success',
        //     'message' => 'Game progress saved!',
        //     'data' => $data
        // ];

        // Response::json($response); // Send JSON response for saving game
    }
}
