<?php

namespace App\Controllers;

use App\Models\Chapter;
use App\Response;
use App\Request;

class ChapterController
{
    public function index() {}

    public function show(Request $request)
    {
        // I will need to return a view here most probably.
        $chapter = Chapter::findById($request->getParam('id'));
        Response::json($chapter->toObject());
    }
}
