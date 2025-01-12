<?php

namespace App\Controllers;

use App\Request;
use App\Response;
use App\Database as DB;
use App\Models\Dialogue;

class DialogueController
{

    public function getChapterDialogue(Request $request)
    {
        $characterId = (int)$request->getParam('id');
        $dialogData = Dialogue::getChapterDialogue(1, $characterId);
        Response::json($dialogData);
    }
}
