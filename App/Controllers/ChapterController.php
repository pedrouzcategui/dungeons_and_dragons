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
        // Devuelve una respuesta de tipo JSON para ser usada por JavaScript.
        Response::json(Chapter::findById($request->getParam('id'))->toObject());
    }
}
