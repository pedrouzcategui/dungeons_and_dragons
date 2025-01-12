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
        $data = $request->getBody();

        try {
            $dialogue = Dialogue::findFirstDialogueOfChapter($data['current_chapter']);
            $character = Character::getCharacterByID($data['character_id']);
            $character->update($dialogue['chapter_id'], $dialogue['id']);
        } catch (\Throwable $th) {
            return Response::error($th);
        }

        $response = [
            'status' => 'success',
            'message' => 'Game progress saved!',
            'chapter_id' => $character->getCurrentChapter(),
            'character_id' => $character->getId(),
            // 'request' => $data, For debug purposses
            'next_dialogue_id' => $dialogue['id']
        ];

        Response::json($response);
    }
}
