<?php

namespace App\Models;

use App\Database as DB;

class Chapter
{
    private $id;
    private $title;
    private $description;

    // Constructor
    public function __construct($id, $title, $description)
    {
        $this->setId($id);
        $this->setTitle($title);
        $this->setDescription($description);
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public static function getAll()
    {
        $chapters = DB::query('SELECT * FROM chapters');
        return $chapters;
    }

    public static function find($chapter_id)
    {
        $chapter = DB::query('SELECT * FROM chapters WHERE id = ?', [$chapter_id]);
        $dialogue = DB::query('SELECT * FROM dialogue WHERE chapter_id = ?', [$chapter_id]);
        $options = DB::query('SELECT * FROM options WHERE chapter_id = ?', [$chapter_id]);

        // Return JSON of dialogue and options
    }
}
