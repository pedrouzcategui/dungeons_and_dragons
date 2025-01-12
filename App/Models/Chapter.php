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
        return DB::query('SELECT * FROM chapters');
    }

    public static function insert($name, $description)
    {
        DB::query(
            "INSERT INTO chapters (name, description) VALUES (?, ?)",
            [$name, $description]
        );
    }
}
