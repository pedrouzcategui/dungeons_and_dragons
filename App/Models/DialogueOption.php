<?php

namespace App\Models;

use App\Database as DB;

class DialogueOption
{
    private $id;
    private $dialogue_id;
    private $text;
    private $next_dialogue_id;
    private $next_chapter_id;

    public function __construct($id, $dialogue_id, $text, $next_dialogue_id, $next_chapter_id)
    {
        $this->id = $id;
        $this->dialogue_id = $dialogue_id;
        $this->text = $text;
        $this->next_dialogue_id = $next_dialogue_id;
        $this->next_chapter_id = $next_chapter_id;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getDialogueId()
    {
        return $this->dialogue_id;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getNextDialogueId()
    {
        return $this->next_dialogue_id;
    }

    public function getNextChapterId()
    {
        return $this->next_chapter_id;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setDialogueId($dialogue_id)
    {
        $this->dialogue_id = $dialogue_id;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function setNextDialogueId($next_dialogue_id)
    {
        $this->next_dialogue_id = $next_dialogue_id;
    }

    public function setNextChapterId($next_chapter_id)
    {
        $this->next_chapter_id = $next_chapter_id;
    }

    // Insert function
    public static function insert($dialogue_id, $text, $next_dialogue_id)
    {
        DB::query(
            "INSERT INTO dialogue_options (dialogue_id, text, next_dialogue_id) VALUES (?, ?, ?)",
            [$dialogue_id, $text, $next_dialogue_id]
        );
    }
}
