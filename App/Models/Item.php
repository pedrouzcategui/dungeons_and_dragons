<?php

namespace App\Models;

use App\Database as DB;

class Item
{
    private $id;
    private $name;
    private $image_name;

    function __construct($id, $name, $image_name)
    {
        $this->setId($id);
        $this->setName($name);
        $this->setImageName($image_name);
    }
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getImageName()
    {
        return $this->image_name;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setImageName($image_name)
    {
        $this->image_name = $image_name;
    }
    public static function findById($id)
    {
        $sql = "SELECT * FROM items WHERE id = ? LIMIT 1";
        $result = DB::query($sql, [$id]);

        if (!empty($result)) {
            $item = $result[0];
            return new self($item['id'], $item['name'], $item['image_name']);
        }

        return null;
    }

    public static function getByDialogueId($dialogue_id)
    {
        $item_id = DB::query("SELECT item_id FROM dialogue WHERE id = ? LIMIT 1", [$dialogue_id]);
        return $item_id;
        if ($item_id) {
            return self::findById($item_id);
        }
        return null;
    }

    public static function insert($name, $image_name)
    {
        $sql = "INSERT INTO items (name, image_name) VALUES (?, ?)";
        return DB::query($sql, [$name, $image_name]);
    }
    public function toObject()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'image_name' => $this->getImageName()
        ];
    }
}
