<?php

namespace App\Controllers;

use App\Views\View;
use App\Request;
use App\Response;
use App\Models\Character;
use App\Database as DB;
use App\Models\Dialogue;
use App\Models\Ending;
use App\Utils;

class EndingController extends BaseController
{
    public function index(Request $request)
    {
        try {
            // Transforma el request en un array.
            $data = $request->getBody();
            $character = Character::getCharacterByID($request->getBody()['character_id']);
            $character->update($character->getCurrentChapter(), $character->getDialogueNode(), TRUE, $request->getBody()['ending_id']);
            Response::json($character->toObject());
        } catch (\Throwable $th) {
            Response::error($th);
        }
    }

    public function get(Request $request)
    {
        $character_id = $request->getParam("id");
        $character = Character::getCharacterByID($character_id);
        $ending = Ending::getById($character->getEndingId());
        Response::json($ending->toObject());
    }

    public function show()
    {

        return View::render('ending');
    }
}
