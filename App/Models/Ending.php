<?php

namespace App\Models;

use App\Database as DB;

class Ending
{
    private $id;
    private $title;
    private $description;
    private $image_name;

    public function __construct($id, $title, $description, $image_name = null)
    {
        $this->setId($id);
        $this->setTitle($title);
        $this->setDescription($description);
        $this->setImageName($image_name);
    }

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

    public function getImageName()
    {
        return $this->image_name;
    }

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

    public function setImageName($image_name)
    {
        $this->image_name = $image_name;
    }

    public static function getAll()
    {
        return DB::query('SELECT * FROM chapters');
    }

    public static function insert($name, $description, $image_name = null)
    {
        DB::query(
            "INSERT INTO endings (name, description, image_name) VALUES (?, ?, ?)",
            [$name, $description, $image_name]
        );
    }

    public static function getById($id)
    {
        $result = DB::query('SELECT * FROM endings WHERE id = ?', [$id]);
        if (count($result) > 0) {
            $row = $result[0];
            return new self($row['id'], $row['name'], $row['description'], $row['image_name']);
        }
        return null;
    }
    public function toObject()
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'image_name' => $this->getImageName()
        ];
    }
}
