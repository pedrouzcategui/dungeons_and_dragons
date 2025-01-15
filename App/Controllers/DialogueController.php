<?php

namespace App\Controllers;

use App\Request;
use App\Response;
use App\Utils;
use App\Database as DB;
use App\Models\Chapter;
use App\Models\Character;
use App\Models\Dialogue;

class DialogueController
{

    public function getChapterDialogue(Request $request)
    {
        try {
            $characterId = (int)$request->getParam('id');
            $character = Character::getCharacterByID($characterId);
            $chapter = Chapter::findById($character->getCurrentChapter());
            $dialogData = Dialogue::getChapterDialogue($character->getCurrentChapter(), $character->getId());
            Response::json([
                "dialog" => $dialogData,
                "character" => [
                    "id" => $character->getId(),
                    "current_chapter_id" => $character->getCurrentChapter(),
                    "current_dialog_node_id" => $character->getDialogueNode(),
                ],
                "chapter" => $chapter->toObject()
            ]);
        } catch (\Throwable $th) {
            return Response::error($th);
        }
    }
}
