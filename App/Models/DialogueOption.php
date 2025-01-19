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

    public static function insert($dialogue_id, $text, $next_dialogue_id)
    {
        DB::query(
            "INSERT INTO dialogue_options (dialogue_id, text, next_dialogue_id) VALUES (?, ?, ?)",
            [$dialogue_id, $text, $next_dialogue_id]
        );
    }

    public static function getDialogueOptionsByChapterId($chapterId)
    {
        return DB::query(
            "SELECT o.dialogue_id, o.id AS option_id, o.text AS description, o.next_dialogue_id
             FROM dialogue_options o 
             JOIN dialogue d ON o.dialogue_id = d.id 
             WHERE d.chapter_id = ?",
            [$chapterId]
        );
    }

    public static function getDialogueOptionsByDialogueId($dialogue_id)
    {
        return DB::query(
            "SELECT * FROM dialogue_options WHERE dialogue_id = ?",
            [$dialogue_id]
        );
    }
}
