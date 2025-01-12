<?php

use App\Models\Chapter;

class ChapterController
{
    public function index() {}

    public function show($id)
    {
        $chapter = Chapter::find($id);
        // I will need to return a view here most probably.
    }
}
