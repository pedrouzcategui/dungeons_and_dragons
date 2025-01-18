<?php

namespace App\Models;

use App\Database as DB;
use App\Utils;

class Chapter
{
    private $id;
    private $title;
    private $description;
    private $background_image_name;
    private $music_file_name;

    // Constructor
    public function __construct($id, $title, $description, $background_image_name = null, $music_file_name = null)
    {
        $this->setId($id);
        $this->setTitle($title);
        $this->setDescription($description);
        $this->setBackgroundImageName($background_image_name);
        $this->setMusicFileName($music_file_name);
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
    public function getBackgroundImageName()
    {
        return $this->background_image_name;
    }
    public function getMusicFileName()
    {
        return $this->music_file_name;
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
    public function setBackgroundImageName($image_name)
    {
        $this->background_image_name = $image_name;
    }
    public function setMusicFileName($music_file_name)
    {
        $this->music_file_name = $music_file_name;
    }

    public static function getAll()
    {
        return DB::query('SELECT * FROM chapters');
    }

    public static function findById($id)
    {
        $result = DB::query('SELECT * FROM chapters WHERE id = ?', [$id]);
        if (count($result) > 0) {
            $row = $result[0];
            return new self($row['id'], $row['name'], $row['description'], $row['background_image_name'], $row['music_file_name']);
        }
        return null;
    }

    public static function insert($name, $description, $background_image_name = null, $music_file_name = null)
    {
        DB::query(
            "INSERT INTO chapters (name, description, background_image_name, music_file_name) VALUES (?, ?, ?, ?)",
            [$name, $description, $background_image_name, $music_file_name]
        );
    }

    public function toObject()
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'background_image_url_name' => $this->getBackgroundImageName(),
            'music_file_name' => $this->getMusicFileName(),
        ];
    }
}
