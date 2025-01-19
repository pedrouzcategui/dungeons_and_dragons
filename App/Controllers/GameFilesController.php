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
    //**Vista de selección de archivos. */
    public function index()
    {
        View::render('file-selection', ['characters' => Character::getAll()]);
    }

    // Carga el archivo principal del juego.
    public function loadChapter()
    {
        View::render('game');
    }

    // Guarda el progreso del juego luego de cada nodo de dialogo final.
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
            'next_dialogue_id' => $dialogue['id']
        ];

        Response::json($response);
    }
}
