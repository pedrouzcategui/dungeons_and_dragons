<?php

namespace App\Controllers;

use App\Request;
use App\Response;
use App\Utils;
use App\Database as DB;
use App\Models\Character;
use App\Models\Dialogue;

class DialogueController
{

    public function getChapterDialogue(Request $request)
    {
        $characterId = (int)$request->getParam('id');
        $character = Character::getCharacterByID($characterId);
        $dialogData = Dialogue::getChapterDialogue($character->getCurrentChapter(), $character->getId());
        Response::json(["dialog" => $dialogData, "character" => [
            "id" => $character->getId(),
            "current_chapter_id" => $character->getCurrentChapter(),
            "current_dialog_node_id" => $character->getDialogueNode(),
        ]]);
    }
}
