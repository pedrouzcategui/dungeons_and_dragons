<?php

namespace App\Controllers;

use App\Request;
use App\Response;
use App\Models\Chapter;
use App\Models\Character;
use App\Models\Dialogue;

class DialogueController
{

    // Esta función devuelve el objeto de dialogo para ser consumido por JavaScript en la vista "game".

    public function getChapterDialogue(Request $request)
    {
        try {
            $characterId = (int)$request->getParam('id');
            $character = Character::getCharacterByID($characterId);
            $chapter = Chapter::findById($character->getCurrentChapter());
            $dialogData = Dialogue::getChapterDialogue($character->getCurrentChapter(), $character->getId());
            // Se formatea un JSON para ser usado por JavaScript.
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
